<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Post Management<a href="{{ url('create-post')}}" style="float: right;"><button class="btn btn-primary">Create Post</button></a></div>
                <div class="card-body">
                   <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($posts))
                                @foreach($posts as $key => $post)
                                <tr row-selector="{{ $post['id']}}">
                                   
                                    <td>{{!empty($post->user['name']) ? $post->user['name'] : 'N/A' }}</td>
                                    <td>{{!empty($post->user['email']) ? $post->user['email'] : 'N/A' }}</td>
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
                {{ $posts->links('vendor.pagination.simple-default',['perPage'=>$perPage]) }}
            </div>
        </div>
    </div>
</div>

