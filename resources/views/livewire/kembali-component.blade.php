<div class="card">
    <div class="card-header">Pengembalian Alat</div>
    <div class="card-body">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Alat</th>
                        <th>Member</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Proses</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pinjam as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->alatlab->nama_alat }}</td>
                            <td>{{ $data->user->nama }}</td>
                            <td>{{ $data->tanggal_pinjam }}</td>
                            <td>{{ $data->tanggal_kembali }}</td>
                            <td>
                                <a href="#" wire:click="pilih({{ $data->id }})" class="btn btn-sm btn-success" data-toggle="modal" data-target="#pilih">Pilih</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pinjam->links() }}
        </div>
    </div>
    <div class="card-header">Riwayat Penyewaan Alat</div>
    <div class="card-body">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID. Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengembalian as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->pinjam_id }}</td>
                            <td>{{ $data->tanggal_kembali }}</td>
                            <td>{{ $data->denda }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pengembalian->links() }}
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="pilih" tabindex="-1" aria-labelledby="addPageLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPageLabel">Form Pengembalian Alat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-4">Nama Alat:</div>
                        <div class="col-8">{{ $nama_alat }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">Member:</div>
                        <div class="col-8">{{ $member }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">Tanggal Kembali:</div>
                        <div class="col-8">{{ $tanggal_kembali }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">Tanggal Hari Ini:</div>
                        <div class="col-8">{{ date('Y-m-d') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">Denda:</div>
                        <div class="col-8">
                            : @if ($this->status == true)
                                Ya
                            @else
                                Tidak
                            @endif
                        </div>
                    </div>
                    {{-- <div class="row mb-3">
                        <div class="col-4">Lama : </div>
                        <div class="col-8">{{ $lama }}</div>
                    </div> --}}
                    {{-- <div class="row mb-3">
                        <div class="col-4">Jumlah Denda : </div>
                        <div class="col-8">{{ $lama * 5000 }}</div>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="store" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
