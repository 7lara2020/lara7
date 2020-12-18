@extends('layouts.app')

@section('content')
<div class="container">
    <div id="showSentInquiryMsg"></div>
        <div id="ajaxList">
            @include('user_listing')
        </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Would you like to delete this record !!!!!!!!!!!!!!!!!!!!!
      </div>
      <input type="hidden" id="deleteId" type="text">
      <input type="hidden" id="selector" type="text">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="deleteConfirmation">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <label>Name :</label><p id="userName"></p><br>
    <label>Email :</label><p id="userEmail"></p> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <label>Name :</label><input type="text" placeholder="enter user name" id="userEditName" name="userEditName" class="form-control"><br>
          <label>Email :</label><input type="text" placeholder="enter user email" id="userEditEmail" name="userEditEmail" class="form-control"> 
          <input type="hidden" name="userEditId" id="userEditId" value="">
          <input type="hidden" name="userEditSelector" id="userEditSelector" value="">
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="updateUserData">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(document).on('click','#updateUserData', function(){
  var user_name = $("#userEditName").val();
  var user_email = $("#userEditEmail").val();
  var user_id = $("#userEditId").val();
  var user_selector = $("#userEditSelector").val();
  $.ajax({
                type : "POST",
                url : '{{route("editUser")}}',
                headers : {
                   'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                data : {user_name : user_name, user_email : user_email, user_id : user_id},
                datatype : 'JSON',
                success: function(result){
                    if(result.status==='success'){
                      // $('#editModal').modal('toggle');
                      // $(".modal-backdrop.in").remove();
                      var success_data = result.user;
                      $('td[name="' + user_selector + '"]').html(success_data.name);
                      $('td[email="' + user_selector + '"]').html(success_data.email);
                      $('td[id="' + user_selector + '"]').html(success_data.id);
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
    var selector = $(this).attr('selector');
    var userName = $('tr[selector="' + selector + '"] td[name="' + selector + '"]').html();
    var userEmail = $('tr[selector="' + selector + '"] td[email="' + selector + '"]').html();
    var userId = $('tr[selector="' + selector + '"] td[id="' + selector + '"]').html();
// alert(userName+'>>>>>>>>>>>>'+userEmail+'>>>>>>>>>>>>>'+userId);return false;
    $("#userEditName").val(userName);
    $("#userEditEmail").val(userEmail);
    $("#userEditId").val(userId);
    $("#userEditSelector").val(selector);
    // alert(selector);
});

$(document).on('click','.deleteModal', function(){
    var selector = $(this).attr('selector');
    var delete_id = $(this).attr('delete-id');
    $("#selector").val(selector);
    $("#deleteId").val(delete_id);
});

$(document).on('click','.viewModal', function(){
    var selector = $(this).attr('selector');
    var userName = $('tr[selector="' + selector + '"] td[name="' + selector + '"]').html();
    var userEmail = $('tr[selector="' + selector + '"] td[email="' + selector + '"]').html();
    // alert(userName +'>>>>>>>>>>>>'+ userEmail);
    $("#userName").html(userName);
    $("#userEmail").html(userEmail);
});

$(document).on('click','#deleteConfirmation', function(e){
    var confirm_selector =  $("#selector").val();
    var confirm_deleteid = $("#deleteId").val();

            $.ajax({
                type : "get",
                url : '{{route("deleteUser")}}',
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
                        $('tr[selector="' + confirm_selector + '"]').remove();
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