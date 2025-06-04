<?php

namespace App\Imports;

use App\Models\HasilUjian;
use App\Models\User;
use App\Models\MahasiswaProfile;
use Maatwebsite\Excel\Concerns\ToModel;
// HAPUS WithHeadingRow
// use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithStartRow;      // <--- TAMBAHKAN INI
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas; // <--- TAMBAHKAN INI
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

// Hapus WithHeadingRow dari implements, tambahkan WithStartRow dan WithCalculatedFormulas
class HasilUjianImport implements ToModel, SkipsEmptyRows, SkipsOnError, WithStartRow, WithCalculatedFormulas
{
    use Importable;

    private int $processedRows = 0;
    private int $skippedRowsNimNotFound = 0;
    private array $customErrors = [];
    // private array $validationFailures = []; // Validasi utama masih dinonaktifkan untuk tes

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2; // Mulai membaca data dari baris ke-2 Excel (baris 1 adalah header)
    }

    public function model(array $row): ?HasilUjian
    {
        // $row sekarang adalah array numerik
        // Indeks berdasarkan screenshot Anda (Kolom A = 0, B = 1, dst.)
        // ID (NIM) ada di kolom C -> indeks 2
        // L (tengah) ada di kolom D -> indeks 3
        // R (tengah) ada di kolom E -> indeks 4
        // TOT (tengah) ada di kolom F -> indeks 5
        // TEST DATE ada di kolom J -> indeks 9

        // *** PASTIKAN INDEKS INI BENAR SESUAI FILE EXCEL ANDA ***
        $nimIndex = 2;
        $listeningIndex = 3;
        $readingIndex = 4;
        $totalIndex = 5;
        $testDateIndex = 9;
        // *********************************************************

        Log::info('[HasilUjianImport] Processing row (numeric index): ' . json_encode($row));

        if (empty($row) || !isset($row[$nimIndex]) || is_null($row[$nimIndex])) {
            Log::warning('[HasilUjianImport] Skipping row due to empty or missing ID (NIM) at index ' . $nimIndex . ': ' . json_encode($row));
            $this->addCustomError('Skipped at start', 'Baris dilewati karena ID (NIM) kosong atau kolom tidak ada.', $row);
            return null;
        }

        $nimFromExcel = (string)$row[$nimIndex];
        $tanggalUjianExcel = $row[$testDateIndex] ?? null;
        $skorListening = isset($row[$listeningIndex]) && is_numeric($row[$listeningIndex]) ? (int)$row[$listeningIndex] : null;
        $skorReading = isset($row[$readingIndex]) && is_numeric($row[$readingIndex]) ? (int)$row[$readingIndex] : null;
        $skorTotal = isset($row[$totalIndex]) && is_numeric($row[$totalIndex]) ? (int)$row[$totalIndex] : null;


        Log::info("[HasilUjianImport] NIM from Excel (index {$nimIndex}): {$nimFromExcel}");
        Log::info("[HasilUjianImport] Skor L (index {$listeningIndex}): {$skorListening}, R (index {$readingIndex}): {$skorReading}, TOT (index {$totalIndex}): {$skorTotal}");


        $mahasiswaProfile = MahasiswaProfile::where('nim', $nimFromExcel)->first();
        if (!$mahasiswaProfile) {
            $this->skippedRowsNimNotFound++;
            $errorMessage = 'Mahasiswa dengan NIM ini (' . $nimFromExcel . ') tidak ditemukan di database.';
            Log::warning('[HasilUjianImport] ' . $errorMessage . ' Data: ' . json_encode($row));
            $this->addCustomError($nimFromExcel, $errorMessage, $row);
            return null;
        }
        $userId = $mahasiswaProfile->user_id;
        Log::info("[HasilUjianImport] User ID found: {$userId} for NIM: {$nimFromExcel}");

        if (empty($tanggalUjianExcel)) {
            $errorMessage = 'Kolom Tanggal Ujian (index ' . $testDateIndex . ') kosong.';
            Log::warning('[HasilUjianImport] ' . $errorMessage . ' NIM: ' . $nimFromExcel . '. Data: ' . json_encode($row));
            $this->addCustomError($nimFromExcel, $errorMessage, $row);
            return null;
        }
        
        $tanggalUjian = null;
        try {
            if (is_numeric($tanggalUjianExcel)) {
                $tanggalUjian = Carbon::instance(ExcelDate::excelToDateTimeObject($tanggalUjianExcel));
            } else {
                $tanggalUjian = Carbon::parse(str_replace('/', '-', $tanggalUjianExcel));
            }
            $tanggalUjian = $tanggalUjian->toDateString();
            Log::info("[HasilUjianImport] Tanggal Ujian Parsed: {$tanggalUjian} for NIM: {$nimFromExcel}");
        } catch (\Exception $e) {
            $errorMessage = 'Format tanggal ujian tidak valid: ' . $tanggalUjianExcel . '. Error: ' . $e->getMessage();
            Log::error('[HasilUjianImport] ' . $errorMessage . ' NIM: ' . $nimFromExcel . '. Data: ' . json_encode($row));
            $this->addCustomError($nimFromExcel, $errorMessage, $row);
            return null;
        }

        // Jika skor total dari Excel null (atau tidak valid), coba hitung dari L dan R
        // Ini penting jika kolom TOT tengah kadang kosong tapi L dan R tengah ada.
        if (is_null($skorTotal) || !is_numeric($skorTotal)) {
            if (!is_null($skorListening) && is_numeric($skorListening) && !is_null($skorReading) && is_numeric($skorReading)) {
                $skorTotal = $skorListening + $skorReading;
                Log::info("[HasilUjianImport] Skor total dihitung dari L+R: {$skorTotal} untuk NIM: {$nimFromExcel}");
            } else {
                // Jika TOT masih null dan kolom DB tidak memperbolehkan null, ini akan jadi masalah.
                // Kita set default 0 jika kolom DB NOT NULL.
                $skorTotal = 0; 
                Log::warning("[HasilUjianImport] Skor total tidak valid atau tidak dapat dihitung, di-set ke 0 untuk NIM: {$nimFromExcel}");
            }
        }
        
        $dataToSave = [
            'nilai_listening' => $skorListening,
            'nilai_reading' => $skorReading,
            'nilai_total' => $skorTotal,
        ];

        Log::info('[HasilUjianImport] Attempting to updateOrCreate with data: ' . json_encode(array_merge(['user_id' => $userId, 'tanggal_ujian' => $tanggalUjian], $dataToSave)));

        try {
            $hasil = HasilUjian::updateOrCreate(
                ['user_id' => $userId, 'tanggal_ujian' => $tanggalUjian],
                $dataToSave
            );

            if ($hasil && $hasil->exists) {
                $this->processedRows++;
                Log::info("[HasilUjianImport] Data successfully processed (exists=true) for NIM: {$nimFromExcel}. Processed count: {$this->processedRows}. Saved data: " . json_encode($hasil->getAttributes()));
                return $hasil;
            }
            
            Log::error('[HasilUjianImport] Model not saved or does not exist after updateOrCreate for NIM: ' . $nimFromExcel . '. Data: ' . json_encode($dataToSave));
            $this->addCustomError($nimFromExcel, 'Gagal menyimpan data (model tidak exist setelah create/update).', $dataToSave);
            return null;

        } catch (\Throwable $e) {
            Log::error('[HasilUjianImport] Exception during updateOrCreate for NIM: ' . $nimFromExcel . '. Message: ' . $e->getMessage() . '. Data: ' . json_encode($dataToSave));
            $this->onError($e);
            return null; 
        }
    }

    public function onError(\Throwable $e): void
    {
        Log::critical("[HasilUjianImport] onError caught: " . get_class($e) . " - " . $e->getMessage() . ". Full Trace: " . $e->getTraceAsString());
        $this->addCustomError('Error Sistem Dalam Proses', "Exception: " . get_class($e) . " - " . Str::limit($e->getMessage(), 150), ['trace_hint' => 'Cek laravel.log untuk detail trace.']);
    }

    private function addCustomError($identifier, $message, array $values = []): void
    {
        $this->customErrors[] = [
            'identifier' => (string) $identifier,
            'message' => $message,
            'values' => $values,
        ];
    }

    public function getImportStats(): array
    {
        $otherErrorsCount = count($this->customErrors) - $this->skippedRowsNimNotFound;
        $otherErrorsCount = max(0, $otherErrorsCount);

        return [
            'processed' => $this->processedRows,
            'nim_not_found' => $this->skippedRowsNimNotFound,
            'validation_failures' => 0, // Validasi utama masih dinonaktifkan
            'other_errors' => $otherErrorsCount,
        ];
    }
    
    public function getErrorDetails(): array
    {
        return array_map(function ($error) {
            return [
                'row' => $error['identifier'] ?? 'N/A',
                'message' => $error['message'],
                'values' => $error['values'] ?? [],
            ];
        }, $this->customErrors);
    }
}