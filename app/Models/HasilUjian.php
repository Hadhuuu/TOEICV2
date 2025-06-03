<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilUjian extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hasil_ujians';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'nilai',
        'tanggal_ujian',
        'file_sertifikat_path',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal_ujian' => 'date',
        'nilai' => 'integer',
    ];
    
    /**
     * Get the user that owns the exam result.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the listening score.
     *
     * @return int
     */
    public function getListeningAttribute()
    {
        // Assuming the nilai field contains JSON with listening and reading scores
        $scores = json_decode($this->attributes['nilai'], true);
        return $scores['listening'] ?? 0;
    }
    
    /**
     * Get the reading score.
     *
     * @return int
     */
    public function getReadingAttribute()
    {
        // Assuming the nilai field contains JSON with listening and reading scores
        $scores = json_decode($this->attributes['nilai'], true);
        return $scores['reading'] ?? 0;
    }
    
    /**
     * Get the total score.
     *
     * @return int
     */
    public function getTotalAttribute()
    {
        // Assuming the nilai field contains JSON with listening and reading scores
        $scores = json_decode($this->attributes['nilai'], true);
        return ($scores['listening'] ?? 0) + ($scores['reading'] ?? 0);
    }
    
    /**
     * Check if the exam result is a pass.
     *
     * @return bool
     */
    public function getIsPassAttribute()
    {
        return $this->getTotalAttribute() >= 400;
    }
}
