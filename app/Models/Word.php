<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Word extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'other_meanings' => 'array',
    ];

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
//        $query = auth()->user()->tries()->where('word_id', $wordId);
//        $totalTries = $query->count();
//        if ($totalTries > 0){
//            return round($query->where('result', 1)->count() * 100 / $totalTries);
//        }
//        return 0;

        return DB::table('word_tries')
            ->selectRaw('MAX(round((SELECT COUNT(id) FROM `word_tries` WHERE `user_id` = ? AND `word_id` = ? AND `result` = 1) * 100 / if((SELECT COUNT(id) FROM `word_tries` WHERE `user_id` = ? AND `word_id` = ?),(SELECT COUNT(id) FROM `word_tries` WHERE `user_id` = ? AND `word_id` = ?),1), 0)) as total', [auth()->id(), $wordId, auth()->id(), $wordId, auth()->id(), $wordId])
            ->value('total');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $model->added_by = auth()->id();
        });
    }
}
