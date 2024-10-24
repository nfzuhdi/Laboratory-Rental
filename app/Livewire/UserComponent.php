<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination,WithoutUrlPagination;
    protected $paginationTheme='bootstrap';
    public $nama, $email, $password, $id;
    public function render()
    {
        $layout['title'] = "Kelola User";
        $data['user']=User::paginate(10);
        return view('livewire.user-component', $data)->layoutData($layout);
    }

    public function store(){
        $this->validate([
            'nama'=>'required',
            'email'=>'required|email',
            'password'=>'required'
        ],[
            'nama.required'=>'Nama Harus Diisi!',
            'email.required'=>'Email Harus Diisi!',
            'email.email'=>'Format Email Salah!',
            'password.required'=>'Password Harus Diisi!'
        ]);
        User::create([
            'nama'=>$this->nama,
            'email'=>$this->email,
            'password'=>$this->password,
            'jenis'=>'admin'
        ]);
        session()->flash('Data Berhasil Disimpan!');
        $this->reset();
    }
    public function edit($id){
        $user = User::find($id);
        $this->nama=$user->nama;
        $this->email=$user->email;
        $this->id = $user->id;
    }
    public function update(){
        $user = User::find($this->id);
        if($this->password == ""){
            $user->update([
                'nama'=>$this->nama,
                'email'=>$this->email
            ]);
        }
        else{
            $user->update([
                'nama'=>$this->nama,
                'email'=>$this->email,
                'password'=>$this->password
            ]);
        }
        session()->flash('Data Berhasil Diubah!');
        $this->reset();
    }

    public function confirm($id){
        $this->id = $id;
    }

    public function destroy(){
        $user = User::find($this->id);
        $user->delete();
        session()->flash('dsadasd');
        $this->reset();
    }
}