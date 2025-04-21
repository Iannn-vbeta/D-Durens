<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ETicketing extends Model
{
    protected $table = 'e_ticketing';
    protected $primaryKey = 'ticket_id';
    public $timestamps = false;

    protected $fillable = ['ticket_name', 'price', 'deskripsi'];

    public function pemesanan(): HasMany
    {
        return $this->hasMany(PemesananTiket::class, 'ticket_id');
    }
}