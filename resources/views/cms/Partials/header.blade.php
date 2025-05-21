<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Link -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="icon" href="{{ asset('image/Main-Resume/title-icon.png') }}">
    <title>Resume | Ahmad Umar Fikri</title>
</head>
<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar-toggle bg-dark">
            <div class="sidebar-logo text-center fw-bold fs-4 mt-2">
                <a href="/cms" class="text-light">Resume CMS</a>
            </div>
            <!-- Sidebar Navigation -->                
                <ul class="sidebar-nav p-0">                                         
                    <li class="sidebar-header text-light fs-4 px-4 mt-3">
                        Content
                    </li>
                    <hr class="text-light mx-3 my-2">
                    <li class="sidebar-item">
                        <a href="/cms/contact" class="sidebar-link ps-5 fs-5">
                            <i class="fa-solid fa-message text-light"></i>
                            <span class="text-light">Contact Message</span>
                        </a>
                    </li>
                    @if(session('userLevel') === 'admin' || session('userLevel') === 'editor') 
                        <li class="sidebar-item">
                            <a href="/cms/resumePortfolio" class="sidebar-link ps-5 fs-5">
                                <i class="fa-solid fa-folder-open text-light"></i>
                                <span class="text-light">Document</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/cms/project" class="sidebar-link ps-5 fs-5">
                                <i class="fa-solid fa-list-check text-light"></i>
                                <span class="text-light">Project</span>
                            </a>
                        </li>      
                    @endif                              
                    
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed has-dropdown fs-4 px-4 mt-3" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="true" aria-controls="auth">
                            <span class="text-light">Profile</span>
                        </a>
                    </li>
                    <hr class="text-light mx-3 my-2">
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-target="#sidebar">
                        <li class="sidebar-item">
                            <a href="/cms/profileSetting" class="sidebar-link ps-5 text-light fs-5">
                                <i class="fa-solid fa-user-tie text-light"></i>
                                <span class="text-light">Profile Settings</span>
                            </a>
                        </li>
                        @if(session('userLevel') === 'admin')                       
                        <li class="sidebar-item">
                            <a href="/cms/accountList" class="sidebar-link ps-5 text-light fs-5">
                                <i class="fa-solid fa-users text-light"></i>
                                <span class="text-light">Account List</span>
                            </a>
                        </li>
                        @endif
                    </ul>                
                </ul>
                <!-- Sidebar Navigation Ends -->
                <div class="sidebar-footer">
                    <a href="/logout" class="sidebar-link fs-5">
                    <i class="fa-solid fa-arrow-right-from-bracket text-light"></i>
                        <span class="text-light">Logout</span>
                    </a>
                </div>
        </aside>
        <!-- Sidebar Ends -->
        <!-- Main Component -->
         <div class="main">
            <!-- Navbar -->
            <nav class="navbar navbar-expand border-bottom bg-dark">
                <button class="toggler-btn" type="button">
                    <i class="fa-solid fa-align-left fs-4 text-light"></i>
                </button>
            </nav>
            <!-- Main Content -->
            <main class="p-3">
                @if(session('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                icon: 'success',
                                iconColor: 'white',
                                title: @json(session('success')),
                                // text: @json(session('success')),
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true,
                                customClass: {
                                    popup: 'colored-toast'
                                }
                            });
                        });
                    </script>                
                @elseif(session('error'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                icon: 'error',
                                iconColor: 'white',
                                title: @json(session('error')),
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true,
                                customClass: {
                                    popup: 'colored-toast'
                                }
                            });
                        });
                    </script>
                @elseif($errors->any())
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            @foreach ($errors->all() as $error)
                                Swal.fire({
                                    toast: true,
                                    position: "top-end",
                                    icon: 'error',
                                    iconColor: 'white',
                                    title: @json($error),
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                    customClass: {
                                        popup: 'colored-toast'
                                    }
                                });
                            @endforeach
                        });
                    </script>
                @endif                   
                <div class="container-fluid">

