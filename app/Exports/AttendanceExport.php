<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class AttendanceExport implements FromCollection
{
    public $type;
    /**
    * @return \Illuminate\Support\Collection
    */


   public function __construct($type)
    {
        $this->type = $type;
     
    }
    

    public function collection()
    {


        $type=$this->type;
        // $data=DB::table('tax_contribution')->where('type','daily')->select(DB::raw('type as type'))->get();
         $data=DB::table('tax_contribution')->where('type', $type)->get();
        return $data;

    }




}
