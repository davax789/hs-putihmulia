<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>

<body>

    @include('layouts.sidebar-top')

    <!-- Main Content -->
    <div class="content" style="margin-left: 260px; padding: 20px;">
        <div class="row">
            <!-- Room Management Table -->
            <div class="col-md-12">
                <div class="card mt-1 shadow-sm">
                       <div class="card-body">
                        @if (session('success'))
                        <div id="alertSuccess" class="alert alert-success">
                        {{ session('success') }}
                        </div>
                        @endif
                        <h5 class="card-title mb-3">Available Rooms</h5>
                        <div class="mb-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                        Add Room
                        </button>
                        </div>

                        <div class="mb-3">
                            <input type="text" id="roomType" class="form-control"
                                placeholder="Search by room type or number...">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="roomTable">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Photo Room</th>
            <th>Jenis Kamar</th>
            <th>Harga /Malam</th>
            <th>Deskripsi</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="text-center align-middle">
        @foreach ($kamars as $kamar)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                <img src="{{ asset('storage/' . $kamar->photoKamar) }}" alt="Room Image" style="width: 100px; height: 70px; object-fit: cover;" class="rounded">
            </td>
            <td>{{ $kamar->jenisKamar }}</td>
            <td>{{ $kamar->hargaPermalam }}</td>
            <td class="description">{{ $kamar->deskripsi }}</td>
            <td>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                <form action="{{ route('admin.kamardepan.destroy', $kamar->id) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kamar ini?')">Delete</button>
</form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal for Add Room -->

<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
      <form action="{{ route('admin.kamardepanStore') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="addRoomModalLabel">Add New Room</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="roomType" class="form-label">Jenis Kamar</label>
            <input type="text" class="form-control" id="jenisKamar" name="jenisKamar">
          </div>
          <div class="mb-3">
            <label for="roomPrice" class="form-label">Harga/Malam</label>
            <input type="number" class="form-control" id="hargaPermalam" name="hargaPermalam">
          </div>
          <div class="mb-3">
            <label for="note" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="roomImages" class="form-label">Foto Kamar</label>
            <input type="file" class="form-control" id="photoKamar" name="photoKamar" accept="image/*">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Room</button>
        </div>
      </form>
    </div>
  </div>
</div>



    <!-- Modal for Edit (Optional) -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                            @isset($kamar)
                    <form action="{{ route('admin.kamardepan.update', $kamar->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="jenisKamar" class="form-label">Jenis Kamar</label>
                            <input type="text" name="jenisKamar" class="form-control" value="{{ old('jenisKamar', $kamar->jenisKamar) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="hargaPermalam" class="form-label">Harga Per Malam</label>
                            <input type="number" name="hargaPermalam" class="form-control" value="{{ old('hargaPermalam', $kamar->hargaPermalam) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi', $kamar->deskripsi) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="photoKamar" class="form-label">Foto Kamar</label>
                            <input type="file" name="photoKamar" class="form-control">
                            @if ($kamar->photoKamar)
                                <img src="{{ asset('storage/' . $kamar->photoKamar) }}" alt="Current Photo" class="mt-2" style="width: 150px;">
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>

                    </form>
                    @endisset
                </div>
            </div>

        </div>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and Popper.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const alert = $('#alertSuccess');
        if (alert.length > 0) {
            setTimeout(function() {
                alert.fadeOut();
            }, 3000);
        }
    });
    </script>
</body>

</html>
