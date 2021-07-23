@extends('layouts.base')
@section('content')
<div class="container-fluid">
    <!-- <a href="{{route('add.applicant')}}" class="btn btn-primary btn-icon-split mb-3">
        <span class="icon text-white-50">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </span>
        <span class="text">Add New Applicant</span>
    </a> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Application List</h6>
        </div>
        <div class="card-body">
            <form action="{{route('other.id')}}" class="form-inline mb-3 mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Application Id..." aria-label="Search" name="id"
                        aria-describedby="basic-addon2" autocomplete="off">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Application ID</th>
                            <th>Applicant name</th>
                            <th>Place</th>
                            <th>Date of submit</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($datas->isEmpty())
                            <tr>
                                <td colspan="7">No results found!</td>
                            <tr>
                        @else
                            @foreach($datas as $app)
                            <tr>
                                <td>{{$app->application_id}}</td>
                                <td>{{$app->fname}} {{$app->lname}}</td>
                                <td>{{$app->place}}</td>
                                <td>{{$app->created_at}}</td>
                                <td>
                                    @if($app->status === 'Approved')
                                        <div class="text-success">{{$app->status}}</div>
                                    @elseif($app->status === 'Pending')
                                        <div class="text-warning">{{$app->status}}</div>
                                    @else
                                        <div class="text-danger">{{$app->status}}</div>
                                    @endif
                                </td>
                                <td>{{$app->priority}}</td>
                                <td>
                                    <a href="{{route('other.edit',$app->id)}}" class="btn btn-success btn-sm btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </span>
                                        <span class="text">Edit</span>
                                    </a>
                                    <a href="{{route('other.show',$app->id)}}" class="btn btn-info btn-sm btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fa fa-info" aria-hidden="true"></i>
                                        </span>
                                        <span class="text">Details</span>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm btn-icon-split deletebtn" value="{{$app->id}}" >
                                        <span class="icon text-white-50">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </span>
                                        <span class="text">Delete</span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        @endif                      
                    </tbody>
                </table>
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form action="{{ route('other.destroy') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" id="delete_id" name="delete_id">
                                    <div class="text-center">
                                        <i class="fa fa-exclamation-circle fa-5x" style="color:#f8bb86;" aria-hidden="true"></i>
                                    </div>
                                    <h3 class="modal-title text-center" id="exampleModalLabel">Are you sure?</h3>
                                    <p class="text-center">Once deleted, you will not be able to recover this!</p>
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