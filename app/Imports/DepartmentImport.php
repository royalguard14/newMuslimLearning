<?php
namespace App\Imports;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

use Illuminate\Support\Facades\Log;

class DepartmentImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        

        foreach ($rows as $row){

            

            $guard=DB::table('branches')->where('company_code','0002')->where('branch_arc',$row['branch'])->first();

            if ($guard == null){
                //ignore if wlang mahanap... need manual input ng branch
                 \Log::channel('error_found')->info('No Branch '.$row['branch'].' found (Dept Job)');

            }else{

            $deptguard=DB::table('departments')->where('Company_code',$guard->company_code)->where('Branch_code',$guard->branch_code)->where('department',$row['departmentdivision'])->first();
                    

                if($deptguard==null){
                    DB::table('departments')->insert([
                        'Company_code'=>$guard->company_code,
                        'Branch_code'=>$guard->branch_code,
                        'department'=>$row['departmentdivision'],
                        'encoder'=>'admin19|admin28|null'
                    ]);

                    \Log::channel('department_adding')->info($row['number'].' saved '.$row['branch'].' - '.$row['departmentdivision']);

                        }else{


                \Log::channel('department_adding')->info($row['number'].' repeated '.$row['branch'].' - '.$row['departmentdivision']);                          
                        $postguard=DB::table('positions')->where('company_code',$deptguard->Company_code)->where('branch_code',$deptguard->Branch_code)->where('department_id',$deptguard->id)->where('position',$row['position'])->first();

                        if($postguard==null){ 
                    DB::table('positions')->insert([
                    'company_code'=>$deptguard->Company_code,
                    'branch_code'=>$deptguard->Branch_code,
                    'department_id'=>$deptguard->id,
                    'position'=>$row['position'],
                    'dleavecount'=>'1',
                    'encoder'=>'admin19|admin28'
                                  ]);

                        \Log::channel('position_adding')->info($row['number'].' saved '.$row['branch'].' - '.$row['departmentdivision'].''.$row['position']);

                            }else{

                                  \Log::channel('position_adding')->info($row['number'].' Repeated '.$row['branch'].' - '.$row['departmentdivision'].''.$row['position']);
                                  }


                    }
            }

           
        }//rows
    }
    public function headingRow(): int
    {
        return 1;
    }
}
