<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginComponent extends Component
{
    public $email, $password;
    public function render()
    {
        return view('livewire.login-component')->layout('components.layouts.login');
    }
    public function proses(){
        $credential = $this->validate([
            'email'=>'required',
            'password'=>'required',
        ],[
            'email.required'=>'Mohon diisi Email untuk melakukan rental!',
            'password.required'=>'Mohon diisi Password untuk melakukan rental!'
        ]);

        if (Auth::attempt($credential)) {
            session()->regenerate();

            return redirect()->route('home');
        }
        return back()->withErrors([
            'email' => 'Autentikasi Gagal',
        ])->onlyInput('email'); 
    }

    public function keluar(){

        Auth::logout();
 
        session()->invalidate();
     
        session()->regenerateToken();
        
        $this->reset();
        return redirect()->route('login');
    }
}
