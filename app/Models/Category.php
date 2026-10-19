<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $primaryKey = 'id_category';
    protected $fillable = ['name'];

    // Relasi ke Event (One to Many)
    public function events() {
        return $this->hasMany(Event::class, 'id_category', 'id_category');
    }
}