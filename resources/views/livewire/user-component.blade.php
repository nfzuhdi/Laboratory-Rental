<div>
    <div class="card">
        <div class="card-header">
          Kelola User
        </div>
        <div class="card-body">
            @if (@session()->has('success'))
            <div class="alert alert-success" role="alert">
               {{ session('success') }}
              </div>
            @endif
            <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Proses</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($user as $data)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->jenis }}</td>
                        <td>
                            <a href="#" wire:click="edit({{ $data->id }})" class="btn btn-sm btn-info" data-toggle="modal" 
                                data-target="#editPage">Ubah</a>
                            <a href="#" wire:click="confirm({{ $data->id }})" data-toggle="modal" 
                                data-target="#deletePage" class="btn btn-sm btn-danger">Hapus</a>   
                                
                    </tr> 
                    @endforeach
                </tbody>
            </table>
            {{ $user->links() }}
        </div>
        <a href="#" class="btn btn-primary btn-success" data-toggle="modal" data-target="#addPage">Tambah User</a>
    </div>
</div>
{{-- Add user --}}
<div wire:ignore.self class="modal fade" id="addPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah User Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form group">
                <label>Nama</label>
                <input type="text" class="form-control" wire:model="nama" value="{{ @old('nama') }}">
                @error('nama')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form group">
                <label>Email</label>
                <input type="text" class="form-control" wire:model="email" value="{{ @old('email') }}">
                @error('email')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form group">
                <label>Password</label>
                <input type="password" class="form-control" wire:model="password" value="{{ @old('password') }}">
                @error('password')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" wire:click="store" class="btn btn-primary"
          data-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>
  {{-- Edit user --}}
<div wire:ignore.self class="modal fade" id="editPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form group">
                <label>Nama</label>
                <input type="text" class="form-control" wire:model="nama" value="{{ @old('nama') }}">
                @error('nama')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form group">
                <label>Email</label>
                <input type="text" class="form-control" wire:model="email" value="{{ @old('email') }}">
                @error('email')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form group">
                <label>Password</label>
                <input type="password" class="form-control" wire:model="password" value="{{ @old('password') }}">
                @error('password')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" wire:click="update" class="btn btn-primary"
          data-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>
  {{-- Delete user --}}
<div wire:ignore.self class="modal fade" id="deletePage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>dslmd</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" wire:click="destroy" class="btn btn-danger"
          data-dismiss="modal">Delete</button>
        </div>
      </div>
    </div>
  </div>
</div>