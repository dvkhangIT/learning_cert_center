<div class="sidebar-wrapper" data-simplebar="true">
  <a href="{{ route('nhan-vien.tong-quan') }}" class="sidebar-header">
    <div>
      <img src="{{ asset('assets/images/logo.png') }}" class="logo-icon" alt="logo icon">
    </div>
    <div>
      <h4 class="logo-text">CTUT</h4>
    </div>
    <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i></div>
  </a>
  <!--navigation-->
  <ul class="metismenu" id="menu">
    <li class="{{ setActive(['nhan-vien.tong-quan']) }}">
      <a href="{{ route('nhan-vien.tong-quan') }}" class="">
        <div class="parent-icon"><i class='bx bx-home-alt'></i></div>
        <div class="menu-title">Tổng quan</div>
      </a>
    </li>

    <!-- === Tra cứu chứng chỉ === -->
    <li class="{{ setActive(['nhan-vien.chung-chi.tra-cuu']) }}">
      <a href="{{ url('nhan-vien/chung-chi/tra-cuu') }}">
        <div class="parent-icon"><i class="fadeIn animated bx bx-award"></i></div>
        <div class="menu-title">Tra cứu chứng chỉ</div>
      </a>
    </li>

    <!-- Giữ mục Quản lý kết quả (nếu bạn muốn xóa tiếp thì cho mình biết) -->
    <li class="{{ setActive(['nhan-vien.ket-qua.*']) }}">
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-line-chart'></i></div>
        <div class="menu-title">Nhập điểm học viên</div>
      </a>
      <ul>
        <li class="{{ setActive(['nhan-vien.ket-qua.tieng-anh-ctut']) }}">
          <a href="{{ route('nhan-vien.ket-qua.tieng-anh-ctut') }}"><i class='bx bx-radio-circle'></i>Tiếng Anh CTUT</a>
        </li>
        <li class="{{ setActive(['nhan-vien.ket-qua.tieng-anh-bac-3']) }}">
          <a href="{{ route('nhan-vien.ket-qua.tieng-anh-bac-3') }}"><i class='bx bx-radio-circle'></i>Tiếng Anh bậc 3</a>
        </li>
        <li class="{{ setActive(['nhan-vien.ket-qua.tieng-nhat-n4']) }}">
          <a href="{{ route('nhan-vien.ket-qua.tieng-nhat-n4') }}"><i class='bx bx-radio-circle'></i>Tiếng Nhật N4</a>
        </li>
        <li class="{{ setActive(['nhan-vien.ket-qua.cntt-co-ban']) }}">
          <a href="{{ route('nhan-vien.ket-qua.cntt-co-ban') }}"><i class='bx bx-radio-circle'></i>CNTT cơ bản</a>
        </li>
      </ul>
    </li>

    <!-- === In chứng chỉ === -->
    <li class="{{ setActive(['nhan-vien.chung-chi.in-danh-sach']) }}">
      <a href="{{ route('nhan-vien.chung-chi.in-danh-sach') }}">
        <div class="parent-icon"><i class="fadeIn animated bx bx-printer"></i></div>
        <div class="menu-title">In chứng chỉ</div>
      </a>
    </li>
  </ul>
  <!--end navigation-->
</div>
