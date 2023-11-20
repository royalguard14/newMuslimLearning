<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\employeedata;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\DB;


use RegistersEventListeners;



class EmployeeExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents,WithColumnFormatting
{
//,WithHeadings,ShouldAutoSize,WithEvents,WithColumnFormatting
public $company;
public $branch_code;



   public function __construct($company,$branch_code)
    {
       
         $this->company = $company;
         $this->branch_code =  $branch_code;
         
     
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       
       $branch_codes = $this->branch_code;
       $company =   $this->company;
    
 

       $data=array();
//$users=DB::table('users')->where('company_code',$company)->whereIN('branch_code',$branch_codes)->get();
$users=DB::table('users')->get();
foreach ($users as $row) {

        //company and branch record
        //$branches=DB::table('branches')->where('company_code',$row->company_code)->where('branch_code',$row->branch_code)->first();
        $branches=DB::table('branches')->first();

        //employee data
       //$employdata=DB::table('employdata')->where('company_code',$row->company_code)->where('branch_code',$row->branch_code)->where('employee_id',$row->employee_id)->first();
         $employdata=DB::table('employdata')->first();

        //department name
        //$departments=DB::table('departments')->where('id',$row->department_id)->first();
         $departments=DB::table('departments')->first();
        //position name
         //$positions=DB::table('positions')->where('id',$row->position_id)->first();
         $positions=DB::table('positions')->first();



            $data[]=array(
            'employee_id'=>$row->employee_id,
            'salary_type'=>$employdata->salary_type,
            'tax_declared'=>$employdata->tax_declared,
            'last_name'=>$row->last_name,
            'first_name'=>$row->first_name,
            'middle_name'=>$row->middle_name,
            'suffix_name'=>$row->suffix_name,
            'member_since'=>$employdata->member_since,
            'branch_code'=>$branches->branch_name,
            'department_id'=>$departments->department,
            'position_id'=>$positions->position,
            'contract_start'=>$employdata->contract_start,
            'sss_id'=>$row->sss_id,
            'philhealth_id'=>$row->philhealth_id,
            'pagibig_id'=>$row->pagibig_id,
            'tin_id'=>$row->tin_id,
            'birthday'=>$row->birthday,
            'civilstatus'=>$row->civilstatus,
            'gender'=>$row->gender,
            'address'=>$row->address,
            'contact_number'=>$row->contact_number,
            'email_address'=>$row->email_address,
            'src'=>$employdata->src,
           



        );

     }

 return collect($data);


    }

 public function headings(): array
    {
        return [
                    'EMPLOYEENO',
                    'EMP_TYPE',
                    'MONTHLYSALARY',
                    'LASTNAME',
                    'FIRSTNAME',
                    'MIDDLENAME',
                    'SUFFIX',
                    'DATEHIRED',
                    'BRANCH',
                    'DEPARTMENT/DIVISION',
                    'POSITION',
                    'EMPLOYMENTSTATUS',
                    'SSSNO',
                    'PHILHEALTHNO',
                    'PAGIBIGNO',
                    'TAXIDNO',
                    'BIRTHDATE',
                    'CIVILSTATUS',
                    'GENDER',
                    'ADDRESS1',
                    //'ADDRESS2',
                    'MOBILENO',
                    'EMAILADDRESS',
                    'SRC',
        ];
    }


 public function registerEvents(): array
        {
        return [


            AfterSheet::class    => function(AfterSheet $event) 
            {

                       $cellRange = 'A1:X1'; // All headers
                       $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Calibri');
                       $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                       $cellRange = 'A1:A20'; // All headers
                       $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Calibri');

        
            },
              ];
       }






 
    public function columnFormats(): array
    {
        return [
            'M' => NumberFormat::FORMAT_NUMBER,
            'N' => NumberFormat::FORMAT_NUMBER,
            'O' => NumberFormat::FORMAT_NUMBER,
            'Q' => NumberFormat::FORMAT_DATE_YYYYMMDD2,
            'H' => NumberFormat::FORMAT_DATE_YYYYMMDD2,
            
        ];
    }





}
