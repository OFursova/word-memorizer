<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordTry extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
