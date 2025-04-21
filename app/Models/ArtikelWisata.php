<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArtikelWisata extends Model
{
    protected $table = 'artikel_wisata';
    protected $primaryKey = 'article_id';
    public $timestamps = false;

    protected $fillable = ['title', 'description', 'created_at', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}