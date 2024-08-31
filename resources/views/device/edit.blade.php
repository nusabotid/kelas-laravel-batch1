@extends('layouts.main')

@section('content')
<div class="container d-flex justify-content-between mt-4">
    <h1>Ubah Data Device</h1>

</div>
<div class="container d-flex justify-content-between mt-4">
    <form method="POST" action="/device/update/{{ $device->id }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="serial_number" class="form-label">Serial Number</label>
            <div class="d-flex gap-1">
                <input type="text" class="form-control @error('serial_number') is-invalid @enderror" id="serial_number" name="serial_number" value="{{ old('serial_number', $device->serial_number) }}">
                @error('serial_number')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="meta_data" class="form-label">Meta Data</label>
            <input type="text" class="form-control @error('meta_data') is-invalid @enderror" id="meta_data" name="meta_data" value="{{ old('meta_data', $device->meta_data) }}">
            @error('meta_data')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-warning">Submit</button>
        </div>
    </form>
</div>
@endsection
