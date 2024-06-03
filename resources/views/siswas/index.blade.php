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
                <h1 class="app-page-title mb-0">Siswa</h1>
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
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">NIS</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Gender</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $siswa)
                                    <tr class="text-center">
                                        <td>{{ $siswa->nama }}</td>
                                        <td>{{ $siswa->nis }}</td>
                                        <td>{{ $siswa->kelas->nama }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $siswa->jenis_kelamin == 'L' ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div
                                                style="display: flex; text-align: center; flex-wrap: wrap; align-content: center; justify-content: center;">
                                                <button type="button" class="btn btn-info me-1" data-bs-toggle="modal"
                                                    data-bs-target="#showGuruModal{{ $siswa->id }}">
                                                    <i class="bi bi-eye"></i></button>
                                                </button>
                                                <!-- Edit Button -->
                                                <button class="btn btn-warning me-1" data-bs-toggle="modal"
                                                    data-bs-target="#editGuruModal{{ $siswa->id }}"><i
                                                        class="bi bi-pencil"></i></button>

                                                <!-- Delete Form and Button -->
                                                <form id="delete-form-{{ $siswa->id }}"
                                                    action="{{ route('siswas.destroy', $siswa->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="confirmDelete({{ $siswa->id }})"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                            </div>
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
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title white" id="tambahGuruModalLabel">Guru Baru</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form id="tambahSiswaForm" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <!-- Form fields here -->
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nis" class="form-label">NIS</label>
                                    <input type="text" class="form-control" id="nis" name="nis" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="tempat" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat" name="tempat" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="tgl" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl" name="tgl" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="telepon" class="form-label">Telepon</label>
                                    <input type="tel" class="form-control" id="telepon" name="telepon">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="kelas_id" class="form-label">Kelas</label>
                                    <fieldset class="form-group">
                                        <select name="kelas_id" class="form-select" id="basicSelect" required>
                                            @foreach ($kelas as $kls)
                                                <option value="{{ $kls->id }}">{{ $kls->nama }}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <fieldset class="form-group">
                                        <select name="jenis_kelamin" class="form-select" id="basicSelect">
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row mb-2">
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
            document.getElementById('tambahSiswaForm').addEventListener('submit', function(event) {
                event.preventDefault();

                let form = event.target;
                let formData = new FormData(form);

                fetch('{{ route('siswas.store') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: formData
                    })
                    .then(response => response.json().then(data => ({
                        status: response.status,
                        body: data
                    })))
                    .then(data => {
                        if (data.status >= 200 && data.status < 300) {
                            if (data.body.errors) {
                                let errors = data.body.errors;
                                for (let key in errors) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: `${key.charAt(0).toUpperCase() + key.slice(1)} Error`,
                                        text: errors[key][0]
                                    });
                                }
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses',
                                    text: 'Siswa berhasil ditambahkan'
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        } else {
                            let errorMessage = 'Terjadi kesalahan';
                            if (data.body.errors) {
                                errorMessage = Object.values(data.body.errors).flat().join('\n');
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan Server',
                                text: errorMessage
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan Pengiriman',
                            text: 'Terjadi kesalahan saat pengiriman formulir. Silakan coba lagi.'
                        });
                    });
            });
        </script>

        <!--Modal Edit-->
        @foreach ($siswas as $siswa)
            <div class="modal fade text-left" id="editGuruModal{{ $siswa->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editGuruModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h3 class="modal-title white" id="tambahGuruModalLabel">Edit Siswa</h3> <button
                                type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('siswa.update', $siswa->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ $siswa->nama }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nip" class="form-label">NIP</label>
                                        <input type="text" class="form-control" id="nip" name="nip"
                                            value="{{ $siswa->nis }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label for="tempat" class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat" name="tempat"
                                            value="{{ $siswa->tempat }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tgl" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tgl" name="tgl"
                                            value="{{ $siswa->tgl }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label for="foto" class="form-label">Foto (Optional)</label>
                                        <input type="file" class="form-control" id="foto" name="foto">
                                        <p class="text-muted">Leave empty to keep existing photo.</p>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label for="kelas_id" class="form-label">Kelas</label>
                                        <fieldset class="form-group">
                                            <select name="kelas_id" class="form-select" id="basicSelect">
                                                <option value="" disabled selected>Pilih Kelas</option>
                                                @foreach ($kelas as $kls)
                                                    <option value="{{ $kls->id }}">{{ $kls->nama }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <fieldset class="form-group">
                                            <select name="jenis_kelamin" class="form-select" id="basicSelect">
                                                <option value="" disabled selected>Pilih Gender</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label for="telepon" class="form-label">Telepon</label>
                                        <input type="tel" class="form-control" id="telepon" name="telepon"
                                            value="{{ $siswa->telepon }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $siswa->email }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            value="{{ $siswa->alamat }}"></input>
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

        <!--Modal View-->
        @foreach ($siswas as $siswa)
            <div class="modal fade text-left" id="showGuruModal{{ $siswa->id }}" tabindex="-1" role="dialog"
                aria-labelledby="showGuruModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h3 class="modal-title white" id="showGuruModalLabel">Detail</h3> <button type="button"
                                class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <style>
                                /* Style to make the image responsive */
                                .carousel-item img {
                                    max-width: 100%;
                                    height: auto;
                                }
                            </style>

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="carouselExampleSlidesOnly" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="{{ asset('siswa') }}/{{ $siswa->foto }}"
                                                        class="d-block w-100"
                                                        style="
                                                        max-width: fit-content; text-align:center">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $siswa->nama }}</h4>
                                            <h6 class="card-subtitle">{{ $siswa->nis }}</h6>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">
                                                Lahir di Kota {{ $siswa->tempat }} pada {{ $siswa->tgl }} yang beralamat
                                                di {{ $siswa->alamat }}
                                            </p>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">{{ $siswa->email }}</li>
                                            <li class="list-group-item">{{ $siswa->telepon }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div><!--//app-content-->
    <script>
        function confirmDelete(siswaId) {
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
                    document.getElementById('delete-form-' + siswaId).submit();
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
