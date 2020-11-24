<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <span class="navbar-brand mb-0 h1 text-light">Online Support Platform</span>

    <form action='{{ route('logout') }}' class="form-inline my-2 my-lg-0" method='post'>
        @csrf
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
    </form>
</nav>
