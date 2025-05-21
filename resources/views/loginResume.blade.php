<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Link -->
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="icon" href="{{ asset('image/Main-Resume/title-icon.png') }}">
    <title>Login | Resume</title>
</head>
<body>    
    <!-- Header -->
    <header class="login text-center position-relative">
        <div class="text-container position-relative d-flex flex-column justify-content-center align-items-center h-100">   
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
                @endif           
            <div class="card login-card rounded-4">                            
                <div class="card-body p-4">
                    <h3 class="text-primary fw-bold">Welcome Back</h3>
                    <hr class="text-secondary w-25 mx-auto mb-3" />    
                    <form action="{{ url('/login') }}" method="POST">                        
                        @csrf
                        <div class="mb-2">
                            <label for="username" class="form-label text-secondary fs-5">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Your username" spellcheck="false" required>
                        </div>

                        <div class="mb-2">
                            <label for="password" class="form-label text-secondary fs-5">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="**********" spellcheck="false" required>
                        </div>                        

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary rounded-4 fw-semibold text-light">Login</button>
                        </div>     
                        <div class="d-grid mt-2">
                            <a href="/" type="button" class="btn btn-dark rounded-4 fw-semibold text-light">Website</a>
                        </div>                      
                    </form>                    
                </div>
            </div>
        </div>        
    </header>    

    <!-- JS Link -->
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>  
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- <script src="{{ asset('js/script.js') }}"></script>    --> <!-- Not use JS-->
</body>
</html>