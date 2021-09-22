<?php

namespace Database\Seeders;

use App\Models\GrammarClass;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('name', 'Admin')->value('id');

        $words = [
            [
                'name' => 'incentivize',
                'translation' => 'стимулировать',
                'other_meanings' => json_encode(['побуждать']),
                'grammar_class_id' => 1,
                'added_by' => $admin,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'infeasible',
                'translation' => 'невыполнимый',
                'other_meanings' => json_encode(['неосуществимый', 'неисполнимый']),
                'grammar_class_id' => 3,
                'added_by' => $admin,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'substantial',
                'translation' => 'существенный',
                'other_meanings' => json_encode(['значительный', 'важный', 'сытный', 'реальный', 'прочный', 'состоятельный']),
                'grammar_class_id' => 3,
                'added_by' => $admin,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'obnoxious',
                'translation' => 'неприятный',
                'other_meanings' => json_encode(['противный', 'отвратительный', 'несносный']),
                'grammar_class_id' => 3,
                'added_by' => $admin,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'yield',
                'translation' => 'доходность',
                'other_meanings' => json_encode(['урожай', 'выработка', 'сбор плодов', 'количество добытого продукта']),
                'grammar_class_id' => 2,
                'added_by' => $admin,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'concurrency',
                'translation' => 'совпадение',
                'other_meanings' => json_encode(['согласие', 'стечение обстоятельств', 'согласованность']),
                'grammar_class_id' => 2,
                'added_by' => $admin,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'quirk',
                'translation' => 'причуда',
                'other_meanings' => json_encode(['галтель', 'бзик', 'выверт', 'игра слов', 'каламбур', 'завиток', 'выкрутасы']),
                'grammar_class_id' => 2,
                'added_by' => $admin,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'mitigate',
                'translation' => 'смягчать',
                'other_meanings' => json_encode(['уменьшать', 'облегчать', 'умерять', 'успокаивать боль']),
                'grammar_class_id' => 1,
                'added_by' => $admin,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'collude',
                'translation' => 'вступать в сговор',
                'other_meanings' => json_encode(['тайно сговариваться']),
                'grammar_class_id' => 1,
                'added_by' => $admin,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'meander',
                'translation' => 'извилистый',
                'other_meanings' => json_encode(['змеится', 'извиваться', 'бродить без цели']),
                'grammar_class_id' => 8,
                'added_by' => $admin,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        $user_word_relations = [
            [
                'user_id' => 1,
                'word_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 1,
                'word_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 1,
                'word_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 1,
                'word_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 1,
                'word_id' => 5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 1,
                'word_id' => 6,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 1,
                'word_id' => 7,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 1,
                'word_id' => 8,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 1,
                'word_id' => 9,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 1,
                'word_id' => 10,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        $category_word_relations = [
            [
                'category_id' => 21,
                'word_id' => 8,
            ],
            [
                'category_id' => 9,
                'word_id' => 9,
            ],
            [
                'category_id' => 12,
                'word_id' => 10,
            ],
        ];

        DB::table('words')->insert($words);
        DB::table('user_word')->insert($user_word_relations);
        DB::table('category_word')->insert($category_word_relations);
    }
}
