<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function grammarClass()
    {
        return $this->belongsTo(GrammarClass::class);
    }

    public function tries()
    {
        return $this->hasMany(WordTry::class);
    }

    public function successRate(int $wordId)
    {
        $query = auth()->user()->tries()->where('word_id', $wordId);
        $totalTries = $query->count();
        if ($totalTries > 0){
            return round($query->where('result', 1)->count() * 100 / $totalTries);
        }
        return 0;
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
