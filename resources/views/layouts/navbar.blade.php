<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link">
        Đăng xuất
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
    </li>
  </ul>
</nav>
