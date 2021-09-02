@extends('layouts.base')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Video</h1>
    </div>
    <hr>
    <div class="container mb-3">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <form class="user" method="POST" action="{{route('video.add')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="formGroupExampleInput" class="form-label">Title</label>
                        <input name="title" type="text" class="form-control " id="exampleInputEmail"
                            placeholder="Title...">
                    </div>
                    <div class="form-group mb-3">
                        <label for="formGroupExampleInput" class="form-label">Description</label>
                        <textarea class="form-control" name="description" placeholder="Description..." id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="formGroupExampleInput" class="form-label">Upload Video</label>
                        <input name="video" type="file" class="form-control " id="exampleInputEmail">
                    </div>
                    <div class="form-group mb-3 increment">
                        <label for="formGroupExampleInput" class="col-sm-4 col-form-label">Upload Documents</label>
                        <div class="input-group">
                            <input type="file" name="file[]" class="myfrm form-control " id="exampleInputEmail"> 
                            <button class="btn bg-gradient-success text-white border-0 add-file" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>
                        <!-- <div id="emailHelp" class="form-text">Upload documents in pdf</div> -->
                    </div>
                    <div class="form-group clone d-none">
                        <div class="remove control-group lst input-group" style="margin-top:10px;margin-bottom:10px">
                            <input type="file" name="file[]" class="myfrm form-control">
                            <div class="input-group-btn"> 
                            <button class="btn btn-danger" type="button"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
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