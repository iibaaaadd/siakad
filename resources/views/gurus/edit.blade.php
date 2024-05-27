@extends('layout.app')

@section('content')
    <div class="container">
        <h2>Edit Guru</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $guru->nama) }}" required>
            </div>

            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" name="nip" class="form-control" value="{{ old('nip', $guru->nip) }}" required>
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" class="form-control">
                @if ($guru->foto)
                    <img src="{{ asset('guru/' . $guru->foto) }}" alt="Foto Guru" width="100">
                @endif
            </div>

            <div class="form-group">
                <label for="tempat">Tempat Lahir</label>
                <input type="text" name="tempat" class="form-control" value="{{ old('tempat', $guru->tempat) }}"
                    required>
            </div>

            <div class="form-group">
                <label for="tgl">Tanggal Lahir</label>
                <input type="date" name="tgl" class="form-control" value="{{ old('tgl', $guru->tgl) }}" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $guru->alamat) }}"
                    required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $guru->email) }}" required>
            </div>

            <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $guru->telepon) }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
