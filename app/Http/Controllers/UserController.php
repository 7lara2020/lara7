<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\View;
use Auth;

class UserController extends Controller
{
    function userListing(Request $request)
    {
        $perPage = 5;
        if ($request->has('perPage')) {
            $perPage = (int) $request->perPage;
        }
        $users = User::paginate($perPage);

        if($request->ajax()){
            if (View::exists('user_listing')) {
                return view('user_listing',['users' => $users,'perPage' => $perPage]);
            }
        }

        if(View::exists('user_listing_main')) {
            return view('user_listing_main',['users' => $users,'perPage' => $perPage]);
        } else {
            return 'View not exists !!!!!!!!!!!!!!!!!!!!!!!!!!!!';
        }
    }

    function editUser(Request $req)
    {
        $user = User::find($req->user_id);
        $user->name = $req->user_name;
        $user->email = $req->user_email;
        if ($user->save()) {
            return response()->json([
                'status' => 'success',
                'user' => $user,
                'message' => 'Record Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $errors,
            ]);
        }
    }

    function deleteUser(Request $req)
    {
        $user = User::find($req->confirm_deleteid);
        if ($user->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Record Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Record Deletion Failed, pls try again',
            ]);
        }
    }

    function editProfile()
    {
        $user = Auth::user();
        if (View::exists('edit_profile')) {
            return view('edit_profile',['user' => $user]);
        } else {
            return 'view not exist';
        }
    }

    function saveProfile(Request $req)
    {
        $req->validate([
            'name' => 'required|min:10',
            'email' => 'required|email',
        ]);
        $user = User::find($req->id);
        $user->name = $req->name;
        $user->email = $req->email;
        if ($user->save()) {
            $req->session()->flash('success','Profile Updated Successfully');
            return redirect('edit-profile');
        } else {
            $req->session()->flash('error','Profile Updation Failed');
            return redirect('edit-profile');
        }
    }
}
