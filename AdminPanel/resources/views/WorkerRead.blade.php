@extends('layout')
@section('content')    
  
<script>
    selected_workers = function () {

        var searchIDs = $('input:checked').map(function(){
            return $(this).val();
        });
        $('#delete_hidden').val(searchIDs.get())
    }
</script>
<table class="table">
    <thead>
        <tr>
        <th>@sortablelink('id', 'ID') </th>
        <th>@sortablelink('first_name','First')</th>
        <th>@sortablelink('last_name','Last')</th>
        <th>@sortablelink('email','Email')</th>
        <th>@sortablelink('job','Job')</th>
        <th>@sortablelink('salary','Salary')</th>
        <th>@sortablelink('hire_date','Hire date')</th>
        <th>@sortablelink('phone','Phone')</th>            
        <th style="padding: .3rem;"> 
            <form style="display:inline" action="/worker/" method="post">
                @csrf
                @method('DELETE')
                <input type="hidden" name="selected" id="delete_hidden">
                <button class="text-white btn btn-danger" onclick="selected_workers()"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
            </form>
            
        </th>
        <th></th>
        <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($workers as $worker)
            <tr>
            <th scope="row">{{$worker->id}}</th>
            <td> {{$worker->first_name}}</td>
            <td> {{$worker->last_name}}</td>
            <td> {{$worker->email}}</td>
            <td> {{$worker->job}}</td>
            <td> {{$worker->salary}}</td>
            <td> {{$worker->hire_date}}</td>
            <td> {{$worker->phone}}</td>
            <td> 
                <div class="form-check" style="margin: auto; width:  1.5rem;">
                    <input style="width: 1.5rem;height: 1.5rem; margin-top:0" class="form-check-input" type="checkbox" name="selected_workers[]" value="{{$worker->id}}">
                </div>
            </td>
            <td style="padding: .3rem;"> <a href="/worker/{{$worker->id}}/update" class="text-white btn btn-secondary"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a></td>
            </tr>            
        @empty
        <tr>
            <td>No workers found</td>
        </tr>
        @endforelse
    </tbody>
    </table>
    <div class="d-flex justify-content-md-center">
        {!! $workers->appends(Request::except('page'))->render("pagination::bootstrap-4") !!}
    </div>
@endsection