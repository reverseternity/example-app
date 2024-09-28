<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}">Mama Bulgaria</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('individualConsult') }}">Консультация ВНЖ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rent') }}">Арендовать квартиру</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}">qqqwww</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <div class="d-flex" role="search">
                @if(auth()->guest())
                    <a href="{{ route('loginForm') }}"><button class="btn btn-outline-secondary">войти в систему</button></a>
                @else
                    <div class="mx-2"><a href="{{ route('crm') }}"><button class="btn btn-outline-primary">CRM</button></a></div>
                    <div class="ms-2"><a href="{{ route('index') }}"><button class="btn btn-outline-success">👤 {{ auth()->user()->name }}</button></a></div>
                    <div class="ms-2">
                        <form action="{{ route('logoutAction') }}" method="post">
                            @csrf
                            <button class="btn btn-outline-danger" type="submit">выйти из системы</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>
