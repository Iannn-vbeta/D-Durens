<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ketersediaan extends Model
{
    protected $table = 'ketersediaan';
    protected $primaryKey = 'ketersediaan_id';
    public $timestamps = false;

    protected $fillable = ['status'];

    public function inventaris(): HasMany
    {
        return $this->hasMany(Inventaris::class, 'ketersediaan_id');
    }
}