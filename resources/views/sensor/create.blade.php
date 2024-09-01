@extends('layouts.main')

@section('content')
<div class="container d-flex justify-content-between mt-4">
    <h1>Tambah Data Sensor</h1>

</div>
<div class="container d-flex justify-content-between mt-4">
    <form method="POST" action="/sensor/store">
        @csrf
        <div class="mb-3">
            <label for="nama_sensor" class="form-label">Nama Sensor</label>
            <div class="d-flex gap-1">
                <input type="text" class="form-control @error('nama_sensor') is-invalid @enderror" id="nama_sensor" name="nama_sensor" value="{{ old('nama_sensor') }}">
                @error('nama_sensor')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="text" class="form-control @error('data') is-invalid @enderror" id="data" name="data" value="{{ old('data') }}">
            @error('data')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="topic" class="form-label">Topic</label>
            <input type="text" class="form-control @error('topic') is-invalid @enderror" id="topic" name="topic" value="{{ old('topic') }}">
            @error('topic')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
