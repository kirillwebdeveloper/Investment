<?php

namespace App\Console\Commands;

use App\Entity\User;
use App\Service\UserRole\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateSudoUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create:sudo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Sudo User';

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
     * @return bool|string
     * @throws \Exception
     */
    public function handle()
    {
        if (User::where(['email' => 'sudo@admin.com'])->first()) {
            echo 'User already exists.' . PHP_EOL;
            return false;
        }

        $user = User::create([
            'name'              => 'Sudo',
            'email'             => 'sudo@admin.com',
            'password'          => bcrypt('sudo'),
            'roles'             => [Role::ROLE_SUDO],
            'remember_token'    => Str::random(10),
            'email_verified_at' => now()
         ]);

        if ($user) {
            echo $user->name . ' - SUCCESS!' . PHP_EOL;
            return false;
        }

        return 'Cannot create user :(' . PHP_EOL;
    }
}
