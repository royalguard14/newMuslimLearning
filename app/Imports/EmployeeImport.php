<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\employeedata;
use App\Jobs\employeeimportJob;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Bus;
use Faker\Generator as Faker;
use DB;
use Auth;
use Hash;



//class EmployeeImport implements ToModel
class EmployeeImport implements ToCollection
{
    public $company;
    public $branches;
    public $users;

/**
   * @param array $row
   * @return int
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */

 public function __construct($company,$branches,$users)
    {
        $this->company = $company;
        $this->branches = $branches;
        $this->users = $users;
    }
    

public function collection(Collection $rows)
    {



   
unset($rows[0]);

        $company = $this->company;
        $branches = $this->branches;
        $users = $this->users;




$batch = Bus::batch([])->dispatch();

foreach($rows as $datafile){

    $datafile[] = $branches;
    
 
    if($datafile[26] == 'all'){

        $batch->add(new employeeimportJob($datafile,$users,$company,$branches));
    }else{

        $arc=DB::table('branches')->where('company_code',$company)->where('branch_code',$datafile[26])->first();
        if($datafile[8] == $arc->branch_arc){

             $batch->add(new employeeimportJob($datafile,$users,$company,$branches));

        }else{

            //do nothing
        }

    }

 
}
   

    }



// public function startRow(): int{
//     return 2;
// }
    

}
