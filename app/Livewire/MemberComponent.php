<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class MemberComponent extends Component
{
    use WithPagination,WithoutUrlPagination;
    protected $paginationTheme='bootstrap';
    public $nama, $telepon, $email, $password, $cari, $id;
    public function render()
    {
        if($this->cari!="") {
            $data['member']=User::where('jenis','member')
            ->orWhere('nama','like','%'.$this->cari . '%')
            ->orWhere('email','like','%'.$this->cari . '%')
            ->paginate(10);
        }else{
            $data['member']=User::where('jenis','member')->paginate(10);
        }
       
        $layout['title'] = 'kelola Member';
        return view('livewire.member-component', $data)->layoutData($layout);
    }
    public function store(){
        $this->validate([
            'nama'=>'required',
            'telepon'=>'required',
            'email'=>'required',
        ]);
    User::create([
        'nama'=>$this->nama,
        'telepon'=>$this->telepon,
        'email'=>$this->email,
        'jenis'=> 'member' 
    ]);
    session()->flash('Berhasil Di SImpan');
    return redirect()->route('member');
    }
    public function edit($id){
        $member=User::find($id);
        $this->id = $member->id;
        $this->nama=$member->nama;
        $this->telepon = $member->telepon;
        $this->email = $member->email;
    }

    public function update()
    {
        $member = User::find($this->id);
        $member->update([
            'nama'=>$this->nama,
            'telepon'=>$this->telepon,
            'email'=>$this->email,
            'jenis'=> 'member' 
        ]);
        session()->flash('Berubah');
        return redirect()->route('member');
    }
    public function confirm($id)
    {
        $this->id = $id;
    }
    public function destroy()
    {
        $member = User::find($this->id);
        $member->delete();
        session()->flash('Berhasil Hapus');
        return redirect()->route('member');
    }
}
