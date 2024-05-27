@extends('layout.app')

@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
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
                                        <button type="submit" class="btn btn-secondary"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
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

            <style>
                .card-img-top {
                    height: 250px;
                    /* Set the desired height */
                    object-fit: cover;
                    /* Ensures the image covers the area and maintains aspect ratio */
                    width: 100%;
                    /* Ensures the image covers the width of the container */
                }
            </style>

            <div class="row" id="guru-list">
                <div class="card">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="cell">Nama</th>
                                <th>NIP</th>
                                <th>Alamat</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gurus as $guru)
                                <tr>
                                    <td>{{ $guru->nama }}</td>
                                    <td>{{ $guru->nip }}</td>
                                    <td>{{ $guru->alamat }}</td>
                                    <td>{{ $guru->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- @foreach ($gurus as $guru)
    <div class="col-xl-4 col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $guru->nama }}</h4>
                                            <h6 class="card-subtitle">{{ $guru->nip }}</h6>
                                        </div>
                                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="{{ asset('guru') }}/{{ $guru->foto }}"
                                                        class="card-img-top img-fluid" alt="Foto {{ $guru->nama }}"
                                                        data-bs-toggle="modal" data-bs-target="#imageModal"
                                                        onclick="showModal('{{ asset('guru') }}/{{ $guru->foto }}')">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <p class="card-text">
                                                Lahir di Kota {{ $guru->tempat }} pada {{ $guru->tgl }} yang beralamat di
                                                {{ $guru->alamat }}
                                            </p>
                                        </div>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">{{ $guru->email }}</li>
                                        <li class="list-group-item">{{ $guru->telepon }}</li>
                                    </ul>
                                </div>
                            </div>
    @endforeach -->


            <!--Modal Foto  -->
            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img id="modalImage" src="" class="img-fluid" alt="Guru Image">
                        </div>
                    </div>
                </div>
            </div>


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
                        <form action="{{ route('gurus.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nip" class="form-label">NIP</label>
                                        <input type="text" class="form-control" id="nip" name="nip"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="tempat" class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat" name="tempat"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tgl" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tgl" name="tgl"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="foto" class="form-label">Foto</label>
                                        <input type="file" class="form-control" id="foto" name="foto"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="col">
                                            <label for="telepon" class="form-label">Telepon</label>
                                            <input type="tel" class="form-control" id="telepon" name="telepon">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                required>
                                        </div>
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

            <!--Modal Edit-->


            <!--Modal View-->

        </div><!--//container-fluid-->
    </div><!--//app-content-->
    </div>
    <script>
        function showModal(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
        }
    </script>
@endsection
