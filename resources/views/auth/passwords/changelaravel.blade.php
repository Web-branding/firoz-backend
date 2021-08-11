<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <title>Change Password</title>
    </head>
    <body>
    <header class="masthead">
        <div class="container">
            @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('error')}}
                </div>
            @endif
	        <div class="d-flex justify-content-center h-100">
                <div class="card">
                    <div class="card-header">
                        <h3>Change Password</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <div class=" form-group mb-3">
                                <label for="oldpassword" class="form-label text-white">Old Password</label>
                                <input id="oldpassword" placeholder="Enter your current password..." type="password" class="form-control @error('oldpassword') is-invalid @enderror" name="oldpassword" required autofocus>
                                @error('oldpassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class=" form-group mb-3">
                                <label for="password" class="form-label text-white">Password</label>
                                <input id="password" type="password" placeholder="Enter your new password..." class="value form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                            <div class=" form-group mb-3">
                                <label for="password-confirm" class="form-label text-white">Confirm Password</label>
                                <input id="password-confirm" type="password" placeholder="Enter your new password..." class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>                           
                            <div class="form-group">
                                <button type="button" class="btn change_btn update">
                                    Reset Password
                                </button>
                            </div>
                            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <div class="text-center">
                                                <i class="fa fa-exclamation-circle fa-5x" style="color:#f8bb86;" aria-hidden="true"></i>
                                            </div>
                                            <h3 class="modal-title text-center mb-3" id="exampleModalLabel">Are you sure?</h3>
                                            <div class="justify-content-center">
                                                <button type="button" style="color: #555;background-color: #efefef;" class="btn" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" title="delete" style="background-color: #e64942;color:#fff" class="btn">OK</button>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
	        </div>
        </div>
    </header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            
            $('.update').click(function (e) {
                e.preventDefault();
                // alert('hello');
                $('#updateModal').modal('show');
            
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>