@extends('layouts.main')

@section('content')
<div class="container d-flex justify-content-between mt-4">
    <h1>Tambah Data Sensor</h1>

</div>
<div class="container d-flex justify-content-between mt-4">
    <form method="POST" action="/sensor/store">
        <div class="mb-3">
            <label for="nama_sensor" class="form-label">Nama Sensor</label>
            <input type="text" class="form-control" id="nama_sensor">
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="text" class="form-control" id="data">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
