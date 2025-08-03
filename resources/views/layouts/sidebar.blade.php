   <div class="sidebar-wrapper" data-simplebar="true">
     <div class="sidebar-header">
       <div>
         <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
       </div>
       <div>
         <h4 class="logo-text">Rocker</h4>
       </div>
       <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
       </div>
     </div>
     <!--navigation-->
     <ul class="metismenu" id="menu">
       <li class="">
         <a href="{{ route('admin.dashboard') }}" class="">
           <div class="parent-icon"><i class='bx bx-home-alt'></i>
           </div>
           <div class="menu-title">Tổng quan</div>
         </a>
       </li>
       <li>
         <a href="javascript:;" class="has-arrow">
           <div class="parent-icon"><i class="bx bx-category"></i>
           </div>
           <div class="menu-title">Tài khoản</div>
         </a>
         <ul>
           <li> <a href="{{ route('admin.account.index') }}"><i
                 class='bx bx-radio-circle'></i>Danh sách tài khoản</a>
           </li>
           <li> <a href="{{ route('admin.account.create') }}"><i
                 class='bx bx-radio-circle'></i>Tạo tài khoản</a>
           </li>
         </ul>
       </li>
       <li>
         <a href="javascript:;" class="has-arrow">
           <div class="parent-icon"><i class="bx bx-category"></i>
           </div>
           <div class="menu-title">Khóa học</div>
         </a>
         <ul>
           <li> <a href="{{ route('admin.course.index') }}"><i
                 class='bx bx-radio-circle'></i>Danh sách khóa học</a>
           </li>
         </ul>
       </li>
       <li>
         <a href="javascript:;" class="has-arrow">
           <div class="parent-icon"><i class="bx bx-category"></i>
           </div>
           <div class="menu-title">Lớp</div>
         </a>
         <ul>
           <li> <a href="{{ route('admin.class.index') }}"><i
                 class='bx bx-radio-circle'></i>Danh sách lớp</a>
           </li>
         </ul>
       </li>
     </ul>
     <!--end navigation-->
   </div>
