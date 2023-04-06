<?php

namespace App\Console\Commands\Import;

use App\Models\StudentFaculty;
use Illuminate\Console\Command;

class StudentFacultyImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:student-faculty {--path="https://swallowtail-school.vn/storage/faculties.txt" : path to file}';

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
        $path = $this->option('path');
        $this->info("Importing student-faculty from $path");
        $stream_opts = [
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
            ]
        ];

        $file = file_get_contents(
            $path,
            false,
            stream_context_create($stream_opts)
        );
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
