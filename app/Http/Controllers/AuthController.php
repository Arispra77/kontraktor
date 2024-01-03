<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        
        return view('auth.login');
    }

    public function home()
    {
        if (Auth::check()) {
            return view('home.home');
            }
            else {
                // Jika pengguna belum login, arahkan ke halaman login
                return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
            }
     
     

    }

    public function index()
    {
        if (Auth::check()) {
        return view('profil.profil');
        }
        else {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }
 
    }
    public function login(Request $request)
    {
       $request->validate([
            'nama_kary' => 'required',
            'password' => 'required',
        ]);

      
        $user = User::where('nama_kary', $request->nama_kary)->first();

    if (!$user) {
        return back()->with('error', 'Nama salah.');
    }

    // Periksa kata sandi saat ini menggunakan hashing SHA1
    if ($user->Password == sha1($request->password)) {
        Auth::login($user);
        Toastr::success('Anda berhasil login.', 'Success');
        return redirect('home') 
        ;
    } else {
        return back()->with('error','Password salah.');
    }

    }

    public function logout()
    {
        Auth::logout(); // Melakukan logout user yang sedang login
        return redirect()->route('login'); // Redirect user ke halaman login setelah logout
    }
   

  
}