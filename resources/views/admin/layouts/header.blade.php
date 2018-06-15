<!-- Navbar -->

@if(Auth::check())
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">

            <a href="{{ route('admin.logout') }}"
               onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>

    </ul>
</nav>
@endif
<!-- /.navbar -->