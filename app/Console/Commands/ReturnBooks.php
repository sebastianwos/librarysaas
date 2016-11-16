<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class ReturnBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:return';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Return all books after max date of lending';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();
        foreach($users as $user){
            $user->booksToReturn()->detach();
        }
    }
}
