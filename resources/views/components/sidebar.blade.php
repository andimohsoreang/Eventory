 <!-- leftbar-tab-menu -->
 <div class="startbar d-print-none">
     <!--start brand-->
     <div class="brand">
         <a href="index.html" class="logo">
             <span>
                 <img src="{{ asset('dist/assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm">
             </span>
             <span class="">
                 <img src="{{ asset('dist/assets/images/logo-light.png') }}" alt="logo-large" class="logo-lg logo-light">
                 <img src="{{ asset('dist/assets/images/logo-dark.png') }}" alt="logo-large" class="logo-lg logo-dark">
             </span>
         </a>
     </div>
     <!--end brand-->
     <!--start startbar-menu-->
     <div class="startbar-menu">
         <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
             <div class="d-flex align-items-start flex-column w-100">
                 <!-- Navigation -->
                 <ul class="navbar-nav mb-auto w-100">
                     <li class="menu-label mt-2">
                         <span>Navigation</span>
                     </li>

                     <li class="nav-item">
                         <a class="nav-link" href="{{ route('admin.dashboard') }}">
                             <i class="iconoir-report-columns menu-icon"></i>
                             <span>Dashboard</span>
                             {{-- <span class="badge text-bg-warning ms-auto">08</span> --}}
                         </a>
                     </li><!--end nav-item-->

                     <li class="nav-item">
                         <a class="nav-link" href="#sidebarAnalytics" data-bs-toggle="collapse" role="button"
                             aria-expanded="false" aria-controls="sidebarAnalytics">
                             <i class="iconoir-reports menu-icon"></i>
                             <span>Master Data</span>
                         </a>
                         <div class="collapse " id="sidebarAnalytics">
                             <ul class="nav flex-column">
                                 @if (Auth::user()->role == 'admin')
                                     <li class="nav-item">
                                         <a href="{{ route('admin.account') }}" class="nav-link ">User</a>
                                     </li><!--end nav-item-->
                                 @endif

                                 <li class="nav-item">
                                     <a href="{{ route('admin.category') }}" class="nav-link ">Category Dana</a>
                                 </li><!--end nav-item-->
                                 {{-- <li class="nav-item">
                                     <a href="/admin/catdevice" class="nav-link ">Category Device</a>
                                 </li><!--end nav-item--> --}}
                                 <li class="nav-item">
                                     <a href="/admin/brands" class="nav-link ">Brand</a>
                                 </li><!--end nav-item-->
                                 <li class="nav-item">
                                     <a href="{{ route('admin.tipe') }}" class="nav-link ">Tipe</a>
                                 </li><!--end nav-item-->
                             </ul><!--end nav-->
                         </div>
                     </li><!--end nav-item-->
                     <li class="nav-item">
                         <a class="nav-link" href="#sidebarEcommerce" data-bs-toggle="collapse" role="button"
                             aria-expanded="false" aria-controls="sidebarEcommerce">
                             <i class="iconoir-cart-alt menu-icon"></i>
                             <span>Gedung</span>
                         </a>
                         <div class="collapse " id="sidebarEcommerce">
                             <ul class="nav flex-column">
                                 <li class="nav-item">
                                     <a class="nav-link" href="{{ route('admin.gedung') }}">Gedung</a>
                                 </li><!--end nav-item-->
                             </ul><!--end nav-->
                         </div>
                     </li><!--end nav-item-->


                     <li class="menu-label mt-2">
                         <small class="label-border">
                             <div class="border_left hidden-xs"></div>
                             <div class="border_right"></div>
                         </small>
                         <span>Components</span>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="#sidebarForms" data-bs-toggle="collapse" role="button"
                             aria-expanded="false" aria-controls="sidebarForms">
                             <i class="iconoir-cube-hole menu-icon"></i>
                             <span>Devices</span>
                         </a>
                         <div class="collapse " id="sidebarForms">
                             <ul class="nav flex-column">
                                 <li class="nav-item">
                                     <a class="nav-link" href="{{ route('admin.device') }}">Devices</a>
                                 </li><!--end nav-item-->
                             </ul><!--end nav-->
                         </div><!--end startbarForms-->
                     </li><!--end nav-item-->

                     {{-- <li class="nav-item">
                         <a class="nav-link" href="#sidebarAuthentication" data-bs-toggle="collapse" role="button"
                             aria-expanded="false" aria-controls="sidebarAuthentication">
                             <i class="iconoir-fingerprint-lock-circle menu-icon"></i>
                             <span>Authentication</span>
                         </a>
                         <div class="collapse " id="sidebarAuthentication">
                             <ul class="nav flex-column">
                                 <li class="nav-item">
                                     <a class="nav-link" href="auth-login.html">Log in</a>
                                 </li><!--end nav-item-->
                                 <li class="nav-item">
                                     <a class="nav-link" href="auth-register.html">Register</a>
                                 </li><!--end nav-item-->
                                 <li class="nav-item">
                                     <a class="nav-link" href="auth-recover-pw.html">Re-Password</a>
                                 </li><!--end nav-item-->
                                 <li class="nav-item">
                                     <a class="nav-link" href="auth-lock-screen.html">Lock Screen</a>
                                 </li><!--end nav-item-->
                                 <li class="nav-item">
                                     <a class="nav-link" href="auth-maintenance.html">Maintenance</a>
                                 </li><!--end nav-item-->
                                 <li class="nav-item">
                                     <a class="nav-link" href="auth-404.html">Error 404</a>
                                 </li><!--end nav-item-->
                                 <li class="nav-item">
                                     <a class="nav-link" href="auth-500.html">Error 500</a>
                                 </li><!--end nav-item-->
                             </ul><!--end nav-->
                         </div><!--end startbarAuthentication-->
                     </li><!--end nav-item--> --}}
                 </ul><!--end navbar-nav--->
             </div>
         </div><!--end startbar-collapse-->
     </div><!--end startbar-menu-->
 </div><!--end startbar-->
 <div class="startbar-overlay d-print-none"></div>
 <!-- end leftbar-tab-menu-->
