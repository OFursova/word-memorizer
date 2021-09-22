<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrammarClass extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function words()
    {
        return $this->hasMany(Word::class);
    }
}
