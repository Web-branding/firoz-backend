@extends('layouts.base')
@section('content')
<div class="container-fluid">
    <a href="{{route('add.slide')}}" class="btn btn-primary btn-icon-split mb-3">
        <span class="icon text-white-50">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </span>
        <span class="text">Add New Slide</span>
    </a>
    @if(Session::has('add'))
        <div class="alert alert-success" role="alert">
            {{Session::get('add')}}
        </div>
    @endif
    @if(Session::has('delete'))
        <div class="alert alert-success" role="alert">
            {{Session::get('delete')}}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Slide List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color:#f8f9fc">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th style="width:25px">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($slides as $slide)
                            <tr>
                                <td>{{$slide->title}}</td>
                                <td>{{$slide->description}}</td>
                                <td><img src="{{asset('slides')}}/{{$slide->file}}" width="80px" height="80px" alt="Image"></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm btn-icon-split deletebtn" value="{{$slide->id}}" >
                                        <span class="icon text-white-50">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </span>
                                    </button>  
                                </td>  
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form action="{{ route('slide.destroy') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" id="delete_id" name="delete_id">
                                    <div class="text-center">
                                        <i class="fa fa-exclamation-circle fa-5x" style="color:#f8bb86;" aria-hidden="true"></i>
                                    </div>
                                    <h3 class="modal-title text-center" id="exampleModalLabel">Are you sure?</h3>
                                    <div class="text-right">
                                        <button type="button" style="color: #555;background-color: #efefef;" class="btn" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" title="delete" style="background-color: #e64942;color:#fff" class="btn">OK</button>  
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $('.deletebtn').click(function (e) {
        e.preventDefault();
        // alert('hello');
        var id = $(this).val();
        // alert(id);
        $('#deleteModal').modal('show');
        $('#delete_id').val(id);
    });
});
</script>
@endsection