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
                            <div class="card-header">Create New Post</div>
                            <div class="card-body">
                                <form class="form-horizontal" method="post" action="create-post">
                                @csrf
                                
                                <div class="form-group">
                                <label class="control-label col-sm-2" for="title">Title : </label>
                                <div class="col-sm-10">
                                <input class="form-control" type="text" value="{{old('title')}}" name="title" placeholder="enter title">
                                <span style="color:red;">@error('title'){{$message}}@enderror</span><br>
                                </div></div>

                                <div class="form-group">
                                <label class="control-label col-sm-2" for="description">Description : </label>
                                <div class="col-sm-10">
                                <input class="form-control" type="text" value="{{old('description')}}" name="description" placeholder="enter description">
                                <span style="color:red;">@error('description'){{$message}}@enderror</span><br>
                                </div></div>

                                <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                <button class="btn btn-primary" type="submit">Create Post</button>
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