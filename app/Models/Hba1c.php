<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sagalbot\Encryptable\Encryptable;

class Hba1c extends Model
{
    use HasFactory, Encryptable;

    protected $fillable = [
        'kadar_hba1c',
        'status',
        'user_id'
    ];

    protected $encryptable = [
        'kadar_hba1c',
        'status'];

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
