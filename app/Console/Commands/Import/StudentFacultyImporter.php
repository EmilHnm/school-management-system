<?php

namespace App\Console\Commands\Import;

use App\Models\StudentFaculty;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class StudentFacultyImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:student-faculty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import student-faculty from file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Importing student-faculty from file");
        $file = file_get_contents(storage_path('app/SourceFile/faculties.txt'), 'r');
        $faculties = explode("\n", $file);
        foreach ($faculties as $faculty) {
            if (empty($faculty)) {
                continue;
            }
            $this->info("Importing $faculty");
            StudentFaculty::firstOrCreate([
                'name' => $faculty
            ]);
        }
        return Command::SUCCESS;
    }
}
