@extends('layout.app')

@section('content')
    <h1>Jadwal Pelajaran</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <a href="{{ route('jadwals.create') }}" class="btn btn-primary">Tambah Jadwal</a>
@endsection
