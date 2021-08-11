@extends('layouts.base')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Applicant</h1>
    </div>
    <div class="container mb-3">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <form class="user" method="POST" action="{{route('applicant.add')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="formGroupExampleInput" class="form-label">First Name</label>
                                <input name="fname" type="text" class="form-control " id="exampleInputEmail"
                                placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                                <label for="formGroupExampleInput" class="form-label">Last Name</label>
                                <input name="lname" type="text" class="form-control " id="exampleInputEmail"
                                placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="formGroupExampleInput" class="form-label">Place</label>
                        <input name="place" type="text" class="form-control " id="exampleInputEmail"
                            placeholder="Place">
                    </div>
                    <div class="form-group mb-3">
                        <label for="formGroupExampleInput" class="form-label">Address</label>
                        <textarea class="form-control" name="address" placeholder="Address" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="formGroupExampleInput" class="form-label">Reason</label>
                        <textarea class="form-control" name="reason" placeholder="Reason" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="formGroupExampleInput" class="form-label">Amount</label>
                        <input name="amount" type="number" class="form-control " id="exampleInputEmail"
                            placeholder="Amount">
                    </div>
                    <div class="form-group mb-3">
                        <label for="formGroupExampleInput" class="form-label">Priority</label>
                        <select id="inputState" name="priority" class="form-select ">
                            <option selected>Choose...</option>
                            <option value="Low">Low</option>
                            <option value="Normal">Normal</option>
                            <option value="High">High</option>
                            <option value="Very Urgent">Very Urgent</option>
                        </select>
                    </div>
                    <div class="form-group mb-3 increment">
                        <label for="formGroupExampleInput" class="form-label">Upload File</label>
                        <div class="input-group">
                        <input type="file" name="file[]" class="myfrm form-control " id="exampleInputEmail"> 
                            <button class="btn btn-primary add-file" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <div class="clone d-none">
                        <div class="remove control-group lst input-group" style="margin-top:10px">
                            <input type="file" name="file[]" class="myfrm form-control">
                            <div class="input-group-btn"> 
                            <button class="btn btn-danger" type="button"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-primary btn-block">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $('.add-file').click(function (e) {
        e.preventDefault();
        // alert('hello');
        var data = $(".clone").html();
        $(".increment").after(data);
        $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".remove").remove();
      });
    });
});
</script>
@endsection