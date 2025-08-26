  <header>
    <div class="topbar d-flex align-items-center">
      <nav class="navbar navbar-expand gap-3">
        <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
        </div>
        <div class="top-menu ms-auto">
        </div>
        <div class="user-box dropdown px-3">
          <a class="d-flex align-items-center nav-link dropdown-toggle gap-1 dropdown-toggle-nocaret"
            href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <img src="{{ asset('assets/images/user.jpg') }}" class="user-img"
              alt="user avatar">
            <div class="user-info">
              <p class="user-name mb-0">{{ Auth::user()->ho_ten }}</p>
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a href="{{ route('thong-tin-tai-khoan') }}"
                class="dropdown-item d-flex align-items-center">
                <i class="fadeIn animated bx bx-user"></i><span>Tài
                  khoản</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('dang-xuat') }}"><i
                  class="bx bx-log-out-circle"></i><span>Đăng xuất</span></a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
