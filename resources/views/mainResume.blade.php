<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Link -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="icon" href="{{ asset('image/Main-Resume/title-icon.png') }}">
    <title>Resume | Ahmad Umar Fikri</title>
</head>
<body>
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: "Success",
                    text: @json(session('success')),                 
                    icon: "success",
                    iconColor: "#1b3785",
                    confirmButtonColor: "#2c3e50",
                    confirmButtonText: "Okay",
                });
            });
        </script>                
    @elseif(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: "Error",
                    text: @json(session('error')),                    
                    icon: "error",
                    iconColor: "#A52A2A",
                    confirmButtonColor: "#2c3e50",
                    confirmButtonText: "Okay",
                });
            });
        </script>
    @elseif($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                @foreach ($errors->all() as $error)
                    Swal.fire({
                        title: "Error",
                        text: @json($error),                    
                        icon: "error",
                        iconColor: "#A52A2A",
                        confirmButtonColor: "#2c3e50",
                        confirmButtonText: "Okay",
                    });
                @endforeach
            });
        </script>
    @endif 

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top py-4 navbar-dark bg-secondary">
        <div class="container">
            <!-- Optional Logo -->
            <!-- <a href="index.html" class="navbar-brand">
                <img src="image/logo.png" alt="" width="225" />
            </a> -->
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto fs-5">
                    <li class="nav-item me-3">
                        <a href="#" class="nav-link fw-semibold text-light">Home</a>
                    </li>
                    <li class="nav-item me-3">
                        <a href="#about" class="nav-link fw-semibold text-light">Profile</a>
                    </li>
                    <li class="nav-item ">
                        <a href="#skills" class="nav-link fw-semibold text-light">Skills & Expertise</a>
                    </li>   
                    @if ($project->isNotEmpty())                 
                    <li class="nav-item ">
                        <a href="#project" class="nav-link fw-semibold text-light">Projects</a>
                    </li>
                    @endif
                    <li class="nav-item ">
                        <a href="#contact" class="nav-link fw-semibold text-light">Contact</a>
                    </li>
                    <!-- Comment for Static -->
                    <li class="nav-item ms-md-4">
                        <a href="/loginPage" class="btn btn-light rounded-3 fw-semibold text-secondary">Login CMS</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="header text-center position-relative">
        <div class="text-container position-relative d-flex flex-column justify-content-center align-items-center h-100">
            <h1 class="text-light fs-3 fw-bold ">Hello, I'm <br>
                <span id="typing-text" class="fw-bold display-3 text-light" ></span>
            </h1>

            <p class="roles text-light fs-4">
                <span>Web Developer |</span>
                <span>Computer Science Background |</span>
                <span>Librarian </span>
            </p>

            <a href="#about" class="btn btn-outline-light btn-lg mt-3 rounded">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fa-regular fa-square-caret-down"></i>
                    </div>
                    <div class="text-start">
                        <span class="fw-bold">More About Me</span>
                    </div>
                </div>
            </a>     
            
            <div class="row g-3 justify-content-center pt-6 pt-sm-8 mx-auto">
                <div class="col-12 col-sm-6 d-grid">
                    <a href="{{ asset('document/resume.pdf') }}"
                    class="btn btn-info btn-lg rounded text-uppercase text-light d-flex align-items-center justify-content-center"
                    target="_blank" 
                    rel="noopener noreferrer">
                        Resume
                    </a>
                </div>
                <div class="col-12 col-sm-6 d-grid">
                    <a href="{{ asset('document/portfolio.pdf') }}" 
                    class="btn btn-info btn-lg rounded text-uppercase text-light d-flex align-items-center justify-content-center"
                    target="_blank" 
                    rel="noopener noreferrer">
                        Portfolio
                    </a>
                </div>
            </div>
        </div>

        
    </header>

    <!-- About -->
    <section id="about" class="about bg-secondary py-5">
      <div class="container">
        <div class="text-center text-white">
          <h3 class="text-uppercase fw-bold fs-2">About Me</h3>
          <hr class="w-25 mx-auto" />
          <h2 class="mb-4">Let me introduce myself.</h2>
        </div>
        <div class="about-content d-flex flex-column flex-md-row gap-5 align-items-center text-white">
          <img
            src="image/Main-Resume/about-display-pic.jpg"
            alt="Profile picture of Ahmad Umar Fikri"
            class="about-img img-fluid rounded-circle"
          />
          <p class="lead fw-light fs-4" style="text-align: justify;">
            Self-motivated with a background in computer science, driven to grow in the tech field. 
            Currently seeking opportunities in web development, with a strong interest in building a 
            career as a software developer.
          </p>
        </div>
      </div>
    </section>

    <!-- Profile -->
    <section id="profile" class="profile bg-white py-5">
        <div class="container">
            <div class="text-center text-primary">
                <h3 class="text-uppercase fw-bold fs-2">Profile</h3>
                <hr class="w-25 mx-auto text-primary mb-5" />
            </div>
            <div class="row">
                <!-- Profile -->
                <div class="col-md-6">
                    <h3 class="text-uppercase fw-bold text-primary">Profile</h3>
                    <p>
                        Here's a little more about me, so you can get to know me better.
                    </p>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item mb-3">
                        <h5><i class="fas fa-user text-primary"></i> <span class="text-primary">Full Name:</span></h5>
                        <p>Ahmad Umar Fikri Bin Ahmad Fathillah</p>
                    </li>
                    <li class="list-group-item mb-3">
                        <h5><i class="fas fa-calendar text-primary"></i> <span class="text-primary">Birth Date:</span></h5>
                        <p>17 December 2000</p>
                    </li>
                    <li class="list-group-item mb-3">
                        <h5><i class="fas fa-building text-primary"></i> <span class="text-primary">Current Position:</span></h5>
                        <p>Pembantu Pustakawan S1 (Librarian) <br>at Perbadanan Perpustakaan Awam Negeri Perak (PPANPk)</p>
                    </li>
                    <li class="list-group-item mb-3">
                        <h5><i class="fa-solid fa-phone text-primary"></i> <span class="text-primary">Phone Number:</span></h5>
                        <p>(+60) 18 - 959 8505</p>
                    </li>
                    <li class="list-group-item mb-3">
                        <h5><i class="fas fa-envelope text-primary"></i> <span class="text-primary">Email:</span></h5>
                        <p>umarfikri1712@gmail.com</p>
                    </li>
                    </ul>
                </div>
                <!-- Education -->
                <div class="col-md-6">
                    <h3 class="text-uppercase fw-bold text-primary">Education</h3>
                    <p>
                        My academic credentials and the institutions where I studied.
                    </p>
                    <div class="mb-4">                
                        <h5 class="fw-bold text-primary">Bachelor of Computer Science (Hons.)</h5>
                        <h5 class="fs-6 text-secondary">Universiti Teknologi MARA (UiTM), Tapah Campus</h5>
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <h5 class="fs-6">2019 - 2023</h5>
                            </div>
                            <div class="col-12 col-md-3">
                                <h5 class="fs-6 fw-semibold">CGPA : 3.46</h5>
                            </div>
                        </div> 
                    </div>
                    
                    <div class="mb-4">                
                        <h5 class="fw-bold text-primary">Module II Physical Science</h5>
                        <h5 class="fs-6 text-secondary">Perak Matriculation College (KMPK)</h5>
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <h5 class="fs-6">2018 - 2019</h5>
                            </div>
                            <div class="col-12 col-md-3">
                                <h5 class="fs-6 fw-semibold">CGPA : 2.96</h5>
                            </div>
                        </div>                        
                    </div>     
                    
                    <div class="mb-4">                
                        <h5 class="fw-bold text-primary">Sijil Pelajaran Malaysia | SPM</h5>
                        <h5 class="fs-6 text-secondary">Sekolah Menengah Kebangsaan Tambun</h5>
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <h5 class="fs-6">2013 - 2017</h5>
                            </div>
                            <div class="col-12 col-md-9">
                                <h5 class="fs-6 fw-semibold">Grade : 1A+, 3A-, 2B+, 1B, 1C+, 1C</h5>
                            </div>
                        </div>                        
                    </div>   
                </div>
            </div>        
        </div>
    </section>

    <!-- Skills -->
    <section id="skills" class="skills bg-dark text-light py-5">
        <div class="skills-content position-relative text-center">
        
            <div class="container">   
                <h3 class="text-uppercase fw-bold fs-2">SKILLS AND EXPERTISE</h3>
                <hr class="w-25 mx-auto mb-5" />             
                <!-- Skills Row 1 -->
                <div class="row">
                    <!-- Programming Card -->
                    <div class="col-12 col-md-6 col-lg-4 mb-4">                        
                        <div class="card bg-light shadow-sm border-0 rounded-4">                            
                            <div class="card-body">
                                <h4 class="fw-semibold mb-4 text-primary"><strong>Programming Skills</strong></h4>
                                <ul class="list-unstyled mx-3">
                                    <li class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fab fa-html5 text-danger me-2"></i>
                                            <span class="fw-bold">HTML</span>
                                        </div>
                                        <span class="badge bg-info text-light">Intermediate</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fab fa-php text-primary me-2"></i>
                                            <span class="fw-bold">PHP</span>
                                        </div>
                                        <span class="badge bg-info text-light">Intermediate</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fab fa-js text-warning me-2"></i>
                                            <span class="fw-bold">JavaScript</span>
                                        </div>
                                        <span class="badge bg-info text-light">Intermediate</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-database text-primary me-2"></i>
                                            <span class="fw-bold">SQL</span>
                                        </div>
                                        <span class="badge bg-info text-light">Intermediate</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-code text-primary me-2"></i>
                                            <span class="fw-bold">C++</span>
                                        </div>
                                        <span class="badge bg-success text-light">Beginner</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fab fa-java text-danger me-2"></i>
                                            <span class="fw-bold">Java</span>
                                        </div>
                                        <span class="badge bg-success text-light">Beginner</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="fab fa-python text-primary me-2"></i>
                                            <span class="fw-bold">Python</span>
                                        </div>
                                        <span class="badge bg-success text-light">Beginner</span>
                                    </li>
                                </ul>
                            </div>                            
                        </div>
                    </div>
                    <!-- Framework Card -->
                    <div class="col-12 col-md-6 col-lg-4 mb-4">                        
                        <div class="card bg-light shadow-sm border-0 rounded-4">                            
                            <div class="card-body">
                                <h4 class="fw-semibold mb-4 text-primary"><strong>Framework</strong></h4>
                                <ul class="list-unstyled mx-3">
                                    <li class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fab fa-laravel text-danger me-2"></i>
                                            <span class="fw-bold">Laravel</span>
                                        </div>
                                        <span class="badge bg-info text-light">Intermediate</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fab fa-bootstrap text-primary me-2" style="color: purple;"></i>
                                            <span class="fw-bold">Bootstrap</span>
                                        </div>
                                        <span class="badge bg-info text-light">Intermediate</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-code text-primary me-2"></i>
                                            <span class="fw-bold">CodeIgniter4</span>
                                        </div>
                                        <span class="badge bg-info text-light">Intermediate</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-code text-primary me-2"></i>
                                            <span class="fw-bold">CodeIgniter3</span>
                                        </div>
                                        <span class="badge bg-info text-light">Intermediate</span>
                                    </li>                                    
                                    <li class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-code text-dark me-2"></i>
                                            <span class="fw-bold">jQuery</span>
                                        </div>
                                        <span class="badge bg-success text-light">Beginner</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fab fa-angular text-danger me-2"></i>
                                            <span class="fw-bold">Angular</span>
                                        </div>
                                        <span class="badge bg-success text-light">Beginner</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-code text-primary me-2"></i>
                                            <span class="fw-bold">Ionic</span>
                                        </div>
                                        <span class="badge bg-success text-light">Beginner</span>
                                    </li>
                                </ul>
                            </div>                            
                        </div>
                    </div>
                    <!-- Language Card -->
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card bg-light shadow-sm border-0 rounded-4">                            
                            <div class="card-body">
                                <h4 class="fw-semibold mb-4 text-primary"><strong>Language</strong></h4>
                                <ul class="list-unstyled mx-3">
                                    <li class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-m text-success me-2"></i>
                                            <span class="fw-bold">Bahasa Melayu</span>
                                        </div>
                                        <span class="badge bg-primary text-light">Native</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-e text-danger me-2"></i>
                                            <span class="fw-bold">English</span>
                                        </div>
                                        <span class="badge bg-info text-light">Intermediate</span>
                                    </li>                                    
                                </ul>
                            </div>                            
                        </div>
                    </div>
                    <!-- Tools Card -->
                    <div class="col-12 col-md-6 mb-4 mx-auto">                        
                        <div class="card bg-light shadow-sm border-0 rounded-4">                            
                            <div class="card-body text-center">
                                <h4 class="fw-semibold mb-4 text-primary"><strong>Tools</strong></h4>
                                <ul class="list-unstyled">
                                    <li class="d-flex align-items-center justify-content-center mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-laptop-code text-primary me-2"></i>
                                            <span class="fw-bold">VS Code</span>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-center mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-brands fa-github me-2" style="color: purple;"></i>
                                            <span class="fw-bold">Git / GitHub</span>
                                        </div>
                                    </li>    
                                    <li class="d-flex align-items-center justify-content-center mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fab fa-php text-primary me-2"></i>
                                            <span class="fw-bold">phpMyAdmin</span>
                                        </div>
                                    </li>  
                                    <li class="d-flex align-items-center justify-content-center mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-database text-primary me-2"></i>
                                            <span class="fw-bold">MySQL</span>
                                        </div>
                                    </li>  
                                    <li class="d-flex align-items-center justify-content-center mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-database text-danger me-2"></i>
                                            <span class="fw-bold">XAMPP</span>
                                        </div>
                                    </li>  
                                    <li class="d-flex align-items-center justify-content-center mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-brands fa-microsoft text-info me-2"></i>
                                            <span class="fw-bold">Microsoft Office</span>
                                        </div>
                                    </li>                                  
                                </ul>
                            </div>                            
                        </div>
                    </div>                    
                </div>                
            </div>           
        </div>
    </section>

    <!-- Experience -->
    <section id="experience" class="experience bsb-timeline-1 py-5">
        <div class="container text-center">
            <h3 class="text-uppercase fw-bold fs-2 text-primary">EXPERIENCE</h3>
            <hr class="w-25 mx-auto text-primary mb-5" />
        </div>
        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 col-md-8 col-xl-6">                    

                    <ul class="timeline">
                        <!-- Librarian Contract -->
                        <li class="timeline-item">
                            <div class="timeline-body">
                                <div class="timeline-content">
                                    <div class="card border-0">
                                        <div class="card-body p-0">
                                            <h5 class="card-subtitle text-secondary mb-1">October 2023 - Present</h5>
                                            <h3 class="card-title text-primary">Librarian</h3>
                                            <h5 class="card-title text-primary">Contract S1 / S19</h5>
                                            <h5 class="card-title text-secondary fs-6">Perbadanan Perpustakaan Awam Negeri Perak (PPANPk)</h5>
                                            <div class="mb-3">
                                                <h5 class="card-title text-secondary fs-6 mb-3">(Unit Teknologi Maklumat ICT)</h5>
                                                <ul class="card-text custom-bullet m-0" style="text-align: justify;">                                               
                                                    <li>
                                                        Assisted in developing system applications to meet organizational needs using MVC
                                                        Framework (Laravel, Codeigniter 3, Codeigniter 4, Bootstrap).
                                                    </li>
                                                    <li>
                                                        Managed procurement, maintenance, and troubleshooting of ICT equipment, including
                                                        servers and network systems.
                                                    </li>
                                                    <li>
                                                        Monitored and managed ICT asset movement, including rentals and loans.
                                                    </li>
                                                    <li>
                                                        Assisted in installing and configuring new ICT equipment and network systems for the
                                                        organization.
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="mb-1">
                                                <h5 class="card-title text-secondary fs-6 mb-3">(Unit Perpustakaan Awam Negeri dan Gerakan Membaca)</h5>
                                                <ul class="card-text custom-bullet m-0" style="text-align: justify;">                                               
                                                    <li>
                                                        Engaged with the community through outreach activities and partnerships with local
                                                        schools and organizations and promoted library activities such as mobile library bus
                                                        services, knowledge discourses, quizzes and public activities, and workshops.
                                                    </li>
                                                    <li>
                                                        Managed circulation desk operations, including checking in and out materials and
                                                        collecting fines using the KOHA system and an in-house website known as EZiSTAT.
                                                    </li>
                                                    <li>
                                                        Instructed children in coding and programming concepts through interactive sessions
                                                        using LEGO Education Spike Prime.
                                                    </li>
                                                </ul>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- PSH -->
                        <li class="timeline-item">
                            <div class="timeline-body">
                                <div class="timeline-content">
                                    <div class="card border-0">
                                        <div class="card-body p-0">
                                            <h5 class="card-subtitle text-secondary mb-1">February 2023 - October 2023</h5>
                                            <h3 class="card-title text-primary">Librarian</h3>
                                            <h5 class="card-title text-primary">Pekerja Sambilan Harian (PSH) S19</h5>
                                            <h5 class="card-title text-secondary fs-6">Perbadanan Perpustakaan Awam Negeri Perak (PPANPk)</h5>
                                            <h5 class="card-title text-secondary fs-6 mb-3">(Unit Pengurusan dan Pembangunan Koleksi)</h5>
                                            <ul class="card-text custom-bullet m-0" style="text-align: justify;">                                               
                                                <li>
                                                    Evaluated, selected, and acquired library materials including books, electronic resources, and multimedia for the interest of library patrons.
                                                </li>
                                                <li>
                                                    Interacted and negotiated with book suppliers and vendors in order to reach an arrangement to acquire and obtain materials for the library's collection. 
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Internship -->
                        <li class="timeline-item">
                            <div class="timeline-body">
                                <div class="timeline-content">
                                    <div class="card border-0">
                                        <div class="card-body p-0">
                                            <h5 class="card-subtitle text-secondary mb-1">October 2022 - February 2023</h5>
                                            <h3 class="card-title text-primary">Internship</h3>
                                            <h5 class="card-title text-secondary fs-6">Perbadanan Perpustakaan Awam Negeri Perak (PPANPk)</h5>
                                            <h5 class="card-title text-secondary fs-6 mb-3">(Unit Teknologi Maklumat ICT)</h5>
                                            <ul class="card-text custom-bullet m-0" style="text-align: justify;">
                                                <li>
                                                    Developed a Content Management System (CMS) website to facilitate content addition on the library's official website by staff without programming knowledge.
                                                </li>
                                                <li>
                                                    Troubleshot and resolved basic technical issues related to library computers, printers, and software.
                                                </li>
                                                <li>
                                                    Provided basic training and assistance with technology tools and software applications to library staff.
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </section>

    @if ($project->isNotEmpty())
    <!-- Projects -->
    <section id="project" class="project bg-primary position-relative text-light py-5">
        <div class="project-content position-relative">
            <div class="container text-center">
                <h3 class="text-uppercase fw-bold fs-2 text-light">PROJECTS</h3>
                <hr class="w-25 mx-auto text-light mb-3" />
            </div>
            <div class="container">            
                <div class="project-highlight-box col-md-6 offset-md-3 d-flex flex-column align-items-center text-center mb-5">                    
                    <h2 class="fw-bold">Project Highlights</h2>
                    <p> 
                        These projects were developed during my learning journey, 
                        showcasing my ability to apply web development skills to create responsive and user-friendly websites.
                    </p>
                </div>         

                <!-- Projects-->
                <div class="row d-flex justify-content-center">
                    @foreach ($project as $indexProjectItem => $projectItem)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card bg-light" style="min-height: 325px;">
                        <a data-bs-toggle="modal" data-bs-target="#modal{{ str_replace(' ', '', $projectItem->projectName) }}">
                            <img src="{{ $projectItem->mainImagePath ? asset($projectItem->mainImagePath) : asset('image/Main-Resume/no-image-placeholder.png') }}" alt="Image of {{ $projectItem->projectName }} Project" class="card-img-top">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <p class="mb-1 fw-bold text-primary">{{ $projectItem->projectName }}</p>
                                <p>{{ $projectItem->projectSummary }}</p>
                            </div>
                        </a>
                        </div>
                    </div>        
                    @endforeach                                                  
                </div>               
            </div>
        </div>        
    </section>

    <!-- Project Modals -->
    <div class="project-modals">
        <!-- Modal Project -->
        @foreach ($project as $indexModal => $singleProject) 
            @if (is_object($singleProject) && isset($singleProject->projectName))
            <div id="modal{{ str_replace(' ', '', $singleProject->projectName) }}" class="modal fade">
                <div class="modal-dialog modal-lg mt-7">
                    <div class="modal-content bg-light p-5">
                        <div class="row">
                            @php
                                $imagePaths = json_decode($singleProject->imagePaths, true);
                                if (!is_array($imagePaths)) {
                                    $imagePaths = [];
                                }
                            @endphp
                            
                        @if (count($imagePaths) > 0)
                            <div class="col-12 col-lg-6 d-flex align-items-center">
                                <!-- Carousel -->
                                <div id="modalImage{{ str_replace(' ', '', $singleProject->projectName) }}" class="fullscreen-modal-img carousel slide mb-4" data-bs-ride="carousel">
                                    
                                    <div class="carousel-inner">
                                        @foreach ($imagePaths as $indexImage => $path)
                                        <div class="carousel-item {{ $indexImage === 0 ? 'active' : '' }}">
                                            <img src="{{ asset($path) }}" class="d-block w-100" alt="Project Image {{ $indexImage + 1 }}">
                                        </div>
                                        @endforeach                                    
                                    </div>                                
                                    <!-- Controls -->
                                    <button class="carousel-control-prev" type="button" data-bs-target="#modalImage{{ str_replace(' ', '', $singleProject->projectName) }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#modalImage{{ str_replace(' ', '', $singleProject->projectName) }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                        @else
                            <div class="col-12">
                        @endif
                                <h3 class="text-primary text-center">{{ $singleProject->projectName }}</h3>
                                <p style="text-align: justify;">{!! nl2br(e($singleProject->projectDescription)) !!}</p>                             
                                <div class="d-flex justify-content-center">
                                    @if ($singleProject->projectURL)
                                    <a href="{{ $singleProject->projectURL }}" class="btn btn-primary text-white mx-2 rounded-3"
                                        target="_blank" rel="noopener noreferrer">
                                        Website
                                    </a>
                                    @endif
                                    <button class="btn btn-primary text-white mx-2 rounded-3" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endforeach                        
    </div>   
    @endif

    <!-- Contact -->
    <section id="contact" class="contact bg-primary py-5">
        <div class="container">
            <div class="text-center text-light mb-5">
                <h3 class="text-uppercase fw-bold fs-2">Contact</h3>
                <hr class="w-25 mx-auto mb-3" />
                <p class="mb-0 fs-5">Let’s connect and create something awesome together.</p>
            </div>

            <div class="row g-4 d-flex justify-content-center">
                <!-- Contact Info -->
                <div class="col-md-5">
                    <div class="card bg-light shadow-sm h-100">
                        <div class="card-body text-dark">
                            <h4 class="fw-bold text-primary text-center mb-3"></i> Get in Touch</h4>
                            <p>Whether it’s a new project, feedback, or just a chat — I’d love to hear from you.</p>

                            <div class="mb-3 d-flex align-items-start">
                                <i class="fas fa-phone text-primary fs-5 me-3 mt-1"></i>
                                <span>(+60) 18 - 959 8505</span>
                            </div>

                            <div class="mb-3 d-flex align-items-start">
                                <i class="fas fa-envelope text-primary fs-5 me-3 mt-1"></i>
                                <span class="text-break">umarfikri1712@gmail.com</span>
                            </div>

                            <div class="d-flex align-items-start">
                                <i class="fas fa-map-marker-alt text-primary fs-5 me-3 mt-1"></i>
                                <span>Ipoh • Perak • Malaysia</span>
                            </div>

                            <div class="mt-4 d-flex gap-3 justify-content-center">
                                <a href="https://github.com/umarfikri" 
                                    class="text-primary fs-1"
                                    target="_blank" 
                                    rel="noopener noreferrer">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="https://www.linkedin.com/in/ahmad-umar-fikri/" 
                                    class="text-primary fs-1"
                                    target="_blank" 
                                    rel="noopener noreferrer">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-md-7">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <form action="{{ route('contactStore') }}" method="POST" id="contactForm">
                                @csrf
                                <div class="mb-3 input-group">
                                    <span class="input-group-text bg-primary text-white"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" name="contactName" id="contactName" placeholder="Enter Name" />
                                </div>
                                <div class="mb-3 input-group">
                                    <span class="input-group-text bg-primary text-white"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" name="contactEmail" id="contactEmail" placeholder="Enter Email" />
                                </div>
                                <div class="mb-3 input-group">
                                    <span class="input-group-text bg-primary text-white"><i class="fas fa-phone"></i></span>
                                    <input type="text" class="form-control" name="contactPhone" id="contactPhone" placeholder="Enter Phone Number" />
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" rows="5" name="contactMessage" id="contactMessage" placeholder="Enter Message"></textarea>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary text-white fw-bold">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img
            src="image/Main-Resume/contact-wave.png"
            alt=""
            class="contact-wave position-absolute"
        />
    </section>

    <!-- Footer -->
    <footer class="bg-secondary text-light pb-3 pt-5">
        <div class="container-fluid px-md-5">
            <div class="row text-center text-md-start">            
                <!-- Column 1: About -->
                <div class="col-12 col-md-6 col-lg-4 mb-2 mb-md-0">
                    <h5 class="fw-bold mb-2 fs-4">About</h5>
                    <p>
                    Ahmad Umar Fikri<br>
                    Web Developer<br>
                    Passionate about building responsive and dynamic web applications.
                    </p>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-0">
                    <h5 class="fw-bold mb-2 fs-4">Quick Links</h5>
                    <ul class="list-unstyled">
                    <li class="mb-1"><a href="#" class="text-light text-decoration-none">Home</a></li>
                    <li class="mb-1"><a href="#about" class="text-light text-decoration-none">Profile</a></li>
                    <li class="mb-1"><a href="#skills" class="text-light text-decoration-none">Skills & Expertise</a></li>
                    @if ($project->isNotEmpty())
                    <li class="mb-1"><a href="#project" class="text-light text-decoration-none">Projects</a></li>
                    @endif
                    <li class="mb-1"><a href="#contact" class="text-light text-decoration-none">Contact</a></li>
                    </ul>
                </div>

                <!-- Column 3: Contact & Social -->
                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-0 text-center text-md-start">
                    <h5 class="fw-bold mb-2 fs-4">Contact</h5>

                    <p class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-start">
                        <i class="fas fa-phone me-2 mb-2 mb-md-0"></i>
                        <span class="text-break">(+60) 18 - 959 8505</span>
                    </p>

                    <p class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-start">
                        <i class="fas fa-envelope me-2 mb-2 mb-md-0"></i>
                        <span class="text-break">umarfikri1712@gmail.com</span>
                    </p>

                    <p class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-start">
                        <i class="fas fa-map-marker-alt me-2 mb-2 mb-md-0"></i>
                        Ipoh • Perak • Malaysia
                    </p>

                    <!-- Optional: Social Links -->
                    <!--
                    <div class="mt-3 d-flex justify-content-center justify-content-md-start">
                        <a href="https://github.com/yourusername" class="text-light me-3" target="_blank"><i class="fab fa-github fa-lg"></i></a>
                        <a href="https://linkedin.com/in/yourusername" class="text-light me-3" target="_blank"><i class="fab fa-linkedin fa-lg"></i></a>
                        <a href="mailto:your.email@example.com" class="text-light"><i class="fas fa-envelope fa-lg"></i></a>
                    </div>
                    -->
                </div>

                <!-- Column 4: Social Link -->
                 <div class="col-12 col-md-6 col-lg-2 mb-2 mb-md-0">
                    <h5 class="fw-bold mb-2 fs-4">Social</h5>
                    <div class="mb-4 d-flex flex-row justify-content-center justify-content-md-start">
                        <a href="https://github.com/umarfikri" class="text-decoration-none"
                            target="_blank" 
                            rel="noopener noreferrer">
                            <i class="fab fa-github fa-3x text-light mx-2"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/ahmad-umar-fikri/" class="text-decoration-none"
                            target="_blank" 
                            rel="noopener noreferrer">
                            <i class="fab fa-linkedin fa-3x text-light mx-2"></i>
                        </a>
                        <a href="mailto:umarfikri1712@gmail.com" class="text-decoration-none">
                            <i class="fas fa-envelope fa-3x text-light mx-2"></i>
                        </a>                                               
                    </div>
                 </div>

            </div>
            
        </div>
        <hr class="border-light my-4" />
        <div class="text-center pb-2">
            <p class="mb-0">&copy; 2025 Ahmad Umar Fikri. All Rights Reserved.</p>
        </div>    

    </footer>   

    <!-- JS Link -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>  
    <script src="{{ asset('js/scriptMain.js') }}"></script>

    <!-- Modal For Fullscreen Project -->
    <div class="fullscreen-img-overlay" id="fullscreenOverlay" onclick="closeFullscreenImage()">
        <img id="fullscreenImage" src="" alt="Fullscreen Preview">
    </div>
</body>
</html>