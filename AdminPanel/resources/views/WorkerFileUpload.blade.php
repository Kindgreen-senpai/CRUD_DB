@extends('layout')
@section('content')    
  
<main>
    <form action="/workers/import" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="card my-4">
            <h5 class="card-header">Import workers from Excel file</h5>

            <div class="card-body">                
                <div class="mb-3">
                    <input class="form-control form-control-lg" name="file" type="file" id="file">
                </div>
                @error('file')
                    <p class="text-danger text-xs mt-1">{{$message}}</p>                        
                @enderror
                
            </div>
            <button type="submit" class="btn bg-dark text-white" style="margin: 0 1.25rem 1.25rem 1.25rem;">
                Import
            </button>
        </div>
    </form>
    </main>
@endsection