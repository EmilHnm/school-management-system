<?php

namespace App\Console\Commands\Generate;

use App\Models\StudentClass;
use App\Models\StudentFaculty;
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
                            {--class= : class, classes range}
                            {--faculty= : faculty, faculties id range}}';

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
        $faculties = $this->generateRange($this->option('faculty') ?? 'all');
        $student_faculties = StudentFaculty::all();
        if ($this->option('year')) {
            $years = $this->generateRange($this->option('year'));
            foreach ($years as $year) {
                foreach ($classes as $class) {
                    $year_part = substr($year, -2);
                    if ($faculties[0] == 'all') {
                        $this->info("Generate student class: {$year}-{$class}");
                        foreach ($student_faculties as $faculty) {
                            $s_faculty = $this->createShortenName($faculty->name);
                            $this->info($year_part . $s_faculty . '000' . $class);
                            $stusent_class = StudentClass::firstOrCreate([
                                'name' => $year_part . $s_faculty . '000' . $class,
                            ], ['faculty_id' => $faculty->id]);
                            $stusent_class->save();
                        }
                    } else {
                        $student_faculties_range = $student_faculties->filter(
                            fn ($faculty) => $faculty->id >= $faculties[0] && $faculty->id <= $faculties[1]
                        );
                        $this->info("Generate student class: {$year}-{$class}");
                        foreach ($student_faculties_range as $faculty) {
                            $s_faculty = $this->createShortenName($faculty->name);
                            $stusent_class = StudentClass::firstOrCreate([
                                'name' => $year_part . $s_faculty . '000' . $class,
                            ], ['faculty_id' => $faculty->id]);
                            $stusent_class->save();
                        }
                    }
                }
            }
        }
        return Command::SUCCESS;
    }

    private function createShortenName($name)
    {
        $name = strtoupper($name);
        $model_name = str_replace("AND", "", $name);
        $model_name = str_replace("  ", " ", $model_name);
        $model_name = preg_replace('/\R/', '', $model_name);
        $sub = "";
        if (preg_match_all('/\b(\w)/', $model_name, $m)) {
            $sub = implode('', $m[1]);
            $sub = substr($sub, 0, 3);
            if (strlen($sub) < 3 && isset($m[1][1]))
                $sub = substr($model_name, 0, 2) . $m[1][1];
            if (strlen($sub) < 3)
                $sub = substr($model_name, 0, 2) . substr($model_name, -1);
        }
        return $sub;
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
