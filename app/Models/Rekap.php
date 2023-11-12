<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sagalbot\Encryptable\Encryptable;

class Rekap extends Model
{
    use HasFactory, Encryptable;

    protected $fillable = [
        "gula_darah",
        "kolesterol",
        "gambar_luka",
        "catatan_luka",
        "total_konsumsi_kalori",
        "total_pembakaran_kalori",
        "catatan",
        'user_id'
    ];

    protected $encryptable = [
        "gula_darah",
        "kolesterol",
        "gambar_luka",
        "catatan_luka",
        "total_konsumsi_kalori",
        "total_pembakaran_kalori",
        "catatan"];

    /**
     * Get the user that owns the Rekap
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
