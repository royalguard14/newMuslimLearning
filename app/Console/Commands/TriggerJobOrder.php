<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ScheduleJobOrder;
use App\Models\ JobOrder;


class TriggerJobOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trigger:joborder';

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
        $today = Date('Y-m-d');

        $jobs = ScheduleJobOrder::byDate($today);

        if(!empty($jobs)){

            foreach($jobs as $job){
                $hash = \Hash::make($job->details);   
                $postdata['contact_id'] = $job->contact_id;
                $postdata['contact_person'] = $job->contact_person;
                $postdata['project_id'] = $job->project_id;
                $postdata['project_name'] = $job->project_name;
                $postdata['timetable_id'] = $job->timetable_id;
                $postdata['task_id'] = $job->task_id;
                $postdata['jo_workgroup'] = $job->jo_workgroup;
                $postdata['created_by'] = $job->created_by;            
                $postdata['assigned_to'] = $job->assigned_to;
                $postdata['details'] = $job->details;
                $postdata['status'] = $job->status;                                
                $postdata['start_date'] = $job->date;
                $postdata['end_date'] = $job->date;                
                $postdata['encryptname'] = str_replace("/","", $hash);
                $postdata['rating'] = 0;
                $postdata['onetime'] = 1;
                JobOrder::savePayload($postdata);

                $job->delete();
            }
        }
    }
}
