@php $user = Auth::user(); @endphp
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route("guests.home") }}">Boolpress</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="{{ route("admin.dashboard") }}">Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Projects
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route("admin.projects.index") }}">Index</a></li>
              <li><a class="dropdown-item" href="{{ route("admin.projects.create") }}">Add</a></li>
            </ul>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Types
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route("admin.types.index") }}">Index</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Technology
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route("admin.technologies.index") }}">Index</a></li>
                <li><a class="dropdown-item" href="{{ route("admin.technologies.create") }}">Add</a></li>
              </ul>
          </li>
        </ul>


        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ $user->name }}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route("admin.profile.edit", $user->name) }}">Edit profile</a></li>
              <li>
                <form action="{{route("logout") }}" method="post">
                  @csrf
                  <button>Logout</button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
</nav>