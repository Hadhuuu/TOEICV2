<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; // Import Facade Excel
use App\Imports\HasilUjianImport;    // Import class import kita

class HasilUjianImportController extends Controller
{
    public function showImportForm()
    {
        // Hanya menampilkan view, pastikan user adalah admin
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('admin.hasil_ujian.import');
    }

    public function importExcel(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('excel_file');

        $import = new HasilUjianImport();
        try {
            Excel::import($import, $file);

            $stats = $import->getImportStats();
            $errorDetails = $import->getErrorDetails(); // Ambil detail error yang kita kumpulkan

            $successMessage = "Impor selesai. {$stats['processed']} data hasil ujian berhasil diproses.";
            $importDetails = [];
            $importDetails[] = "Data berhasil diproses: " . $stats['processed'];
            if ($stats['nim_not_found'] > 0) $importDetails[] = "Data dilewati (NIM tidak ditemukan): " . $stats['nim_not_found'];
            if ($stats['validation_failures'] > 0) $importDetails[] = "Data dilewati (gagal validasi): " . $stats['validation_failures'];
            if ($stats['other_errors'] > 0) $importDetails[] = "Data dilewati (error lain): " . $stats['other_errors'];
            

            if (!empty($errorDetails)) {
                 return redirect()->route('admin.hasil_ujian.import.form')
                                ->with('error', 'Beberapa data mungkin gagal diimpor. Lihat detail di bawah.')
                                ->with('import_errors', $errorDetails)
                                ->with('import_details', $importDetails); // Kirim juga detail sukses
            }

            return redirect()->route('admin.hasil_ujian.import.form')
                            ->with('success', $successMessage)
                            ->with('import_details', $importDetails);

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures(); // Kegagalan validasi bawaan Maatwebsite
            $errorMessages = [];
            foreach ($failures as $failure) {
                 $errorMessages[] = [
                    'row' => $failure->row(),
                    'message' => 'Baris ' . $failure->row() . ': ' . implode(', ', $failure->errors()),
                    'values' => $failure->values(),
                 ];
            }
             return redirect()->route('admin.hasil_ujian.import.form')
                            ->with('error', 'Terjadi kesalahan validasi saat impor.')
                            ->with('import_errors', $errorMessages);
        } catch (\Exception $e) {
            // Tangani error umum lainnya
            return redirect()->route('admin.hasil_ujian.import.form')->with('error', 'Terjadi kesalahan saat mengimpor file: ' . $e->getMessage());
        }
    }
}