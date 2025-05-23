<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Todo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function todos() {
        return $this->hasMany(Todo::class);
    }
}
