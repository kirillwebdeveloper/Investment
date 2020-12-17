<?php

namespace App\Console\Commands;

use App\Entity\User;
use App\Service\UserRole\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ChangeUserPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:change:password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change Sudo User Password';

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
        $user = User::where(['email' => 'admin@admin.com'])->first();

        if (!$user) {
            echo 'User not exist exists.' . PHP_EOL;
            return false;
        }

        $user->update([
            'password' => bcrypt('admin'),
        ]);

        return 'Password changed' . PHP_EOL;
    }
}
