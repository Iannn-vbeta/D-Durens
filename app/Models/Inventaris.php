<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventaris extends Model
{
    protected $table = 'inventaris';
    protected $primaryKey = 'inventory_id';
    public $timestamps = false;

    protected $fillable = [
        'item_name', 'amount', 'user_id', 'category_id', 
        'ketersediaan_id', 'kelayakan_id', 'deskripsi'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriBarang::class, 'category_id');
    }

    public function ketersediaan(): BelongsTo
    {
        return $this->belongsTo(Ketersediaan::class, 'ketersediaan_id');
    }

    public function kelayakan(): BelongsTo
    {
        return $this->belongsTo(Kelayakan::class, 'kelayakan_id');
    }
}