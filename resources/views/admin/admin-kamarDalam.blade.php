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
                <button class="btn btn-warning btn-sm">Add</button>
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
      <form action="{{ route('admin.kamarDalamStore') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="addRoomModalLabel">Add New Room</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <select class="form-control" id="roomType" name="jenisKamar" required>
            <option value="" disabled selected>-- Pilih Jenis Kamar --</option>
            @foreach ($kamars as $item)
            <option value="{{ $item->jenisKamar }}">{{ $item->jenisKamar }}</option>
                @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="roomPrice" class="form-label">Harga/Malam</label>
            <input type="number" class="form-control" id="roomPrice" name="hargaPermalam">
          </div>
          <div class="mb-3">
            <label for="nomorKamar" class="form-label">No Kamar</label>
            <input type="nomorKamar" class="form-control" id="nomorKamar" name="nomorKamar">
          </div>
          <div class="mb-3">
            <label for="note" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="note" name="deskripsi" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="roomImages" class="form-label">Foto Kamar</label>
<input type="file" class="form-control" id="roomImages" name="photoKamar[]" accept="image/*" multiple>
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
                    <form>
                        <div class="mb-3">
                            <label for="editRoomNumber" class="form-label">Photo Room</label>
                            <input type="text" class="form-control" id="editRoomNumber"
                                placeholder="Enter room number">
                        </div>
                        <div class="mb-3">
                            <label for="editRoomType" class="form-label">Room Type</label>
                            <input type="text" class="form-control" id="editRoomType"
                                placeholder="Enter room type">
                        </div>
                        <div class="mb-3">
                            <label for="editRoomPrice" class="form-label">Price/Night</label>
                            <input type="number" class="form-control" id="editRoomPrice"
                                placeholder="Enter price per night">
                        </div>
                        <div class="mb-3">
                            <label for="editRoomStatus" class="form-label">Status</label>
                            <select class="form-select" id="editRoomStatus">
                                <option selected>Choose status</option>
                                <option value="available">Available</option>
                                <option value="booked">Booked</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editRoomImages" class="form-label">Room Images
                            </label>
                            <input type="file" class="form-control" id="editRoomImages" multiple
                                accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary">Save
                            Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Delete Confirmation -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this room? This action cannot be
                        undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="deleteRoom()">Confirm
                        Delete</button>
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
</body>

</html>
