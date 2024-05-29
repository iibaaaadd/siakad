@extends('layout.app')

@section('content')
    <div class="app-content ">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '{{ session('success') }}',
                    });
                </script>
            @endif
            @if ($errors->any())
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '{{ $errors->first() }}',
                    });
                </script>
            @endif
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Mapel</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <form class="docs-search-form row gx-1 align-items-center" id="search-form">
                                <div class="col-auto">
                                    <input type="text" id="search-docs" class="form-control"
                                        style="border: 2px solid #435ebe; border-radius: 5px;" placeholder="Search">
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-secondary" id="search-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.397l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM2 6.5a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKelasModal">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upload me-2"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                    <path fill-rule="evenodd"
                                        d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                                </svg>
                                Upload File
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Create -->
        <div class="modal fade text-left" id="tambahKelasModal" tabindex="-1" role="dialog"
            aria-labelledby="tambahKelasModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title white" id="tambahKelasModalLabel">Mapel Baru</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="{{ route('mapel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h7 class="card-title"></h7>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th class="text-center" width="100px">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center" width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mapel as $index => $mapels)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $mapels->nama }}</td>
                                        <td class="text-center">
                                            <form id="delete-form-{{ $mapels->id }}"
                                                action="{{ route('mapel.destroy', $mapels->id) }}" method="POST">
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editKelasModal{{ $mapels->id }}">
                                                    <i class="bi bi-pencil"></i></button>
                                                </button>
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $mapels->id }})"><i
                                                        class="bi bi-trash"></i></button></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        @foreach ($mapel as $index => $mapels)
            <div class="modal fade text-left" id="editKelasModal{{ $mapels->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editKelasModalLabel{{ $mapels->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content ">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title white" id="editKelasModalLabel{{ $mapels->id }}">Edit
                                Mapel</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('mapel.update', $mapels->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ $mapels->nama }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>

    <script>
        // Fungsi untuk melakukan pencarian
        function search() {
            var searchText = document.getElementById('search-docs').value.toUpperCase();
            var rows = document.getElementById('table1').getElementsByTagName('tr');

            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var cells = row.getElementsByTagName('td');
                var found = false;
                for (var j = 0; j < cells.length; j++) {
                    var cell = cells[j];
                    if (cell) {
                        var cellText = cell.textContent || cell.innerText;
                        if (cellText.toUpperCase().indexOf(searchText) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }

        // Menangani peristiwa klik tombol pencarian
        document.getElementById('search-button').addEventListener('click', function() {
            search();
        });

        // Menangani peristiwa tekan tombol Enter pada input pencarian
        document.getElementById('search-docs').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Menghentikan perilaku default
                search();
            }
        });
    </script>
@endsection
