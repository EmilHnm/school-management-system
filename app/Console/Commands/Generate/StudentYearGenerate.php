<?php

namespace App\Console\Commands\Generate;

use App\Models\StudentYear;
use Illuminate\Console\Command;

class StudentYearGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:student-year
    {--year= : year, years range}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a student year.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $years = $this->generateYear();
        foreach ($years as $year) {
            $this->info("Generate student year: {$year}");
            StudentYear::firstOrCreate([
                'name' => $year
            ]);
        }
        return Command::SUCCESS;
    }

    private function generateYear()
    {

        $year = $this->option('year') ?? date('Y');
        if (strpos($year, "-")) {
            list($min, $max) = explode("-", $year);
            $years = range($min, $max, 1);
        } else {
            $years = explode(",", $year);
        }
        return $years;
    }
}
