@extends('layouts.base')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Applicant</h1>
    </div>
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <form class="user pb-5" method="POST" action="{{route('treatment.update')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="formGroupExampleInput" class="form-label">First Name</label>
                                <input name="fname" type="text" class="form-control " id="exampleInputEmail"
                                value="{{$data->fname}}" >
                            </div>
                            <div class="col-md-6">
                                <label for="formGroupExampleInput" class="form-label">Last Name</label>
                                <input name="lname" type="text" class="form-control " id="exampleInputEmail"
                                value="{{$data->lname}}" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="formGroupExampleInput" class="form-label">Place</label>
                        <input name="place" type="text" class="form-control " id="exampleInputEmail"
                        value="{{$data->place}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="formGroupExampleInput" class="form-label">Address</label>
                        <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3">{{$data->address}}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="formGroupExampleInput" class="form-label">Reason</label>
                        <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="3">{{$data->reason}}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="formGroupExampleInput" class="form-label">Amount</label>
                        <input name="amount" type="text" class="form-control " id="exampleInputEmail"
                        value="{{$data->amount}}">
                    </div>
                    <!-- <div class="form-group mb-3">
                        <label for="formGroupExampleInput" class="form-label">Status</label>
                        <select id="inputState" name="status" class="form-select ">
                            <option @if($data->Status == 'reject'){{"selected"}} @endif value="reject">Reject</option>
                            <option @if($data->status == 'accept'){{"selected"}} @endif value="accept">Accept</option>
                            <option @if($data->status == 'pending'){{"selected"}} @endif value="pending">Pending</option>
                            <option @if($data->status == 'priority'){{"selected"}} @endif value="priority">Priority</option>
                        </select>
                    </div> -->
                    <div class="form-group mb-3">
                        <label for="formGroupExampleInput" class="form-label">Priority</label>
                        <select id="inputState" name="priority" class="form-select ">
                            <option @if($data->priority == 'Low'){{"selected"}} @endif value="Low">Low</option>
                            <option @if($data->priority == 'Normal'){{"selected"}} @endif value="Normal">Normal</option>
                            <option @if($data->priority == 'High'){{"selected"}} @endif value="High">High</option>
                            <option @if($data->priority == 'Very Urgent'){{"selected"}} @endif value="Very Urgent">Very Urgent</option>
                        </select>
                    </div>
                    <hr>
                    <div class="row justify-content-center">
                    <div class="col-md-5">
                    <button type="submit" class="btn btn-facebook btn-block">
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