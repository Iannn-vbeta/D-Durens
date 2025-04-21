<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelayakan extends Model
{
    protected $table = 'kelayakan';
    protected $primaryKey = 'kelayakan_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['kelayakan_id', 'status'];

    public function inventaris(): HasMany
    {
        return $this->hasMany(Inventaris::class, 'kelayakan_id');
    }
}