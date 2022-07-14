<?php

namespace App\Console;

use App\Actions\GetUsers;
use Illuminate\Console\Command;

class UpdateUsersCommand extends Command
{
    protected $signature = 'update:users';

    protected $description = 'Command description';

    public function handle()
    {
        app(GetUsers::class)->fetch();

        $this->info('Data Updated!');
    }
}
