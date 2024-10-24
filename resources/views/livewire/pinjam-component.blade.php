<div>
    <div class="card">
        <div class="card-header">
            Pinjam Alat
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
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
                            <th>Status</th>
                            <th>Proses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pinjam as $data)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $data->alatlab->nama_alat }}</td>
                                <td>{{ $data->user->nama }}</td>
                                <td>{{ $data->tanggal_pinjam }}</td>
                                <td>{{ $data->tanggal_kembali }}</td>
                                <td>{{ $data->status }}</td>
                                <td>
                                    <a href="#" wire:click="edit({{ $data->id }})" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editPage">Ubah</a>
                                    <a href="#" wire:click="confirm({{ $data->id }})" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletePage">Hapus</a>
                                </td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
                {{ $pinjam->links() }}
            </div>
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addPage">Tambah Alat</a>
        </div>
    </div>

    {{-- Modal Tambah Alat --}}
    <div wire:ignore.self class="modal fade" id="addPage" tabindex="-1" aria-labelledby="addPageLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPageLabel">Tambah Pinjaman Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Nama Alat</label>
                            <select wire:model="alatlab" class="form-control">
                                <option value="">-Pilih Alat-</option>
                                @foreach ($labstuff as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_alat }}</option>
                                @endforeach
                            </select>
                            @error('alatlab')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Member</label>
                            <select wire:model="user" class="form-control">
                                <option value="">-Pilih Member-</option>
                                @foreach ($member as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('user')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="store" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Alat --}}
    <div wire:ignore.self class="modal fade" id="editPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Alat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Nama Alat</label>
                            <select wire:model="alatlab" class="form-control">
                                <option value="">-Pilih Alat-</option>
                                @foreach($labstuff as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_alat }}</option>
                                @endforeach
                            </select>
                            @error('alatlab') <small class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
    
                        <div class="form-group">
                            <label>Nama Member</label>
                            <select wire:model="user" class="form-control">
                                <option value="">-Pilih Member-</option>
                                @foreach($member as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('user') <small class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
    
                        <div class="form-group">
                            <label>Tanggal Pinjam</label>
                            <input type="text" class="form-control" wire:model="tanggal_pinjam">
                            @error('tanggal_pinjam') <small class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
    
                        <div class="form-group">
                            <label>Tanggal Kembali</label>
                            <input type="text" class="form-control" wire:model="tanggal_kembali">
                            @error('tanggal_kembali') <small class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="update" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Hapus Alat --}}
    <div wire:ignore.self class="modal fade" id="deletePage" tabindex="-1" aria-labelledby="deletePageLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePageLabel">Hapus Pinjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus pinjaman ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="destroy" class="btn btn-danger" data-dismiss="modal">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
