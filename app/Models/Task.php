<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'id_category', 'completed'];

    public function category() {
        return $this->belongsTo(Category::class, 'id_category');
    }
}
