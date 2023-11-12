<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sagalbot\Encryptable\Encryptable;

class KonsumsiMakanan extends Model
{
    use HasFactory, Encryptable;

    protected $fillable = [
        'makanan',
        'porsi',
        'kalori',
        'jenis_waktu_makan',
        'kadar_glukosa',
        'kadar_karbohidrat',
        'kadar_protein',
        'kandungan_gizi_lainnya',
        'user_id',
    ];

    protected $encryptable = [
        'makanan',
        'porsi',
        'kalori',
        'jenis_waktu_makan',
        'kadar_glukosa',
        'kadar_karbohidrat',
        'kadar_protein',
        'kandungan_gizi_lainnya'];

    /**
     * Get the owner that owns the UserRecordData
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
