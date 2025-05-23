<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemesananTiket extends Model
{
    protected $table = 'pemesanan_tiket';
    protected $primaryKey = 'transaction_id';
    public $timestamps = false;

    protected $fillable = [
        'total_ticket',
        'transaction_date',
        'ordering_date',
        'user_id',
        'ticket_id',
        'status_pemesanan_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tiket(): BelongsTo
    {
        return $this->belongsTo(ETicketing::class, 'ticket_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(StatusPemesanan::class, 'status_pemesanan_id');
    }
}
