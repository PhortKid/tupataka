<!doctype html>
<html lang="en">

<head>






  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png" />
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Smart Waste Collection</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />

  <!-- Canonical SEO -->
  <link rel="canonical" href="#"/>

  
  <!-- Bootstrap core CSS     -->
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />



  <!--  Material Dashboard CSS    -->
  <link href="../../assets/css/material-dashboard98f3.css?v=1.3.0" rel="stylesheet"/>

  <!--  CSS for Demo Purpose, don't include it in your project     -->
  <link href="../../assets/css/demo.css" rel="stylesheet" />


  <!--     Fonts and icons     -->
  <link href="../../../../../maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
          new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      '../../../../../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-NKDMSK6');</script>
  <!-- End Google Tag Manager -->
</head>

<body class="off-canvas-sidebar">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>


<div class="wrapper wrapper-full-page">
  <div class="full-page login-page" filter-color="black" data-image="../../assets/img/login.png">
    <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
            <form method="post" action="/login">
              <div class="card card-login card-hidden">
                <div class="card-header text-center" data-background-color="green">
                  <!-- Logo -->
                  <img src="favicon.png" alt="Logo" style="max-width: 120px; height: auto; display: block; margin: 0 auto 10px; filter: grayscale(100%) brightness(0);">

                  <!-- Title -->
                  <h4 class="card-title">Smart Waste Collection</h4>
              </div>
               
                <div class="card-content">

                @if ($errors->has('email'))
    <div class="alert alert-danger">
        {{ $errors->first('email') }}
    </div>
@endif
                 
                  <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>

                    <div class="form-group label-floating">
                      <label class="control-label">Email address</label>
                      <input type="email" name="email" class="form-control">
                    </div>
                  </div>
                  @csrf

                  <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                    <div class="form-group label-floating">
                      <label class="control-label">Password</label>
                      <input type="password" name="password" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="footer text-center">
                  <button type="submit" class="btn btn-success btn-simple btn-wd btn-lg">Login</button>

                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
 

  </div>

</div>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"966b275769c8dd69","version":"2025.7.0","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"1b7cbb72744b40c580f8633c6b62637e","b":1}' crossorigin="anonymous"></script>
</body>


</body>
    <!--   Core JS Files   -->
<script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/material.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>

<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
{{-- 
<script src="cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js'"></script>--}}

<!-- Library for adding dinamically elements -->
<script src="{{asset('assets/js/arrive.min.js')}}" type="text/javascript"></script>

<!-- Forms Validations Plugin -->
<script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>

<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="{{asset('assets/js/moment.min.js')}}"></script>

<!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
<script src="{{asset('assets/js/chartist.min.js')}}"></script>

<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{asset('assets/js/jquery.bootstrap-wizard.js')}}"></script>

<!--  Notifications Plugin, full documentation here: https://bootstrap-notify.remabledesigns.com/    -->
<script src="{{asset('assets/js/bootstrap-notify.js')}}"></script>

<!--   Sharrre Library    -->
<script src="{{asset('assets/js/jquery.sharrre.js')}}"></script>

<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{asset('assets/js/bootstrap-datetimepicker.js')}}"></script>

<!-- Vector Map plugin, full documentation here: https://jvectormap.com/documentation/ -->
<script src="{{asset('assets/js/jquery-jvectormap.js')}}"></script>

<!-- Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
<script src="{{asset('assets/js/nouislider.min.js')}}"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1_8C5Xz9RpEeJSaJ3E_DeBv8i7j_p6Aw"></script>

<!--  Plugin for Select, full documentation here: https://silviomoreto.github.io/bootstrap-select -->
<script src="{{asset('assets/js/jquery.select-bootstrap.js')}}"></script>

<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="{{asset('assets/js/jquery.datatables.js')}}"></script>

<!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
<script src="{{asset('assets/js/sweetalert2.js')}}"></script>

<!-- Plugin for Fileupload, full documentation here: https://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{asset('assets/js/jasny-bootstrap.min.js')}}"></script>

<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{asset('assets/js/fullcalendar.min.js')}}"></script>

<!-- Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{asset('assets/js/jquery.tagsinput.js')}}"></script>

<!-- Material Dashboard javascript methods -->
<script src="{{asset('assets/js/material-dashboard98f3.js?v=1.3.0')}}"></script>

<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/js/demo.js')}}"></script>


<script type="text/javascript">
    $().ready(function(){
        demo.checkFullPageBackgroundImage();

        setTimeout(function(){
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>






</html>
