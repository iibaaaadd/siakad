@extends('layout.app')

@section('content')
    <h1>Create Jadwal</h1>
    <form action="{{ route('jadwals.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="guru_id" class="form-label">Guru</label>
            <fieldset class="form-group">
                <select name="guru_id" class="form-select" id="basicSelect" required>
                    @foreach ($gurus as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                    @endforeach
                </select>
            </fieldset>
        </div>
        <div>
            <label for="kelas_id" class="form-label">Kelas</label>
            <fieldset class="form-group">
                <select name="kelas_id" class="form-select" id="basicSelect" required>
                    @foreach ($kelas as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                    @endforeach
                </select>
            </fieldset>
        </div>
        <div>
            <label for="mapel_id" class="form-label">Mapel</label>
            <fieldset class="form-group">
                <select name="mapel_id" class="form-select" id="basicSelect" required>
                    @foreach ($mapels as $mapel)
                        <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                    @endforeach
                </select>
            </fieldset>
        </div>
        <div>
            <label for="hari">Hari:</label>
            <input type="day" name="hari" id="hari">
        </div>
        <div>
            <label for="jam_mulai">Jam Mulai:</label>
            <input type="time" name="jam_mulai" id="jam_mulai">
        </div>
        <div>
            <label for="jam_selesai">Jam Selesai:</label>
            <input type="time" name="jam_selesai" id="jam_selesai">
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
