<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AccessControl;
use App\Models\User;

class UpdateAccessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:access_all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
     
        $users = User::all();

        foreach ($users as $key => $value) {
            
            $check = AccessControl::where('user_id',$value->id)->where('module_id',16)->count();
            if($check < 1){

                $access = new AccessControl();
                $access->user_id = $value->id;
                $access->module_id = 16;
                $access->save(); 
            }                    
        }        
    }
}
