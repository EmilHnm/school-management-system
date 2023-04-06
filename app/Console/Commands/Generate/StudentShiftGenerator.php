<?php

namespace App\Console\Commands\Generate;

use Illuminate\Console\Command;

class StudentShiftGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generator:student-shift
                            {--year= : year, years range}
                            {--class= : class, classes range}
                            {--shift= : shift, shifts range}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
