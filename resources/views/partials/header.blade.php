<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Yarikul</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('marks.index')}}">Marks Cards</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('marks.create')}}">create new</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ url('logout') }}" method="post" class="d-none">@csrf</form>
                </li>
            </ul>
        </div>
    </div>
</nav>