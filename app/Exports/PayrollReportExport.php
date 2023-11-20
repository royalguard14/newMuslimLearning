<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class PayrollReportExport implements FromCollection
{
    public $data;
    public $data1;
    public $data2;
    /**
    * @return \Illuminate\Support\Collection
    */



   public function __construct($data)
    {
        $this->data = $data;
         $this->data1 = $data1;
          $this->data2 = $data2;
     
    }
    

    public function collection()
    {
         $data=$this->data;
         $data1=$this->data1;
         $data2=$this->data2;

        return $this;
    }



    public function headings(): array
    {
        // return [
        //     'Name On Card',
        //     'Card No.',
        //     'Exp Month',
        //     'Exp. Year',
        //     'CVV',
        // ];
    }


    public function map($payrollreports): array
    {
        // return [
        //     $payrollreports->name_on_card,
        //     'XXXXXXXXXXXX' . substr($transaction->card_no, -4, 4),
        //     $transaction->exp_month,
        //     $transaction->exp_year,
        //     $transaction->cvv,
        // ];
    }


}
