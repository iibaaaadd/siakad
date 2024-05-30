@extends('layouts.app')

@section('content')
    <h1>Edit Jadwal</h1>
    <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="guru_id">Guru ID:</label>
            <input type="text" name="guru_id" id="guru_id" value="{{ $jadwal->guru_id }}">
        </div>
        <div>
            <label for="kelas_id">Kelas ID:</label>
            <input type="text" name="kelas_id" id="kelas_id" value="{{ $jadwal->kelas_id }}">
        </div>
        <div>
            <label for="mapel_id">Mapel ID:</label>
            <input type="text" name="mapel_id" id="mapel_id" value="{{ $jadwal->mapel_id }}">
        </div>
        <div>
            <label for="hari">Hari:</label>
            <input type="text" name="hari" id="hari" value="{{ $jadwal->hari }}">
        </div>
        <div>
            <label for="jam_mulai">Jam Mulai:</label>
            <input type="time" name="jam_mulai" id="jam_mulai" value="{{ $jadwal->jam_mulai }}">
        </div>
        <div>
            <label for="jam_selesai">Jam Selesai:</label>
            <input type="time" name="jam_selesai" id="jam_selesai" value="{{ $jadwal->jam_selesai }}">
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
