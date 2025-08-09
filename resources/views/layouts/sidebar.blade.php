   <div class="sidebar-wrapper" data-simplebar="true">
     <div class="sidebar-header">
       <div>
         <img src="{{ asset('assets/images/logo.png') }}" class="logo-icon"
           alt="logo icon">
       </div>
       <div>
         <h4 class="logo-text">CTUT</h4>
       </div>
       <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
       </div>
     </div>
     <!--navigation-->
     <ul class="metismenu" id="menu">
       <li class="{{ setActive(['quan-ly.trang-chu']) }}">
         <a href="{{ route('quan-ly.trang-chu') }}" class="">
           <div class="parent-icon"><i class='bx bx-home-alt'></i>
           </div>
           <div class="menu-title">Tổng quan</div>
         </a>
       </li>
       <li class="{{ setActive(['quan-ly.tai-khoan.*']) }}">
         <a href="javascript:;" class="has-arrow">
           <div class="parent-icon"><i class="bx bx-category"></i>
           </div>
           <div class="menu-title">Quản lý tài khoản</div>
         </a>
         <ul>
           <li
             class="{{ setActive(['quan-ly.tai-khoan.danh-sach-tai-khoan', 'quan-ly.tai-khoan.form-sua-tai-khoan']) }}">
             <a href="{{ route('quan-ly.tai-khoan.danh-sach-tai-khoan') }}"><i
                 class='bx bx-radio-circle'></i>Danh sách tài khoản</a>
           </li>
           <li class="{{ setActive(['quan-ly.tai-khoan.tao-tai-khoan']) }}"> <a
               href="{{ route('quan-ly.tai-khoan.tao-tai-khoan') }}"><i
                 class='bx bx-radio-circle'></i>Tạo tài khoản</a>
           </li>
         </ul>
       </li>
       <li class="{{ setActive(['quan-ly.khoa-hoc.*']) }}">
         <a href="javascript:;" class="has-arrow">
           <div class="parent-icon"><i class="bx bx-category"></i>
           </div>
           <div class="menu-title">Quản lý khóa học</div>
         </a>
         <ul>
           <li class="{{ setActive(['quan-ly.khoa-hoc.danh-sach-khoa-hoc']) }}">
             <a href="{{ route('quan-ly.khoa-hoc.danh-sach-khoa-hoc') }}"><i
                 class='bx bx-radio-circle'></i>Danh sách khóa học</a>
           </li>
         </ul>
       </li>
       <li class="{{ setActive(['quan-ly.lop.*']) }}">
         <a href="javascript:;" class="has-arrow">
           <div class="parent-icon"><i class="bx bx-category"></i>
           </div>
           <div class="menu-title">Quản lý lớp</div>
         </a>
         <ul>
           <li class="{{ setActive(['quan-ly.lop.*']) }}"> <a
               href="{{ route('quan-ly.lop.danh-sach-lop') }}"><i
                 class='bx bx-radio-circle'></i>Danh sách lớp</a>
           </li>
         </ul>
       </li>
       <li class="{{ setActive(['quan-ly.hoc-vien.*']) }}">
         <a href="javascript:;" class="has-arrow">
           <div class="parent-icon"><i class="bx bx-category"></i>
           </div>
           <div class="menu-title">Quản lý học viên</div>
         </a>
         <ul>
           <li
             class="{{ setActive(['quan-ly.hoc-vien.danh-sach-hoc-vien', 'quan-ly.hoc-vien.form-sua-hoc-vien']) }}">
             <a href="{{ route('quan-ly.hoc-vien.danh-sach-hoc-vien') }}"><i
                 class='bx bx-radio-circle'></i>Danh sách học viên</a>
           </li>
           <li class="{{ setActive(['quan-ly.hoc-vien.form-tao-hoc-vien']) }}">
             <a href="{{ route('quan-ly.hoc-vien.form-tao-hoc-vien') }}"><i
                 class='bx bx-radio-circle'></i>Thêm học viên</a>
           </li>
         </ul>
       </li>
       <li class="{{ setActive(['quan-ly.chung-chi.*']) }}">
         <a href="javascript:;" class="has-arrow">
           <div class="parent-icon"><i class="bx bx-category"></i>
           </div>
           <div class="menu-title">Quản lý chứng chỉ</div>
         </a>
         <ul>
           <li
             class="{{ setActive(['quan-ly.chung-chi.danh-sach-chung-chi']) }}">
             <a href="{{ route('quan-ly.chung-chi.danh-sach-chung-chi') }}"><i
                 class='bx bx-radio-circle'></i>Danh sách chứng chỉ</a>
           </li>
           <li
             class="{{ setActive(['quan-ly.chung-chi.form-tao-chung-chi']) }}">
             <a href="{{ route('quan-ly.chung-chi.form-tao-chung-chi') }}"><i
                 class='bx bx-radio-circle'></i>Tạo chứng chỉ</a>
           </li>
         </ul>
       </li>
       {{-- <li class="{{ setActive(['quan-ly.chung-chi.*']) }}">
         <a href="javascript:;" class="has-arrow">
           <div class="parent-icon"><i class="bx bx-category"></i>
           </div>
           <div class="menu-title">Quản lý điểm</div>
         </a>
         <ul>
           <li
             class="{{ setActive(['quan-ly.chung-chi.danh-sach-chung-chi']) }}">
             <a href="{{ route('quan-ly.chung-chi.danh-sach-chung-chi') }}"><i
                 class='bx bx-radio-circle'></i>Điểm thi</a>
           </li>
         </ul>
       </li> --}}
     </ul>
     <!--end navigation-->
   </div>
