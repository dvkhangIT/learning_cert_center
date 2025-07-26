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
           <li> <a href="app-chat-box.html"><i
                 class='bx bx-radio-circle'></i>Chat Box</a>
           </li>
         </ul>
       </li>
     </ul>
     <!--end navigation-->
   </div>
