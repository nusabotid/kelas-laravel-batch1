@extends('layouts.main')

@section('content')
<div class="container d-flex justify-content-between mt-4">
    <h1>Ubah Data Sensor</h1>

</div>
<div class="container d-flex justify-content-between mt-4">
    <form method="POST" action="/sensor/update/{{ $sensor->id }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_sensor" class="form-label">Nama Sensor</label>
            <input type="text" class="form-control @error('nama_sensor') is-invalid @enderror" id="nama_sensor" name="nama_sensor" value="{{ old('nama_sensor', $sensor->nama_sensor) }}">
            @error('nama_sensor')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="text" class="form-control @error('data') is-invalid @enderror" id="data" name="data" value="{{ old('data', $sensor->data) }}">
            @error('data')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-warning">Submit</button>
        </div>
    </form>
</div>
@endsection
