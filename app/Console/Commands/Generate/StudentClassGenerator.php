<?php

namespace App\Console\Commands\Generate;

use Illuminate\Console\Command;

class StudentClassGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:student-class
                            {--year= : year, years range}
                            {--class= : class, classes range}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a student class.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $classes = $this->generateRange($this->option('class') ?? '1-4');
        if ($this->option('year')) {
            $years = $this->generateRange($this->option('year'));
            foreach ($years as $year) {
                foreach ($classes as $class) {
                    $this->info("Generate student class: {$year}-{$class}");
                    StudentClass::firstOrCreate([
                        'name' => "{$year}-{$class}"
                    ]);
                }
            }
        }
        return Command::SUCCESS;
    }

    private function generateRange($range)
    {

        if (strpos($range, "-")) {
            list($min, $max) = explode("-", $range);
            $ranges = range($min, $max, 1);
        } else {
            $ranges = explode(",", $range);
        }
        return $ranges;
    }
}
