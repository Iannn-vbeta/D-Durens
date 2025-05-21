<?php

namespace App\Models;

use App\Models\PemesananTiket;
use Illuminate\Database\Eloquent\Model;

class StatusPemesanan extends Model
{
    protected $table = 'status_pemesanan';
    protected $primaryKey = 'status_id';
    public $timestamps = false;
    protected $fillable = [
        'status_name',
    ];
    public function pemesananTiket()
    {
        return $this->hasMany(PemesananTiket::class, 'status_id');
    }
}