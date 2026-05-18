<!--
=========================================================
* Material Dashboard 2 PRO - v3.1.0
=========================================================

* Product Page:  https://www.creative-tim.com/product/material-dashboard-pro 
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicon.png">
    <link rel="icon" type="image/png" href="/favicon.png">
    <title>
        Mazingira
    </title>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <!-- Material Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="/assets/css/material-dashboard.mine63c.css?v=3.1.0" rel="stylesheet" />
    
        <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- Anti-flicker snippet (recommended)  -->
    <style>
    .async-hide {
        opacity: 0 !important
    }


      /* Toastr overrides for Bootstrap 5 */
#toast-container .toast {
    background-color: #343a40 !important; /* dark background */
    color: #fff !important;               /* white text */
    font-weight: 500;
}

#toast-container .toast-success {
    background-color: #28a745 !important; /* green for success */
    color: #fff !important;
}

#toast-container .toast-error {
    background-color: #dc3545 !important; /* red for error */
    color: #fff !important;
}

#toast-container .toast-info {
    background-color: #17a2b8 !important; /* blue for info */
    color: #fff !important;
}

#toast-container .toast-warning {
    background-color: #ffc107 !important; /* yellow for warning */
    color: #212529 !important; /* dark text for warning */
}

/* Improve form-control look */
.form-control {
    border-radius: 10px;
    padding: 10px 14px;
    border: 1px solid #ced4da;
    transition: 0.3s ease-in-out;
}

/* On focus */
.form-control:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.15rem rgba(25,135,84,0.25);
}

/* Input group addon modern */
.input-group-text {
    border-radius: 10px;
    background: #f8f9fa;
    border: 1px solid #ced4da;
}

/* Button in input-group */
.input-group .btn {
    border-radius: 10px;
}


    </style>




</head>

<body class="">
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Google Tag Manager (noscript) -->

    <!-- End Google Tag Manager (noscript) -->

    <main class="main-content  mt-0" >
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column" data-aos="fade-right" data-aos-duration="3000">
                            <div class="position-relative h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                                style="background-image: url('/3776063.jpg'); background-size: cover;">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5" data-aos="zoom-in" >
                            <div class="card card-plain">
                                <div class="card-header text-center">
                                    <img src="favicon.png" alt="Logo" style="max-width: 120px; height: auto; display: block; margin: 0 auto 10px;" class="animate__animated animate__bounce">
                                    <h4 class="font-weight-bolder">Sign In</h4>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                </div>
                                <div class="card-body mt-2">
                                    <form method="post" action="/login">
                                        <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                        <label for="email">Email</label>
                                        </div>

                                   <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    <label for="password">Password</label>
                                    </div>

                                        @csrf
                                        <div class="form-check form-switch d-flex align-items-center mb-3">
                                            <input class="form-check-input" type="checkbox" id="rememberMe">
                                            <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember
                                                me</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Sign
                                                in</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                   <p>Mazingiratz V2.0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
        <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
        
            <script>
      AOS.init();
    </script>
    <!--   Core JS Files   -->
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
toastr.options = {
  "closeButton": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "timeOut": "5000",
  "preventDuplicates": true,
  "newestOnTop": true,
  "showDuration": "300",
  "hideDuration": "1000",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};
</script>


<script>
$(document).ready(function() {
    // Success message
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif


    // Error message
    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    // Validation errors
    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
});
</script>


    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>