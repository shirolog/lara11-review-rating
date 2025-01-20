<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

//registerページに関する記述

    public function register(){

        return view('register');
    }

    public function register_store(Request $request){

        $validator = Validator::make($request->all(),[

            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:3',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);


        if($request->hasFile('image') && $request->file('image')->getSize() > 2000000) {
            session()->flash('warning', 'Image size is too large!');

            return redirect()->back();
        }

    
        $existEmail = User::where('email', $request->input('email'))->exists();
        if($existEmail){
            session()->flash('warning', 'Email already token!');
   
            return redirect()->back();
        }

        if ($request->input('password') !== $request->input('password_confirmation')){

            session()->flash('warning', 'Confirm password not matched!');
   
            return redirect()->back();
        }

        
        if($validator->fails()){

            return redirect()->back()->withInput()->withErrors($validator);
        }


        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $image->move(public_path('uploaded_files/'), $imageName);
        $user->image = $imageName; 
    }

        $user->save();

        session()->flash('success', 'Registered successfully!');

        return redirect()->route('user.login');
    }

//loginページに関する記述

    public function login(){

        return view('login');
    }


    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[

            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);


        if($validator->fails()){

            return redirect()->back()->withInput()->withErrors($validator);
        }

        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){

            return redirect()->route('user.all_posts');

        }else{

            session()->flash('warning', 'Email or password incorrect!');
            return redirect()->back();

        }
    }


//edit_profileページに関する記述

    public function edit_profile(User $user){
        
        return view('edit_profile', compact('user'));
    }


    public function profile_update(Request $request, User $user){



        $validator = Validator::make($request->all(),[

            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'old_password' => 'nullable',
            'new_password' => 'nullable|confirmed|min:3',
            'new_password_confirmation' => 'nullable',
            'image' => 'image|nullable',
        ]);

    
    
        $existEmail = User::where('email', $request->input('email'))
        ->where('id', '!=', $user->id)->exists();
        if($existEmail){
            session()->flash('warning', 'Email already token!');
   
            return redirect()->back();
        }


    

        if($validator->fails()){
            if($validator->errors()->has('new_password')){
                session()->flash('error', 'Confirm password not matached!');
            }
            
            return redirect()->back()->withInput()->withErrors($validator);
        }


        
        if ($request->filled('name')) {
            $user->name = $request->input('name');
        }

        
        if ($request->filled('email')) {
            $user->email = $request->input('email');
        }

        if ($request->filled('old_password')) {
            if (!Hash::check($request->input('old_password'), $user->password)) {
                session()->flash('error', 'Old password does not match.');
                return redirect()->back();
            }
            $user->password = Hash::make($request->input('new_password'));
        }


        
        if($request->hasFile('image')){

            $oldImage = public_path('uploaded_files/'. $user->image);

            if(is_file($oldImage)){
                unlink($oldImage);
            }

            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
            $image->move(public_path('uploaded_files/'), $imageName);
            $user->image = $imageName;
        }
        $user->save();

        session()->flash('success', 'Profile updated successfully!');
       
        return redirect()->back();
    }


    public function profile_img_destroy(Request $request, User $user){

        if($user->image){

            $oldImage = public_path('uploaded_files/'. $user->image);

                        
            if(is_file($oldImage)){
                unlink($oldImage);
                $user->image = null;
                $user->save();
            }
        }
            
        session()->flash('success', 'Image deleted successfully!');

        return response()->json([

            'status' => true,
        ]);
    }


//all_postsページに関する記述

    public function all_posts(){
        
        $user = Auth::user();

        $posts = Post::all();



        return view('all_posts', compact('posts',));
    }


//view_postページに関する記述

    public function view_post(Post $post){

        return view('view_post', compact('post'));
    }


//add_viewページに関する記述

    public function add_view(){

        return view('add_view');
    }

//edit_reviewページに関する記述

    public function edit_review(){

        return view('edit_review');
    }




//logout処理に関する記述

    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }

}
