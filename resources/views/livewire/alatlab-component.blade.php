<div>
    <div class="card">
        <div class="card-header">
            Kelola Alat
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
                            <th scope="col">No.</th>
                            <th scope="col">Nama Alat</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Kode</th>
                            <th>Proses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alatlab as $data)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data->nama_alat }}</td>
                            <td>{{ $data->kategori->nama }}</td>
                            <td>{{ $data->kode }}</td>
                            <td>
                                <a href="#" wire:click="edit({{ $data->id }})" class="btn btn-sm btn-info" data-toggle="modal" 
                                    data-target="#editPage">Ubah</a>
                                <a href="#" wire:click="confirm({{ $data->id }})" class="btn btn-sm btn-danger" data-toggle="modal" 
                                    data-target="#deletePage">Hapus</a>
                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
                {{ $alatlab->links() }}
            </div>
            <a href="#" class="btn btn-primary btn-success" data-toggle="modal" data-target="#addPage">Tambah Alat</a>
        </div>
    </div>

    {{-- Add Modal --}}
    <div wire:ignore.self class="modal fade" id="addPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Alat Baru</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form group">
                    <label>Nama</label>
                    <input type="text" class="form-control" wire:model="nama_alat">
                    @error('nama_alat')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form group">
                    <label>Kategori</label>
                    <select wire:model="kategori" class="form-control">
                        <option value="">-Pilih Kategori-</option>
                        @foreach($category as $data)
                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form group">
                    <label>Merek</label>
                    <input type="text" class="form-control" wire:model="merek">
                    @error('merek')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form group">
                    <label>Kode Barang</label>
                    <input type="text" class="form-control" wire:model="kode">
                    @error('kode')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form group">
                    <label>Jumlah</label>
                    <input type="text" class="form-control" wire:model="jumlah">
                    @error('jumlah')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" wire:click="store" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
          </div>
        </div>
    </div>

    {{-- Edit Modal --}}
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
                    <div class="form group">
                        <label>Nama</label>
                        <input type="text" class="form-control" wire:model="nama_alat">
                        @error('nama_alat')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form group">
                        <label>Kategori</label>
                        <select wire:model="kategori" class="form-control">
                            <option value="">-Pilih Kategori-</option>
                            @foreach($category as $data)
                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form group">
                        <label>Merek</label>
                        <input type="text" class="form-control" wire:model="merek">
                        @error('merek')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form group">
                        <label>Kode Barang</label>
                        <input type="text" class="form-control" wire:model="kode">
                        @error('kode')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form group">
                        <label>Jumlah</label>
                        <input type="text" class="form-control" wire:model="jumlah">
                        @error('jumlah')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" wire:click="update" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
          </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div wire:ignore.self class="modal fade" id="deletePage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Hapus Alat</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus alat ini?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" wire:click="destroy" class="btn btn-danger" data-dismiss="modal">Delete</button>
            </div>
          </div>
        </div>
    </div>
</div>
