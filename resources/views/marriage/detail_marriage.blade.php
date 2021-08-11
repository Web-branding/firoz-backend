@extends('layouts.base')
@section('content')
<div class="container-fluid col-12">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Details of the applicant</h6>
    </div>
    <div class="card-body">
      <form class="row g-3" method="POST">  
        @csrf 
        <input type="hidden" name="id" value="{{$data->id}}">
        <div class="col-12">
          <img src="{{asset('images')}}/{{$data->image}}" width="200px" height="200px" alt="Image">
        </div>
        <div class="col-12">
          <label for="inputAddress" class="form-label">Application Id</label>
          <input type="text" class="form-control" id="disabledTextInput" disabled value="{{$data->application_id}}">
        </div>
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">First Name</label>
          <input type="email" class="form-control" id="inputEmail4" disabled value="{{$data->fname}}">
        </div>
        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="inputPassword4" disabled value="{{$data->lname}}">
        </div>
        <div class="col-12">
          <label for="inputAddress" class="form-label">Place</label>
          <input type="text" class="form-control" id="inputAddress" disabled value="{{$data->place}}">
        </div>
        <div class="col-12">
          <label for="inputAddress2" class="form-label">Address</label>
          <textarea class="form-control" name="reason" disabled id="exampleFormControlTextarea1" rows="3">{{$data->address}}</textarea>
        </div>
        <div class="col-12">
          <label for="inputCity" class="form-label">Amount</label>
          <input type="text" class="form-control" disabled id="inputCity" value="{{$data->amount}}">
        </div>
        @if($data->reason)
        <div class="col-12">
          <label for="inputCity" class="form-label">Reason</label>
          <textarea class="form-control" name="reason" disabled id="exampleFormControlTextarea1" rows="3">{{$data->reason}}</textarea>
        </div>
        @endif
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Date of Submit</label>
          <input type="email" class="form-control" disabled id="inputEmail4" value="{{$data->created_at}}">
        </div>
        <div class="col-md-3">
          <label for="inputState" class="form-label">Status</label>
          <input type="text" class="form-control" disabled id="inputZip" value="{{$data->status}}">
        </div>
        <div class="col-md-3">
          <label for="inputZip" class="form-label">Priority</label>
          <input type="text" class="form-control" disabled id="inputZip" value="{{$data->priority}}">
        </div>
        <div class="mt-3 mb-3">
          <label for="inputPassword3" class="col-12">Reference Document</label>
          <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead style="background-color:#f8f9fc">
                <tr>
                  <th>Name</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                {{$data->ref_file}}  
                </td>
                <td>
                  <a target="_blank" href="{{route('file.view',$data->ref_file)}}" style="background-color:#eaecf4" class="btn btn-sm btn-circle">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                  </a>
                  <a href="{{route('file.download',$data->ref_file)}}" style="background-color:#eaecf4" class="btn btn-sm btn-circle">
                    <i class="fa fa-download" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
          <label for="inputPassword3" class="col-sm-3">Uploaded Documents</label>
          <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead style="background-color:#f8f9fc">
                <tr>
                  <th>Name</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              @php 
                $files = $data->file;
                $value = explode(",", $files); 
                $values = str_replace (array('[','"', ']'), '' , $value);
              @endphp
              @foreach($values as $d)
                <tr>
                  <td>
                    @php
                      if(strlen($d) > 30){
                        $str = substr($d, 0, 30) . '...'.'pdf';
                        echo $str;
                      }
                      else
                      {
                        echo $d;
                      }
                    @endphp  
                  </td>
                  <td>
                    <a target="_blank" href="{{route('file.view',$d)}}" style="background-color:#eaecf4" class="btn btn-sm btn-circle">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="{{route('file.download',$d)}}" style="background-color:#eaecf4" class="btn btn-sm btn-circle">
                      <i class="fa fa-download" aria-hidden="true"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="row mb-3 justify-content-end">
          <div class="col-md-3">
            <input type="submit" formaction="{{route('marriage.accept')}}" name="approve" value="Approve" class="btn btn-facebook btn-block">
          </div>
          <div class="col-md-3">
            <button type="button" name="reject" class="btn btn-facebook btn-block rejectbtn" value="{{$data->id}}">
              Reject
            </button>
          </div>
        </div>
      </form>
      <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Reason for rejection</h5>
            </div>
            <div class="modal-body">
              <form action="{{route('marriage.accept')}}" method="POST">
                @csrf
                <input type="hidden" id="reject_id" name="reject_id">
                <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="3" required></textarea>
                <div class="text-right mt-3">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
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
    $('.rejectbtn').click(function (e) {
        e.preventDefault();
        var id = $(this).val();
        $('#rejectModal').modal('show');
        $('#reject_id').val(id);
    });
});
</script>
@endsection