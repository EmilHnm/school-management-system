<?php

namespace App\Console\Commands\Generate;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AdminAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:admin {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for create password';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');
        if (empty($name) || empty($email) || empty($password)) {
            $this->error("Please input name, email and password");
            return Command::FAILURE;
        }
        $this->info("Generate admin account: {$name} {$email} {$password}");
        if (!User::where('email', $email)->exists()) {
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->usertype = 'Admin';
            $user->role = 'Admin';
            $user->status = 1;
            $user->save();
        } else {
            $this->error("Email {$email} already exists");
            return Command::FAILURE;
        }
        return Command::SUCCESS;
    }
}
