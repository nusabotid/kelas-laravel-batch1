@extends('layouts.main')

@section('content')
<main>
    <section class="section-wrapper d-flex justify-content-center align-items-center pt-5">
        <div style="width: 300px">
            <h2 class="mb-3">Ganti Password</h2>
            @if ($errors->any())
                @dd($errors->all())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            @session('success')
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endsession
            @session('danger')
                <div class="alert alert-danger">
                    {{ session()->get('danger') }}
                </div>
            @endsession
            <form action="/ganti-password" method="post">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="current_password" class="form-label">Password Lama</label>
                    <div class="d-flex gap-1">
                        <input type="password" class="form-control" id="current_password" name="current_password">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <div class="d-flex gap-1">
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" style="width: 100%">Submit</button>
                </div>
            </form>
        </div>
    </section>
</main>
@endsection
