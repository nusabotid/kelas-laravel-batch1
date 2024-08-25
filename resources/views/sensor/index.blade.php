@extends('layouts.main')

@section('content')
<div class="container d-flex justify-content-between mt-4">
    <h1>Data Sensor</h1>
    <a href="/sensor/create">
        <button type="button" class="btn btn-primary">
            Tambah Data Sensor
        </button>
    </a>
</div>
<div class="container mt-4">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nama Sensor</th>
            <th scope="col">Data</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($sensor as $item)
            <tr>
              <th scope="row">{{ ($sensor->currentPage() - 1) * $sensor->perPage() + $loop->index + 1 }}</th>
              <th scope="row">{{ $item->nama_sensor }}</th>
              <td>{{ $item->data }}</td>
              <td>
                <a href="/sensor/edit/{{ $item->id }}">
                    <button type="button" class="btn btn-warning">
                        Ubah
                    </button>
                </a>
              </td>
            </tr>
            @endforeach
        </tbody>
      </table>
      {{ $sensor->links('pagination::bootstrap-5') }}
</div>
@endsection
