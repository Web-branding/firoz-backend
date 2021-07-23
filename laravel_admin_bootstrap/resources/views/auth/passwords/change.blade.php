@extends('layouts.base')
@section('content')
<div class="container col-md-7 ">
    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('error')}}
        </div>
    @endif
    <div class="card mb-4 shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="row mb-3">
                    <label for="oldpassword" class="col-sm-4 form-label">Old Password</label>
                    <div class="col-sm-8">
                        <input id="oldpassword" placeholder="Enter your current password..." type="password" class="form-control @error('oldpassword') is-invalid @enderror" name="oldpassword" required autofocus>
                        @error('oldpassword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-4 form-label">Password</label>
                    <div class="col-sm-8">
                        <input id="password" type="password" placeholder="Enter your new password..." class="value form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div> 
                <div class="row mb-3">
                    <label for="password-confirm" class="col-sm-4 form-label">Confirm Password</label>
                    <div class="col-sm-8">
                        <input id="password-confirm" type="password" placeholder="Enter your new password..." class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>                           
                <div class="row mb-3 justify-content-end">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-facebook update">
                            Change Password
                        </button>
                    </div>
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
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.update').click(function (e) {
                e.preventDefault();
                // alert('hello');
                $('#updateModal').modal('show');           
            });
        });
    </script>
@endsection