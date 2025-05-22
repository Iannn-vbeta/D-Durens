<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusPemesanan extends Model
{
    protected $table = 'status_pemesanan';
    protected $primaryKey = 'status_id';
    public $timestamps = false;

    protected $fillable = [
        'status_name'
    ];

    public function pemesananTikets(): HasMany
    {
        return $this->hasMany(PemesananTiket::class, 'status_id');
    }
}
