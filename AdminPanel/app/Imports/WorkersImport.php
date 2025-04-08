<?php

namespace App\Imports;

use App\Models\Worker;
use Maatwebsite\Excel\Concerns\ToModel;

class WorkersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Worker([
            'first_name'=> $row[0],
            'last_name'=> $row[1],
            'email'=> $row[2],
            'job'=> $row[3],
            'salary'=> $row[4],
            'hire_date'=> $row[5],
            'phone'=> $row[6],
        ]);
    }
}
