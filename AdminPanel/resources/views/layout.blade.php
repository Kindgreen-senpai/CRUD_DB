<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
    <style>
        .container{
            max-width: 1300px;
        }
    </style>
</head>
<body>
@auth
<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 me-lg-auto justify-content-center mb-md-0 ">
                <li class="px-1"><a href="/" class="nav-link px-2 text-white"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                <li class="px-1"><a href="/worker/create" class="nav-link px-2 text-white"><i class="fa fa-plus" aria-hidden="true"></i> Add worker</a></li>
                <li class="px-1">
                    <form action="/workers/delete" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-link nav-link px-2 text-white"><i class="fa fa-trash" aria-hidden="true"></i> Delete all</button>
                    </form>
                </li>
                <li class="px-1">                    
                    @php
                    $request = request();
                    $params="";
                    if( $request->has('category') && $request->has('search')) {
                        $params="?category=".$request->category."&"."search=".$request->search;
                    }
                    @endphp
                    <form action="/workers/export{{$params}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link px-2 text-white"><i class="fa fa-download" aria-hidden="true"></i> Export to Excel</button>
                    </form>
                </li>
                <li class="px-1"><a href="/workers/file_upload" class="nav-link px-2 text-white"><i class="fa fa-upload" aria-hidden="true"></i> Import from Excel</a></li>
                <li class="px-1"><a href="/logout" class="nav-link px-2 text-white"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
            </ul>
            
            @if(Route::current()->uri()=='/')
            <div class="col-12 mb-lg-0">
                <form submit="/" method="GET" class="d-flex">
                    @csrf
                    <div class="input-group">
                        <select class="btn btn-light dropdown-toggle" name="category">
                            <option value="id" selected>ID</option>
                            <option value="first_name">First</option>
                            <option value="last_name">Last</option>
                            <option value="email">Email</option>
                            <option value="job">Job</option>
                            <option value="salary">Salary</option>
                            <option value="hire_date">Hire date</option>
                            <option value="phone">Phone</option>
                          </select>
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="search" value="{{old('search')}}">
                        <button class="btn btn-secondary" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                    </div>
                </form>
            </div>
                 @endif
        </div>
    </div>
</header>
    <main class="container">
        @yield('content')
    </main>

@elseguest
    <main class="container" style="margin-top: 16rem; width: 26rem;">
        <form action="/authorize" method="GET">
        @csrf
            <div class="card my-4">
                <h5 class="card-header">Authorize</h5>
                <div class="card-body">
                        <div class="form-group">
                            <label for="name">Login</label>
                            <input type="text" class="form-control" id="name"  name="name" >
                            @error('name')
                                <p class="text-danger text-xs mt-1">INVALID INPUT</p>                        
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" >
                        </div>
                </div>
                <button type="submit" class="btn bg-dark text-white" style="margin: 0 1.25rem 1.25rem 1.25rem;">
                    Login
                </button>
            </div>
        </form>
        </main>
@endauth 
</body>
</html>