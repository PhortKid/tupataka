<!doctype html>
<html lang="en" contenteditable="false">

<head>





    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}" />
    <link rel="icon" type="image/png" href="{{asset('favicon.png')}}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Smart Waste Collection</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <!-- Toastr JS -->

 
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap core CSS     -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" /> 


    <!--  Material Dashboard CSS    -->
    <link href="{{asset('assets/css/material-dashboard98f3.css?v=1.3.0')}}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('assets/css/demo.css')}}" rel="stylesheet" />

    
    <!--     Fonts and icons     -->
    <link href="maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      
    <style>
    html, body {
        height: auto !important;
        overflow-y: auto !important;
    }
</style>

</head>


<body >
 

    <div class="wrapper">

        <div class="sidebar" data-active-color="rose" data-background-color="black" data-image="{{asset('assets/img/sidebar-1.jpg')}}">

   <div class="logo">
        
        <a href="#" class="simple-text logo-mini">
            M
           <img src"https://test.mazingiratz.website/favicon.png" />
        </a>

        <a href="#" class="simple-text logo-normal">
             Mazingira 
        </a>
    </div> 

    <div class="sidebar-wrapper" style="background-color:#2E7D32; color:white;">
        <div class="user">
            <div class="photo">
                <img src="{{asset('favicon.png')}}" style="filter: grayscale(100%) brightness(0);" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>
                         {{Auth::user()->firstname }} {{Auth::user()->lastname }} 
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="/profile">
                                <span class="sidebar-mini"> MP </span>
                                <span class="sidebar-normal"> My Profile </span>
                            </a>
                        </li>
                        <li>
                            <a href="/profile">
                                <span class="sidebar-mini"> EP </span>
                                <span class="sidebar-normal"> Edit Profile </span>
                            </a>
                        </li>
                        <li>
                            <a href="/logout">
                                <span class="sidebar-mini"> L </span>
                                <span class="sidebar-normal"> Logout </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
         
        @include('layout.sidebar')



    </div>
</div>


        <div class="main-panel">

            <nav class="navbar navbar-transparent navbar-absolute">
    <div class="container-fluid">
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons visible-on-sidebar-mini">view_list</i>
            </button>
        </div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"> Dashboard </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
               
               
                <li>
                    <a href="/profile" class="dropdown-toggle" data-toggle="dropdown">
                       <i class="material-icons">person</i>
                       <p class="hidden-lg hidden-md">Profile</p>
                    </a>
                </li>

                <li class="separator hidden-lg hidden-md"></li>
            </ul>


            
        </div>
    </div>
</nav>


            

                <div class="content">
                    <div class="container-fluid">

                        <!-- Blank layout: add your content here -->
                        <div class="row">
                           
                            @yield('content')
                        </div>

                    </div>
                </div>

             

            
            <footer class="footer">
    <div class="container-fluid">
        <nav class="pull-left">
            
        </nav>
        <p class="copyright pull-right">
            &copy; <script>document.write(new Date().getFullYear())</script> <a href="#"> QuickSoft </a> 
        </p>
    </div>
</footer>

            
        </div>
    </div>

    {{--
    <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
        </a>
        <ul class="dropdown-menu">
            <li class="header-title"> Sidebar Filters</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger active-color">
                    <div class="badge-colors text-center">
                        <span class="badge filter badge-purple" data-color="purple"></span>
                        <span class="badge filter badge-blue" data-color="blue"></span>
                        <span class="badge filter badge-green" data-color="green"></span>
                        <span class="badge filter badge-orange" data-color="orange"></span>
                        <span class="badge filter badge-red" data-color="red"></span>
                        <span class="badge filter badge-rose active" data-color="rose"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="header-title">Sidebar Background</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="text-center">
                        <span class="badge filter badge-white" data-color="white"></span>
                        <span class="badge filter badge-black active" data-color="black"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>

            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                    <p>Sidebar Mini</p>
                    <div class="togglebutton switch-sidebar-mini">
                        <label>
                            <input type="checkbox" unchecked="">
                        </label>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>

            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                    <p>Sidebar Image</p>
                    <div class="togglebutton switch-sidebar-image">
                        <label>
                            <input type="checkbox" checked="">
                        </label>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>

            <li class="header-title">Images</li>
            <li class="active">
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="{{asset('assets/img/sidebar-1.jpg')}}" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="{{asset('assets/img/sidebar-2.jpg')}}" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="{{asset('assets/img/sidebar-3.jpg')}}" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="{{asset('assets/img/sidebar-4.jpg')}}" alt="" />
                </a>
            </li>

          

           

           
        </ul>
    </div>
</div>--}}


{{--  Core JS Files   
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"966b2719db7fdd69","version":"2025.7.0","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"1b7cbb72744b40c580f8633c6b62637e","b":1}' crossorigin="anonymous"></script>
--}}
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





<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
toastr.options = {
  "closeButton": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "timeOut": "5000"
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




<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });


        var table = $('#datatables').DataTable();

        // Edit record
        table.on( 'click', '.edit', function () {
            $tr = $(this).closest('tr');

            var data = table.row($tr).data();
            alert( 'You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.' );
        } );

        // Delete a record
        table.on( 'click', '.remove', function (e) {
            $tr = $(this).closest('tr');
            table.row($tr).remove().draw();
            e.preventDefault();
        } );

        //Like record
        table.on( 'click', '.like', function () {
            alert('You clicked on Like button');
        });

        $('.card .material-datatables label').addClass('form-group');
    });

</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: '{{ session('error') }}',
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif



</html>
