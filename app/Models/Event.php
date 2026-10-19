<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['id_category', 'name', 'location', 'event_date', 'stock', 'price'];
    
    // Relasi ke Category (BelongsTo)
    public function category() {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }
}