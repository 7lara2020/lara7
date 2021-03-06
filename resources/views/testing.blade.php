@extends('layouts.app')

@section('content')

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addMyModal">Open Modal</button>


<div class="modal fade" id="addMyModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Stuff</h4>
      </div>
      <div class="modal-body">
        <form role="form" id="newModalForm">
          <div class="form-group">
            <label class="control-label col-md-3" for="email">A p Name:</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="pName" name="pName" placeholder="Enter a p name" require/>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3" for="email">Action:</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="action" name="action" placeholder="Enter and action" require>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="btnSaveIt">Save</button>
            <button type="button" class="btn btn-default" id="btnCloseIt" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
// $(function() {

$("#newModalForm").validate({
  rules: {
	pName: {
	  required: true,
	  minlength: 8
	},
	action: "required"
  },
  messages: {
	pName: {
	  required: "Please enter some data",
	  minlength: "Your data must be at least 8 characters"
	},
	action: "Please provide some data"
  }
});
// });
</script>
@endpush
