<?php
namespace Interfaces\Console\Commands;

use Domains\Account\User;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tests';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /** @var User $user */
        $user = (new \Users())->all()->first();

        $user->avatar = 'https://github.com/identicons/serafimarts.png';
    }
}
