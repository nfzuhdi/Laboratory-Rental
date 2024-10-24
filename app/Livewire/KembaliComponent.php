<?php

namespace App\Livewire;

use App\Livewire\session;
use App\Models\pengembalian;
use App\Models\pinjam;
use App\Models\User;
use App\Models\alatlab;
use DateTime;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class KembaliComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $id,$nama_alat,$member,$tanggal_kembali,$lama, $status;
    public function render()
    {
        $layout['title'] = 'Pengembalian Alat Lab';
        $data['pinjam'] = Pinjam::where('status', 'pinjam')->paginate(10);
        $data['pengembalian'] = Pengembalian::paginate(10);
        return view('livewire.kembali-component', $data)->layoutData($layout);
    }

    public function pilih($id)
    {
        $pinjam=Pinjam::find($id);
        $this->nama_alat=$pinjam->alatlab->nama_alat;
        $this->member=$pinjam->user->nama;
        $this->tanggal_kembali = $pinjam->tanggal_kembali;
        $this->id = $pinjam->id;

        $kembali = new DateTime($this->tanggal_kembali);
        $today= new DateTime();
        $selisih =  $today->diff($kembali);
        if($selisih->invert == 1){
            $this->status =true;
        }else{
            $this->status=false;
        }
        $this->lama=$selisih->d;
    }
    public function store(){
        if($this->status == true){
            $denda = $this->lama * 5000;
        }else{
            $denda = 0;
        }
        $pinjam = Pinjam::find($this->id);
        Pengembalian::create([
            'pinjam_id'=> $this->id,
            'tanggal_kembali' => date('Y-m-d'),
            'denda' => $denda
        ]);
        $pinjam->update([
             'status'=>'kembali'
        ]);

        $this->reset();
        session()->flash('berhasil');
        return redirect()->route('kembali');
    } 
}
