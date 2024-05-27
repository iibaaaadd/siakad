@extends('layout.app')

@section('content')
    <div class="app-content">
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
                <h1 class="app-page-title mb-0">Guru</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <!-- 3. Di dalam form pencarian pada tampilan index -->
                            <form class="docs-search-form row gx-1 align-items-center" id="search-form"
                                action="{{ route('gurus.index') }}" method="GET">

                                <div class="col-auto">
                                    <input type="text" id="search-docs" name="searchdocs" class="form-control"
                                        style="border: 2px solid #435ebe; border-radius: 5px;" placeholder="Search">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-search"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.397l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM2 6.5a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0z" />
                                        </svg></button>
                                </div>
                            </form>

                        </div><!--//col-->
                        <div class="col-auto">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahGuruModal">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upload me-2"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                    <path fill-rule="evenodd"
                                        d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                                </svg>
                                Upload File
                            </button>
                            </a>
                        </div>
                    </div><!--//row-->
                </div><!--//table-utilities-->
            </div><!--//col-auto-->
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
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Lahir</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gurus as $guru)
                                    <tr>
                                        <td>{{ $guru->nama }}</td>
                                        <td>{{ $guru->nip }}</td>
                                        <td>{{ $guru->tempat }}, {{ $guru->tgl }}</td>
                                        <td>{{ $guru->email }}</td>
                                        <td>
                                            <form id="delete-form-{{ $guru->id }}"
                                                action="{{ route('gurus.destroy', $guru->id) }}" method="POST">
                                                <a href="{{ route('guru.edit', $guru->id) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                Edit
                                                </button>
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $guru->id }})">Delete</button>
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

        <!--Modal Create-->
        <div class="modal fade text-left" id="tambahGuruModal" tabindex="-1" role="dialog"
            aria-labelledby="tambahGuruModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="tambahGuruModalLabel">Guru Baru</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form id="tambahGuruForm" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nip" class="form-label">NIP</label>
                                    <input type="text" class="form-control" id="nip" name="nip" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="tempat" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat" name="tempat" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="tgl" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl" name="tgl" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="telepon" class="form-label">Telepon</label>
                                    <input type="tel" class="form-control" id="telepon" name="telepon">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" required></textarea>
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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.getElementById('tambahGuruForm').addEventListener('submit', function(event) {
                event.preventDefault();

                let form = event.target;
                let formData = new FormData(form);

                fetch('{{ route('gurus.store') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.errors) {
                            let errors = data.errors;
                            if (errors.email) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Email Error',
                                    text: errors.email[0]
                                });
                            }
                            if (errors.nip) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'NIP Error',
                                    text: errors.nip[0]
                                });
                            }
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Guru berhasil ditambahkan'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>

        @foreach ($gurus as $guru)
            <!-- Edit Modal -->
            <div class="modal fade text-left" id="editGuruModal{{ $guru->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editGuruModalLabel{{ $guru->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="editGuruModalLabel{{ $guru->id }}">Edit Guru</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form id="editGuruForm{{ $guru->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="nama{{ $guru->id }}" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama{{ $guru->id }}"
                                            name="nama" value="{{ $guru->nama }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nip{{ $guru->id }}" class="form-label">NIP</label>
                                        <input type="text" class="form-control" id="nip{{ $guru->id }}"
                                            name="nip" value="{{ $guru->nip }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="tempat{{ $guru->id }}" class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat{{ $guru->id }}"
                                            name="tempat" value="{{ $guru->tempat }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tgl{{ $guru->id }}" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tgl{{ $guru->id }}"
                                            name="tgl" value="{{ $guru->tgl }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="foto{{ $guru->id }}" class="form-label">Foto</label>
                                        <input type="file" class="form-control" id="foto{{ $guru->id }}"
                                            name="foto">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="telepon{{ $guru->id }}" class="form-label">Telepon</label>
                                        <input type="tel" class="form-control" id="telepon{{ $guru->id }}"
                                            name="telepon" value="{{ $guru->telepon }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email{{ $guru->id }}" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email{{ $guru->id }}"
                                            name="email" value="{{ $guru->email }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="alamat{{ $guru->id }}" class="form-label">Alamat</label>
                                        <textarea class="form-control" id="alamat{{ $guru->id }}" name="alamat" required>{{ $guru->alamat }}</textarea>
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
        @endforeach

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.querySelectorAll('[id^="editGuruForm"]').forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    let guruId = this.id.replace('editGuruForm', '');
                    let formData = new FormData(this);

                    fetch(`{{ url('/gurus') }}/${guruId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                                'X-HTTP-Method-Override': 'PUT'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.errors) {
                                let errors = data.errors;
                                if (errors.email) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Email Error',
                                        text: errors.email[0]
                                    });
                                }
                                if (errors.nip) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'NIP Error',
                                        text: errors.nip[0]
                                    });
                                }
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Guru berhasil diperbarui'
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        </script>

        <!--Modal View-->

    </div><!--//app-content-->
@endsection
