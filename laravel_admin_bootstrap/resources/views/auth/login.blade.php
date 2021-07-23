<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <title>Login</title>
    </head>
    <body>
    <header class="masthead">
        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">       
                    {{Session::get('success')}}
                </div>
            @endif
	        <div class="d-flex justify-content-center h-100">
                <div class="card">
                    <div class="card-header">
                        <h3>Sign In</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class=" form-group mb-3">
                                <label for="formGroupExampleInput" class="form-label text-white">Email</label>
                                <!-- <input id="email" type="email" placeholder="Enter your Email id..." class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email"> -->
                                <input id="email" type="email" placeholder="Enter your Email id..." class="form-control" name="email" value="{{ old('email') }}" required autocomplete="off">                               
                            </div>
                            <div class=" form-group mb-3">
                                <label for="formGroupExampleInput" class="form-label text-white">Password</label>
                                <input id="password" type="password" placeholder="Enter your Password..." class="form-control @error('email') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                           
                            <div class="form-group">
                                <input type="submit" value="Login" class="btn float-right login_btn">
                            </div>
                        </form>
                    </div>
                </div>
	        </div>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>