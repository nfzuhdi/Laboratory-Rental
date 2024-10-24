<?php

namespace App\Livewire;

use App\Models\Kategori;
use App\Models\Alatlab;
use Livewire\Component;
use Livewire\WithPagination;

class AlatlabComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public $kategori, $nama_alat, $merek, $kode, $jumlah, $cari;
    public $selected_id; // untuk edit

    // Rules for validation
    protected $rules = [
        'nama_alat' => 'required|string',
        'kategori' => 'required|exists:kategoris,id', // kategori_id harus valid
        'merek' => 'required|string',
        'kode' => 'required|string',
        'jumlah' => 'required|integer',
    ];

    public function render()
    {
        $query = Alatlab::query();

        if ($this->cari != '') {
            $query->where('nama_alat', 'like', '%' . $this->cari . '%');
        }

        $data['alatlab'] = $query->paginate(10);
        $data['category'] = Kategori::all(); // ambil semua kategori untuk dropdown
        $layout['title'] = 'Kelola Alat';

        return view('livewire.alatlab-component', $data)->layoutData($layout);
    }

    public function store()
    {
        // Validasi input
        $this->validate();

        // Simpan data ke database
        Alatlab::create([
            'nama_alat' => $this->nama_alat,
            'kategori_id' => $this->kategori, // Simpan kategori_id
            'merek' => $this->merek,
            'kode' => $this->kode,
            'jumlah' => $this->jumlah,
        ]);

        // Reset form setelah submit
        $this->reset();

        // Flash message
        session()->flash('success', 'Tambah alat lab berhasil.');

        // Redirect ke halaman yang sama
        return redirect()->route('alatlab');
    }

    public function edit($id)
    {
        // Ambil data alatlab berdasarkan id
        $alatlab = Alatlab::findOrFail($id);

        // Isi properti form dengan data yang diambil
        $this->selected_id = $alatlab->id;
        $this->nama_alat = $alatlab->nama_alat;
        $this->kategori = $alatlab->kategori_id; // ambil kategori_id
        $this->merek = $alatlab->merek;
        $this->kode = $alatlab->kode;
        $this->jumlah = $alatlab->jumlah;
    }

    public function update()
    {
        // Validasi input
        $this->validate();

        // Update data di database
        $alatlab = Alatlab::findOrFail($this->selected_id);

        $alatlab->update([
            'nama_alat' => $this->nama_alat,
            'kategori_id' => $this->kategori, // update kategori_id
            'merek' => $this->merek,
            'kode' => $this->kode,
            'jumlah' => $this->jumlah,
        ]);

        // Reset form
        $this->reset();

        // Flash message
        session()->flash('success', 'Data alat lab berhasil diperbarui.');

        // Redirect ke halaman yang sama
        return redirect()->route('alatlab');
    }
}
