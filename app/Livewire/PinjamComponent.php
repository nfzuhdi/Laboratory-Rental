<?php

namespace App\Livewire;

use App\Models\Pinjam;
use App\Models\User;
use App\Models\alatlab;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class PinjamComponent extends Component
{
    use WithPagination,WithoutUrlPagination;
    protected $paginationTheme='bootstrap';
    public $id,$user,$alatlab,$tanggal_pinjam,$tanggal_kembali;
    public function render()
    {
        $data['member'] = User::where('jenis','member')->get();
        $data['labstuff'] = Alatlab::all();
        $data['pinjam'] = Pinjam::paginate(10);
        $layout['title'] = 'Pinjam Alat';
        return view('livewire.pinjam-component', $data)->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'alatlab'=>'required',
            'user'=>'required'
        ]);
        $this->tanggal_pinjam = date('Y-m-d');
        $this->tanggal_kembali = date('Y-m-d', strtotime($this->tanggal_pinjam. '+5 days'));
        Pinjam::create([
            'user_id'=>$this->user,
            'alatlab_id'=>$this->alatlab,
            'tanggal_pinjam'=>$this->tanggal_pinjam,
            'tanggal_kembali'=>$this->tanggal_kembali,
            'status' => 'pinjam'
        ]);
        $this->reset();
        session()->flash('Berhasil');
        return redirect()->route('pinjam'); 
    }

    public function edit($id)
    {
        $pinjam = Pinjam::find($id);
        $this->id = $pinjam->id;
        $this->user = $pinjam->user_id;
        $this->alatlab = $pinjam-> alatlab_id;
        $this->tanggal_pinjam = $pinjam->tanggal_pinjam;
        $this->tanggal_kembali = $pinjam->tanggal_kembali;
    }
    public function update(){
        $pinjam=Pinjam::find($this->id);
        $this->tanggal_pinjam = date('Y-m-d');
        $this->tanggal_kembali = date('Y-m-d', strtotime($this->tanggal_pinjam. '+5 days'));
        $pinjam->update([
            'user_id'=>$this->user,
            'alatlab_id'=>$this->alatlab,
            'tanggal_pinjam'=>$this->tanggal_pinjam,
            'tanggal_kembali'=>$this->tanggal_kembali,
            'status' => 'pinjam'
        ]);
        $this->reset();
        session()->flash('Berhasil');
        return redirect()->route('pinjam');
    }
    public function confirm($id)
    {
        $this->id = $id;
    }
    public function destroy(){
        $pinjam=Pinjam::find($this->id);
        $pinjam->delete();
        $this->reset();
        session()->flash('Berhasil');
        return redirect()->route('pinjam');
    }
}
