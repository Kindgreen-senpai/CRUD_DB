<?php

namespace App\Exports;

use App\Models\Worker;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class WorkersExport implements WithColumnWidths, WithColumnFormatting, FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    // protected $request;

    public function __construct()
    {
        // $this->request = $request;
    }

    public function collection()
    {
        
        $workers = Worker::filter(request(['search']))->get();
        return $workers;
    }
    public function headings(): array
    {
        return [
            'ID',
            'First',
            'Last',
            'Email',
            'Job',
            'Salary',
            'Hire date',
            'Phone',
        ];
    }
    
    public function map($worker): array
    {
        // dd($worker->phone);
        return [
            $worker->id,
            $worker->first_name,
            $worker->last_name,
            $worker->email,
            $worker->job,
            $worker->salary,
            $worker->hire_date,
            (string)$worker->phone,
        ];
    }
    
    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => '+#',
        ];
    }
    
    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 12,   
            'C' => 12,   
            'D' => 35,   
            'E' => 15,   
            // 'F' => 5,   
            'G' => 10,   
            'H' => 13,            
        ];
    }
}
