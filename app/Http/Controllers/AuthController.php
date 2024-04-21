<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function profile($id)
    {
        $user = User::find($id);
        $images = Image::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(30);
        return view('auth.profile', [
            'user' => $user,
            'images' => $images
        ]);
    }
    public function search($id, Request $request)
    {
        $user = User::find($id);
        $searchTerm = $request->input('search');
        $images = Image::where('user_id', $id)
            ->where(function ($query) use ($searchTerm) {
            $query->where('name', 'like', "%{$searchTerm}%")
                ->orWhere('description', 'like', "%{$searchTerm}%")
                ->orWhere('textnews', 'like', "%{$searchTerm}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(16);

        return view('auth.profile', [
            'user' => $user,
            'images' => $images,
            'searchTerm' => $searchTerm,
        ]);
    }
    
    public function login() {
        return view('auth/login');
    }

    public function loginPOST(Request $request) {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('name', 'password');
 
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect(route('index'));
        }

        return redirect(route('auth.login'))->with('message', 'Wrong creditnails');
    }
    public function registration() {
        return view('auth/registration');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:users,name',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'password' => $request->password, 
        ]);

        auth()->login($user);

        return redirect(route('index'));
    }

    public function destroy()
    {
        auth()->logout();
        
        return redirect(route('index'));
    }
}
