<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\GrammarClass;
use App\Models\Variant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            GrammarClassSeeder::class,
            CategorySeeder::class,
            WordSeeder::class,
            VariantSeeder::class,
        ]);
    }
}
