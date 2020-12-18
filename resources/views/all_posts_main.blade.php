@extends('layouts.app')

@section('content')
<div class="container">
                        @if(session('success'))
                        <div>
                        <span style="color:green">{{session('success')}}</span>
                        </div>
                        @endif

                        @if(session('error'))
                        <div>
                        <span style="color:red">{{session('error')}}</span>
                        </div>
                        @endif
    <div id="showSentInquiryMsg"></div>
        <div id="ajaxList">
        <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Our All Post</div>
                <div class="card-body">
                   <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($posts))
                                @foreach($posts as $key => $post)
                                <tr row-selector="{{ $post['id']}}">
                                   
                                    <td>{{!empty($post['title']) ? $post['title'] : 'N/A' }}</td>
                                    <td>{{!empty($post['description']) ? $post['description'] : 'N/A' }}</td>
                                   
                                    <td><button type="button" data-toggle="modal" data-target="#editModal" class="btn btn-primary editModal">Edit</button>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-success deleteModal">Delete</button>
                                    <button type="button" data-toggle="modal" data-target="#viewModal" class="btn btn-info viewModal">View</button></td>
                                </tr>
                                @endforeach
                            @else
                            <p>No User Found !!!!!!!!!!!!!!!!!!!</p>
                            @endif
                        </tbody>
                   </table>
                </div>
               
            </div>
        </div>
    </div>
</div>


        </div>
</div>

<div class="modal fade" id="viewModal_coming" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Post Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <label>Title :</label><p id="postTitle"></p><br>
    <label>Description :</label><p id="postDescription"></p> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal_coming" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Would you like to delete this Post........
      </div>
      <input type="hidden" id="deleteId" type="text">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="deleteConfirmation">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal_coming" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" id="editModalForm">
        <div class="modal-body">
          <label>Title :</label><input type="text" placeholder="enter post title" id="editPostTitle" name="editPostTitle" class="form-control"><br>
          <label>Description :</label><input type="text" placeholder="enter post description" id="editPostDescription" name="editPostDescription" class="form-control"> 
          <input type="hidden" name="editPostId" id="editPostId" value="">
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="updatePostData">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(document).on('click','#updatePostData', function(){
  var post_title = $("#editPostTitle").val();
  var post_description = $("#editPostDescription").val();
  var post_id = $("#editPostId").val();
  $.ajax({
                type : "POST",
                url : '{{route("editPost")}}',
                headers : {
                   'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                data : {post_title : post_title, post_description : post_description, post_id : post_id},
                datatype : 'JSON',
                success: function(result){
                    if(result.status==='success'){
                      // $('#editModal').modal('toggle');
                      // $(".modal-backdrop.in").remove();
                      var success_data = result.post;
                      $('tr[row-selector="' + post_id + '"]').find('td:eq(2)').html(success_data.title);
                      $('tr[row-selector="' + post_id + '"]').find('td:eq(3)').html(success_data.description);
                      $('#showSentInquiryMsg').addClass("alert alert-success").html('');
                      $('.alert-success').append('<li>' + result.message + '</li>');
                        $("#showSentInquiryMsg.alert").fadeTo(2000, 500).slideUp(500, function () {
                            $("#showSentInquiryMsg.alert").slideUp(500);
                        });
                    }else{
                      $('#showSentInquiryMsg').addClass("alert alert-danger").html('');
                      $('.alert-danger').append('<li>' + result.message + '</li>');
                        $("#showSentInquiryMsg.alert").fadeTo(2000, 500).slideUp(500, function () {
                            $("#showSentInquiryMsg.alert").slideUp(500);
                        });
                    }
                },
                error: function (xhr, status, error) {
                    $('#showSentInquiryMsg').find('.alert-dismissable').remove();
                    $('#showSentInquiryMsg').prepend('<div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>Alert! </strong>' + error + '</div>');
                    $("#showSentInquiryMsg .alert").fadeTo(2000, 500).slideUp(500, function () {
                        $("#showSentInquiryMsg .alert").slideUp(500);
                    });
                }
            });
});
    
</script>
<script type="text/javascript">
$(document).on('click','.editModal', function(){
    var post_title = $(this).closest('tr').find('td:eq(2)').html();
    var post_description = $(this).closest('tr').find('td:eq(3)').html();
    var edit_selector = $(this).closest('tr').attr('row-selector');
    $("#editPostTitle").val(post_title);
    $("#editPostDescription").val(post_description);
    $("#editPostId").val(edit_selector);
});

$(document).on('click','.deleteModal', function(){
    var delete_selector = $(this).closest('tr').attr('row-selector');
    $("#deleteId").val(delete_selector);
});

$(document).on('click','.viewModal', function(){
    var post_title = $(this).closest('tr').find('td:eq(2)').html();
    var post_description = $(this).closest('tr').find('td:eq(3)').html();
    $("#postTitle").html(post_title);
    $("#postDescription").html(post_description);
});

$(document).on('click','#deleteConfirmation', function(e){
    var confirm_deleteid = $("#deleteId").val();

            $.ajax({
                type : "get",
                url : '{{route("deletePost")}}',
                // headers : {
                //    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                // },
                data : {confirm_deleteid : confirm_deleteid},
                datatype : 'JSON',
                success: function(result){
                    if(result.status === 'success'){
                      e.preventDefault();
                      // $( '#deleteModal' ).modal( 'hide' ).data( 'bs.modal', null );
                      $('body').removeClass('modal-open')
                      $('.modal-backdrop').remove()  
                      $('#deleteModal').modal('toggle');
                        $('tr[row-selector="' + confirm_deleteid + '"]').remove();
                        $('#showSentInquiryMsg').addClass("alert alert-success").html('');
                        $('.alert-success').append('<li>' + result.message + '</li>');
                        $("#showSentInquiryMsg.alert").fadeTo(2000, 500).slideUp(500, function () {
                            $("#showSentInquiryMsg.alert").slideUp(500);
                        });
                    }else{
                        $('#showSentInquiryMsg').addClass("alert alert-danger").html('');
                        $('.alert-danger').append('<li>' + result.message + '</li>');
                        $("#showSentInquiryMsg.alert").fadeTo(2000, 500).slideUp(500, function () {
                            $("#showSentInquiryMsg.alert").slideUp(500);
                        });
                    }
                },
                error: function (xhr, status, error) {
                }
            });
});

function getData(page, perPage) {
        if (!page) {
            var page = 1;
            if (window.location.hash) {
                page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    page = 1;
                }
            }
        }

        if (!perPage) {
            perPage = $("#showPerPage").val();
        }

        $.ajax({
                    url: '?page=' + page + '&perPage=' + perPage,
                    type: "get",
                    datatype: "html"
                }).done(function (data) {
					
            $("#ajaxList").empty().html(data);
            location.hash = page;
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            alert('No response from server');
        });
    }

$(document).on('click','.pagination a', function(event){
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var myurl = $(this).attr('href');
        var page = $(this).attr('href').split('page=')[1];
        getData(page);
    });

    $(document).on('change', '#showPerPage', function (event) {
        event.preventDefault();
        if (!$(this).val()) {
            return false;
        }
        getData(null, $(this).val());
    });

</script>
@endpush