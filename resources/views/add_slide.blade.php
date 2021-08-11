@extends('layouts.base')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Slide</h1>
    </div>
    <hr>
    <div class="container mb-3">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <form class="user" method="POST" action="{{route('slide.add')}}" enctype="multipart/form-data">
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
                        <label for="formGroupExampleInput" class="form-label">Upload Slide</label>
                        <input name="file" type="file" class="form-control " id="exampleInputEmail">
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
