<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WorkersExport;
use App\Imports\WorkersImport;
use Illuminate\Validation\Rule;
use Propaganistas\LaravelPhone\PhoneNumber;
use Maatwebsite\Excel\Excel as ExcelExcel;

class WorkerController extends Controller
{
    function read(Request $request)  {

        $workers = Worker::sortable()->filter(request(['search']))->paginate(14);
        return view("WorkerRead",['workers'=>$workers]);
    }
    function create()  {
        return view("WorkerCreate");
    }
    function store(Request $request)  {
        $fields = $request->validate([
            'first_name'=>['required','regex:/^([^0-9]*)$/'],
            'last_name'=>['required','regex:/^([^0-9]*)$/'],
            'email'=>['required','email',Rule::unique('workers','email')],
            'job'=>['required'],
            'salary'=>['required','numeric','gt:0'],
            'hire_date'=>['required','before:today'],
            'phone'=>['required','phone']
        ]);
        $phone = new PhoneNumber($fields['phone']);
        $fields['phone']=$phone->formatE164();
        $fields['hire_date'] = date('Y-m-d', strtotime($fields['hire_date']));
        Worker::create($fields);
        return redirect('/');
    }
    function delete(Request $request)  {
        Worker::destroy(explode(",", $request->selected));
        return redirect('/');
    }
    function update(Worker $worker)  {
        return view("WorkerUpdate",['worker'=>$worker]);
    }
    function edit(Request $request, Worker $worker)  {        
        $fields = $request->validate([
            'first_name'=>['required','regex:/^([^0-9]*)$/'],
            'last_name'=>['required','regex:/^([^0-9]*)$/'],
            'email'=>['required','email',Rule::unique('workers','email')->ignore($worker->id)],
            'job'=>['required'],
            'salary'=>['required','numeric','gt:0'],
            'hire_date'=>['required','before:today'],
            'phone'=>['required','phone']
        ]);
        $phone = new PhoneNumber($fields['phone']);
        $fields['phone']=$phone->formatE164();
        $fields['hire_date'] = date('Y-m-d', strtotime($fields['hire_date']));
        $worker->update($fields);
        return redirect('/');
    }
    function delete_all()  {
        Worker::truncate();
        return redirect('/');
    }
    function export(Request $request) {
        return Excel::download(new WorkersExport($request),'workers.xlsx');
    }
    function file_upload()  {
        return view("WorkerFileUpload");
    }

    function import(Request $request) {
        $request->validate([
            'file' => 'required',
        ]);
        $file = $request->file('file');
        $workers = Excel::import(new WorkersImport(), $file,ExcelExcel::XLSX);
        
        return redirect('/');
    }

}
