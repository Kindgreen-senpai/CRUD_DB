@extends('layout')
@section('content')

<main>
<form action="/worker" method="POST">
@csrf
    <div class="card my-4">
        <h5 class="card-header">Create new worker</h5>
        <div class="card-body">
                <div class="form-group">
                    <label for="first_name">First name</label>
                    <input type="text" class="form-control" id="first_name" placeholder="Will" name="first_name" value="{{old('first_name')}}" >
                    @error('first_name')
                        <p class="text-danger text-xs mt-1">{{$message}}</p>                        
                    @enderror
                </div>
                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" class="form-control" id="last_name" placeholder="Smith" name="last_name" value="{{old('last_name')}}" >
                    @error('last_name')
                        <p class="text-danger text-xs mt-1">{{$message}}</p>                        
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Smith@gmail.com" name="email" value="{{old('email')}}" >
                    @error('email')
                        <p class="text-danger text-xs mt-1">{{$message}}</p>                        
                    @enderror
                </div>
                <div class="form-group">
                    <label for="job">Job</label>
                    <input type="text" class="form-control" id="job" placeholder="PHP developer" name="job" value="{{old('job')}}" >
                    @error('job')
                        <p class="text-danger text-xs mt-1">{{$message}}</p>                        
                    @enderror
                </div>
                <div class="form-group">
                    <label for="salary">Salary</label>
                    <input type="text" class="form-control" id="salary" placeholder="1000" name="salary" value="{{old('salary')}}" >
                    @error('salary')
                        <p class="text-danger text-xs mt-1">{{$message}}</p>                        
                    @enderror
                </div>
                <div class="form-group">
                    <label for="hire_date">Hire date</label>
                    <input type="text" class="form-control" id="hire_date" placeholder="02.01.2003" name="hire_date" value="{{old('hire_date')}}" >
                    @error('hire_date')
                        <p class="text-danger text-xs mt-1">{{$message}}</p>                        
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" placeholder="+38 097 883 0280" name="phone" value="{{old('phone')}}" >
                    @error('phone')
                        <p class="text-danger text-xs mt-1">The phone field format is invalid.</p>                        
                    @enderror
                </div>
        </div>
        <button type="submit" class="btn bg-dark text-white" style="margin: 0 1.25rem 1.25rem 1.25rem;">
            Create
        </button>
    </div>
</form>
</main>
@endsection