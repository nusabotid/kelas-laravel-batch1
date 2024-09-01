<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/sensor">Sensor ABC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav d-flex align-items-center gap-2 ms-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/sensor">Sensor</a>
                </li>
                @if (auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/device">Device</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/ganti-password">Ganti Password</a>
                </li>
                @if (auth()->check())
                    <li class="nav-item">
                        <form action="/logout" method="post">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Log Out</button>
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
