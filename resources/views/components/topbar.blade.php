<!-- Top Bar Start -->
<div class="topbar d-print-none">
    <div class="container-fluid">
        <nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">

            <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
                <li>
                    <button class="nav-link mobile-menu-btn nav-icon" id="togglemenu">
                        <i class="iconoir-menu"></i>
                    </button>
                </li>
                <li class="mx-2 welcome-text">
                    <h5 class="mb-0 fw-semibold text-truncate">Good Morning, James!</h5>
                </li>
            </ul>

            <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false" data-bs-offset="0,19">
                        <img src="{{ asset('dist/assets/images/flags/us_flag.jpg') }}" alt=""
                            class="thumb-sm rounded-circle">
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><img
                                src="{{ asset('dist/assets/images/flags/us_flag.jpg') }}" alt="" height="15"
                                class="me-2">English</a>
                        <a class="dropdown-item" href="#"><img
                                src="{{ asset('dist/assets/images/flags/spain_flag.jpg') }}" alt=""
                                height="15" class="me-2">Spanish</a>
                        <a class="dropdown-item" href="#"><img
                                src="{{ asset('dist/assets/images/flags/germany_flag.jpg') }}" alt=""
                                height="15" class="me-2">German</a>
                        <a class="dropdown-item" href="#"><img
                                src="{{ asset('dist/assets/images/flags/french_flag.jpg') }}" alt=""
                                height="15" class="me-2">French</a>
                    </div>
                </li><!--end topbar-language-->

                <li class="topbar-item">
                    <a class="nav-link nav-icon" href="javascript:void(0);" id="light-dark-mode">
                        <i class="iconoir-half-moon dark-mode"></i>
                        <i class="iconoir-sun-light light-mode"></i>
                    </a>
                </li>



                <li class="dropdown topbar-item">
                    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false" data-bs-offset="0,19">
                        <img src="{{ asset('dist/assets/images/users/avatar-1.jpg') }}" alt=""
                            class="thumb-md rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end py-0">
                        <div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('dist/assets/images/users/avatar-1.jpg') }}" alt=""
                                    class="thumb-md rounded-circle">
                            </div>
                            <div class="flex-grow-1 ms-2 text-truncate align-self-center">
                                <h6 class="my-0 fw-medium text-dark fs-13">William Martin</h6>
                                <small class="text-muted mb-0">Front End Developer</small>
                            </div><!--end media-body-->
                        </div>
                        <div class="dropdown-divider mt-0"></div>
                        <small class="text-muted px-2 pb-1 d-block">Account</small>
                        <a class="dropdown-item" href=""><i
                                class="las la-user fs-18 me-1 align-text-bottom"></i> Profile</a>
                        <a class="dropdown-item" href=""><i
                                class="las la-wallet fs-18 me-1 align-text-bottom"></i> Earning</a>
                        <small class="text-muted px-2 py-1 d-block">Settings</small>
                        <a class="dropdown-item" href=""><i
                                class="las la-cog fs-18 me-1 align-text-bottom"></i>Account Settings</a>
                        <a class="dropdown-item" href=""><i
                                class="las la-lock fs-18 me-1 align-text-bottom"></i> Security</a>
                        <a class="dropdown-item" href=""><i
                                class="las la-question-circle fs-18 me-1 align-text-bottom"></i> Help Center</a>
                        <div class="dropdown-divider mb-0"></div>
                        <a class="dropdown-item text-danger" href=""><i
                                class="las la-power-off fs-18 me-1 align-text-bottom"></i> Logout</a>
                    </div>
                </li>
            </ul><!--end topbar-nav-->
        </nav>
        <!-- end navbar-->
    </div>
</div>
<!-- Top Bar End -->
