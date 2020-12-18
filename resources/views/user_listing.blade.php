<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">User Management</div>
                <div class="card-body">
                   <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($users))
                                @foreach($users as $user)
                                <tr selector="{{ 'row'.$user['id']}}">
                                    <td id="{{ 'row'.$user['id']}}">{{!empty($user['id']) ? $user['id'] : 'N/A' }}</td>
                                    <td name="{{ 'row'.$user['id']}}">{{!empty($user['name']) ? $user['name'] : 'N/A' }}</td>
                                    <td email="{{ 'row'.$user['id']}}">{{!empty($user['email']) ? $user['email'] : 'N/A' }}</td>
                                    <!-- <a href="{{ url('/user-edit/'.$user['id']) }}"></a> -->
                                    <td><button type="button" data-toggle="modal" data-target="#editModal" user-name="{{$user['name']}}" user-email="{{$user['email']}}" user-id="{{$user['id']}}" selector="{{ 'row'.$user['id']}}" class="btn btn-primary editModal">Edit</button>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal" delete-id="{{$user['id']}}" selector="{{ 'row'.$user['id']}}" class="btn btn-success deleteModal">Delete</button>
                                    <button type="button" data-toggle="modal" data-target="#viewModal" delete-id="{{$user['id']}}" selector="{{ 'row'.$user['id']}}" class="btn btn-info viewModal">View</button></td>
                                </tr>
                                @endforeach
                            @else
                            <p>No User Found !!!!!!!!!!!!!!!!!!!</p>
                            @endif
                        </tbody>
                   </table>
                </div>
                {{ $users->links('vendor.pagination.simple-default',['perPage'=>$perPage]) }}
            </div>
        </div>
    </div>
</div>

