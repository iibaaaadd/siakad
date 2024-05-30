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
                <h1 class="app-page-title mb-0">Kelas</h1>
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
                        <h4 class="modal-title white" id="tambahGuruModalLabel">Jadwal Baru</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="{{ route('jadwals.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <!-- Form fields here -->
                            <div class="row mb-2">
                                <label for="mapel_id" class="form-label">Mapel</label>
                                <fieldset class="form-group">
                                    <select name="mapel_id" class="form-select" id="mapel_id" required>
                                        @foreach ($mapels as $mapel)
                                            <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                                        @endforeach
                                    </select>
                                </fieldset>
                                <label for="guru_id" class="form-label">Guru</label>
                                <fieldset class="form-group">
                                    <select name="guru_id" class="form-select" id="guru_id" required>
                                        @foreach ($gurus as $guru)
                                            <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="kelas_id" class="form-label">Kelas</label>
                                    <fieldset class="form-group">
                                        <select name="kelas_id" class="form-select" id="kelas_id" required>
                                            @foreach ($kelas as $kelas)
                                                <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <label for="hari" class="form-label">Hari</label>
                                    <fieldset class="form-group">
                                        <select name="hari" class="form-select" id="hari" required>
                                            <option value="" disabled selected>Pilih Hari</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                    <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                    <input type="time" class="form-control" id="jam_selesai" name="jam_selesai"
                                        required>
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
                                    <th class="text-center">Hari</th>
                                    <th class="text-center">Guru</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Mapel</th>
                                    <th class="text-center">Jam</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwals as $jadwal)
                                    <tr class="text-center">
                                        <td>{{ $jadwal->hari }}</td>
                                        <td>{{ $jadwal->guru->nama }}</td>
                                        <td>{{ $jadwal->kelas->nama }}</td>
                                        <td>{{ $jadwal->mapel->nama }}</td>
                                        <td>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                                        <td>
                                            <div
                                                style="display: flex; text-align: center; flex-wrap: wrap; align-content: center; justify-content: center;">
                                                <!-- Edit Button -->
                                                <button class="btn btn-warning me-1" data-bs-toggle="modal"
                                                    data-bs-target="#editJadwalModal{{ $jadwal->id }}"><i
                                                        class="bi bi-pencil"></i></button>

                                                <!-- Delete Form and Button -->
                                                <form id="delete-form-{{ $jadwal->id }}"
                                                    action="{{ route('jadwals.destroy', $jadwal->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="confirmDelete({{ $jadwal->id }})"><i
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


        @foreach ($jadwals as $jadwal)
            <div class="modal fade text-left" id="editJadwalModal{{ $jadwal->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editGuruModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h3 class="modal-title white" id="tambahGuruModalLabel">Edit Jadwal</h3> <button
                                type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('jadwals.update', $jadwal->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <!-- Form fields here -->
                                <div class="row mb-2">
                                    <label for="mapel_id" class="form-label">Mapel</label>
                                    <fieldset class="form-group">
                                        <select name="mapel_id" class="form-select" id="mapel_id" value="{{ $jadwal->mapel_id }}">
                                            @foreach ($mapels as $mapel)
                                                <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                    <label for="guru_id" class="form-label">Guru</label>
                                    <fieldset class="form-group">
                                        <select name="guru_id" class="form-select" id="guru_id" value="{{ $jadwal->guru_id }}">
                                            @foreach ($gurus as $guru)
                                                <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label for="kelas_id" class="form-label">Kelas</label>
                                        <fieldset class="form-group">
                                            <select name="kelas_id" class="form-select" id="kelas_id" value="{{ $jadwal->kelas_id }}">
                                                @foreach ($kelas as $kelas)
                                                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="hari" class="form-label">Hari</label>
                                        <fieldset class="form-group">
                                            <select name="hari" class="form-select" id="hari" required>
                                                <option value="" disabled selected>Pilih Hari</option>
                                                <option value="Senin">Senin</option>
                                                <option value="Selasa">Selasa</option>
                                                <option value="Rabu">Rabu</option>
                                                <option value="Kamis">Kamis</option>
                                                <option value="Jumat">Jumat</option>
                                                <option value="Sabtu">Sabtu</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai"
                                        value="{{ $jadwal->jam_mulai }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai"
                                        value="{{ $jadwal->jam_selesai }}">
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
@endsection
