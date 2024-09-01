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
<div class="container">
    <div class="alert alert-info alert-dismissible fade show">
        <span>Selamat datang user {{ auth()->user()->name }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
<div class="container mt-4">
    @session('success')
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endsession
    <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Sensor</th>
            <th scope="col">Data</th>
            <th scope="col">Topic</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($sensor as $item)
            <tr>
              <th scope="row">{{ ($sensor->currentPage() - 1) * $sensor->perPage() + $loop->index + 1 }}</th>
              <th scope="row">{{ $item->nama_sensor }}</th>
              <td>{{ $item->data }}</td>
              <td>{{ $item->topic }}</td>
              <td>
                <div class="d-flex gap-1">
                    <a href="/sensor/edit/{{ $item->id }}">
                        <button type="button" class="btn btn-warning">
                            Ubah
                        </button>
                    </a>
                    <form action="/sensor/delete/{{ $item->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Hapus
                        </button>
                    </form>
                </div>
              </td>
            </tr>
            @endforeach
        </tbody>
      </table>
      {{ $sensor->links('pagination::bootstrap-5') }}
</div>
@endsection
