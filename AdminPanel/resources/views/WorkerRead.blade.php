@extends('layout')
@section('content')    
  
<table class="table">
    <thead>
        <tr>
        <th>@sortablelink('id', 'ID') </th>
        <th>@sortablelink('first_name','First')</th>
        <th>@sortablelink('ast_name','Last')</th>
        <th>@sortablelink('email','Email')</th>
        <th>@sortablelink('job','Job')</th>
        <th>@sortablelink('salary','Salary')</th>
        <th>@sortablelink('hire_date','Hire date')</th>
        <th>@sortablelink('phone','Phone')</th>
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
            <td style="padding: .3rem;"> <a href="/worker/{{$worker->id}}/update" class="text-white btn btn-secondary">Edit</a></td>
            <td style="padding: .3rem;"> 
                <form style="display:inline" action="/worker/{{$worker->id}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white btn btn-danger">Delete</button>
                </form>
            </td>
            </tr>            
        @empty
        <tr>
            <td>No workers found</td>
        </tr>
        @endforelse
    </tbody>
    </table>
    <div class="d-flex justify-content-md-center">
        {!! $workers->appends(Request::except('page'))->render() !!}
    {{-- {{$workers->links()}}   --}}
    </div>
@endsection