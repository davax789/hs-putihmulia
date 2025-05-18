<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin - Orders</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>

<body>

        @include('layouts.sidebar-top')

{{-- main content --}}

<div class="container-fluid py-4">
  <div class="content">
    <div class="card-body" style="overflow: visible;">
        <h5 class="card-title mb-4 fw-semibold">Recent Bookings</h5>

        <div class="mb-4">
          <input type="text" id="searchInput" class="form-control" placeholder="Search by customer name...">
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-hover align-middle" id="ordersTable">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Room Type</th>
                <th>Check-In</th>
                <th>Check-Out</th>
                <th>Status</th>
                <th>Action</th>
                <th>Accepted By</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Andi</td>
                <td><span class="badge bg-primary">Deluxe</span></td>
                <td>2025-05-01</td>
                <td>2025-05-03</td>
                <td><span class="badge bg-success">Confirmed</span></td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      Kelola
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                      <li>
                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                          <i class="fas fa-times me-2"></i> Tolak
                        </button>
                      </li>
                      <li>
                        <button class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#acceptModal">
                          <i class="fas fa-check me-2"></i> Terima
                        </button>
                      </li>
                    </ul>
                  </div>
                </td>
                <td>Admin 1</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Ela</td>
                <td><span class="badge bg-primary">Deluxe</span></td>
                <td>2025-05-01</td>
                <td>2025-05-03</td>
                <td><span class="badge bg-success">Confirmed</span></td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      Kelola
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                      <li>
                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                          <i class="fas fa-times me-2"></i> Tolak
                        </button>
                      </li>
                      <li>
                        <button class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#acceptModal">
                          <i class="fas fa-check me-2"></i> Terima
                        </button>
                      </li>
                    </ul>
                  </div>
                </td>
                <td>Admin 2</td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>



  <!-- Bootstrap JS and Popper.js from CDN -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

  <script>
    // Function to handle order rejection
    function rejectOrder() {

      // Close modal after action
      var myModal = new bootstrap.Modal(document.getElementById('rejectModal'));
      myModal.hide();
    }

    // Function to handle order acceptance
    function acceptOrder() {

      // Close modal after action
      var myModal = new bootstrap.Modal(document.getElementById('acceptModal'));
      myModal.hide();
    }

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('#ordersTable tbody tr');

    searchInput.addEventListener('keyup', function () {
      const keyword = this.value.toLowerCase();
      tableRows.forEach(row => {
        const customer = row.cells[1].textContent.toLowerCase();
        row.style.display = customer.includes(keyword) ? '' : 'none';
      });
    });
  </script>

</body>

</html>
