<?php

namespace App\Console\Commands;

use App\Jobs\SanitizeQuizHistory;
use App\Jobs\SanitizeWordTriesHistory;
use Illuminate\Console\Command;

class SanitizeUserQuizHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quiz:sanitize {--qh|quiz_history} {--wt|word_tries}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes old data from quiz_history and word_tries tables';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->confirm('Do you wish to continue?')) {
            if ($this->option('quiz_history')) {
                dispatch(new SanitizeQuizHistory());
            } else if ($this->option('word_tries')) {
                dispatch(new SanitizeWordTriesHistory());
            } else {
                dispatch(new SanitizeQuizHistory());
                dispatch(new SanitizeWordTriesHistory());
            }
        }
        $this->info('The command was successful!');
    }
}
