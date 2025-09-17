   <div class="sidebar-wrapper" data-simplebar="true">
     <div class="sidebar-header">
       <a href="{{ route('quan-ly.tong-quan') }}">
         <img src="{{ asset('assets/images/logo.png') }}" class="logo-icon"
           alt="logo icon">
       </a>
       <div>
         {{-- <h4 class="logo-text">CTUT</h4> --}}
         <h4 class="logo-text text-uppercase">Trung tâm <br> Ngoại ngữ - Tin học
         </h4>
       </div>
       <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
       </div>
     </div>
     <!--navigation-->
     <ul class="metismenu" id="menu">
       <li class="{{ setActive(['quan-ly.tong-quan']) }}">
         <a href="{{ route('quan-ly.tong-quan') }}" class="">
           <div class="parent-icon"><i class='bx bx-home-alt'></i>
           </div>
           <div class="menu-title">Tổng quan</div>
         </a>
       </li>
       <li class="{{ setActive(['quan-ly.tai-khoan.*']) }}">
         <a href="javascript:;" class="has-arrow">
           <div class="parent-icon"><i class="fadeIn animated bx bx-user"></i>
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
           <div class="parent-icon"><i class="fadeIn animated bx bx-book"></i>
           </div>
           <div class="menu-title">Quản lý khóa học</div>
         </a>
         <ul>
           <li
             class="{{ setActive(['quan-ly.khoa-hoc.danh-sach-khoa-hoc']) }}">
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
           <div class="parent-icon"><i class="fadeIn animated bx bx-group"></i>
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
       <li
         class="{{ setActive(['quan-ly.chung-chi.*', 'quan-ly.loai-chung-chi.*']) }}">
         <a href="javascript:;" class="has-arrow">
           <div class="parent-icon"><i class="fadeIn animated bx bx-award"></i>
           </div>
           <div class="menu-title">Quản lý chứng chỉ</div>
         </a>
         <ul>
           <li
             class="{{ setActive(['quan-ly.loai-chung-chi.danh-sach-loai-chung-chi']) }}">
             <a
               href="{{ route('quan-ly.loai-chung-chi.danh-sach-loai-chung-chi') }}"><i
                 class='bx bx-radio-circle'></i>Loại chứng chỉ</a>
           </li>
           <li
             class="{{ setActive(['quan-ly.loai-chung-chi.form-tao-loai-chung-chi']) }}">
             <a
               href="{{ route('quan-ly.loai-chung-chi.form-tao-loai-chung-chi') }}"><i
                 class='bx bx-radio-circle'></i>Tạo loại chứng chỉ</a>
           </li>
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
       <li class="{{ setActive(['quan-ly.ket-qua.*']) }}">
         <a href="javascript:;" class="has-arrow">
           <div class="parent-icon"><i class='bx bx-line-chart'></i>
           </div>
           <div class="menu-title">Quản lý kết quả</div>
         </a>
         <ul>
           <li class="{{ setActive(['quan-ly.ket-qua.tieng-anh-ctut']) }}">
             <a href="{{ route('quan-ly.ket-qua.tieng-anh-ctut') }}"><i
                 class='bx bx-radio-circle'></i>Tiếng anh CTUT</a>
           </li>
           <li class="{{ setActive(['quan-ly.ket-qua.tieng-anh-bac-3']) }}">
             <a href="{{ route('quan-ly.ket-qua.tieng-anh-bac-3') }}"><i
                 class='bx bx-radio-circle'></i>Tiếng anh bậc 3</a>
           </li>
           <li class="{{ setActive(['quan-ly.ket-qua.tieng-nhat-n4']) }}">
             <a href="{{ route('quan-ly.ket-qua.tieng-nhat-n4') }}"><i
                 class='bx bx-radio-circle'></i>Tiếng nhật N4</a>
           </li>
           <li class="{{ setActive(['quan-ly.ket-qua.cntt-co-ban']) }}">
             <a href="{{ route('quan-ly.ket-qua.cntt-co-ban') }}"><i
                 class='bx bx-radio-circle'></i>CNTT cơ bản</a>
           </li>
           <li class="{{ setActive(['quan-ly.ket-qua.ket-qua-da-xoa']) }}">
             <a href="{{ route('quan-ly.ket-qua.ket-qua-da-xoa') }}"><i
                 class='bx bx-radio-circle'></i>Kết quả đã xóa</a>
           </li>
         </ul>
       </li>
     </ul>
     <!--end navigation-->
   </div>
