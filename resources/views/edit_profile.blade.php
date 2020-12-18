@extends('layouts.app')
@section('content')
<div class="container">
    <div id="showSentInquiryMsg"></div>
        <div id="ajaxList">
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
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Edit Profile Details</div>
                            <div class="card-body">
                                <form class="form-horizontal" method="post" action="save_profile">
                                @csrf
                                <input type="hidden" name="id" value="{{$user['id']}}">
                                <div class="form-group">
                                <label class="control-label col-sm-2" for="name">Name : </label>
                                <div class="col-sm-10">
                                <input class="form-control" type="text" value="{{$user['name']}}" name="name" placeholder="enter user name">
                                <span style="color:red;">@error('name'){{$message}}@enderror</span><br>
                                </div></div>

                                <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Email : </label>
                                <div class="col-sm-10">
                                <input class="form-control" type="text" value="{{$user['email']}}" name="email" placeholder="enter user email">
                                <span style="color:red;">@error('email'){{$message}}@enderror</span><br>
                                </div></div>

                                <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                <button class="btn btn-primary" type="submit">Submit</button>
                                </div></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

@push('scripts')
<script>

</script>
@endpush