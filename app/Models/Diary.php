<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sagalbot\Encryptable\Encryptable;

class Diary extends Model
{
    use HasFactory, SoftDeletes, Encryptable;

    protected $fillable = [
        'gambar_luka',
        'jenis_luka',
        'catatan_luka',
        'catatan',
        'user_id',
    ];

    protected $encryptable = [
        'jenis_luka',
        'catatan_luka',
        'catatan'];

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
