<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function words()
    {
        return $this->hasMany(Word::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
}
