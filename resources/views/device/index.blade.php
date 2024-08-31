@extends('layouts.main')

@section('content')
<div class="container d-flex justify-content-between mt-4">
    <h1>Data Device</h1>
    <a href="/device/create">
        <button type="button" class="btn btn-primary">
            Tambah Data Device
        </button>
    </a>
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
            <th scope="col">Serial Number</th>
            <th scope="col">Meta Data</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($devices as $item)
            <tr>
              <th scope="row">{{ ($devices->currentPage() - 1) * $devices->perPage() + $loop->index + 1 }}</th>
              <th scope="row">{{ $item->serial_number }}</th>
              <td>{{ $item->meta_data }}</td>
              <td>
                <div class="d-flex gap-1">
                    <a href="/device/edit/{{ $item->id }}">
                        <button type="button" class="btn btn-warning">
                            Ubah
                        </button>
                    </a>
                    <form action="/device/delete/{{ $item->id }}" method="post">
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
      {{ $devices->links('pagination::bootstrap-5') }}
</div>
@endsection
