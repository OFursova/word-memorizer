<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected $relations = ['words'];

    public function words()
    {
        return $this->belongsToMany(Word::class);
    }

    public function tries()
    {
        return $this->hasMany(WordTry::class);
    }

    public function quizHistory()
    {
        return $this->hasMany(QuizHistory::class);
    }

    public function successRate()
    {
//        $query = $this->hasMany(WordTry::class);
//        $totalTries = $query->count();
//        if ($totalTries > 0){
//            return round($query->where('result', 1)->count() * 100 / $totalTries);
//        }
//        return 0;

        return DB::table('word_tries')
            ->selectRaw('MAX(round((SELECT COUNT(id) FROM `word_tries` WHERE `user_id` = ? AND `result` = 1) * 100 / if((SELECT COUNT(id) FROM `word_tries` WHERE `user_id` = ?),(SELECT COUNT(id) FROM `word_tries` WHERE `user_id` = ?),1), 0)) as total', [auth()->id(), auth()->id(), auth()->id()])
            ->value('total');
    }
}
