<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.6/dist/css/autoComplete.min.css"> -->
    @yield('third_party_stylesheets')
    @stack('page_css')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-language"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ url('lang/mm') }}"><img src="{{ asset('images/mm.png') }}" width="20" alt="MM"> ဗမာ</a>
                    <a class="dropdown-item" href="{{ url('lang/en') }}"><img src="{{ asset('images/en.png') }}" width="20" alt="MM"> En</a>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <div class="theme-switch-wrapper nav-link">
                    <label class="theme-switch" for="checkbox">
                        <input type="checkbox" id="checkbox" />
                        <span class="slider round"></span>
                    </label>
                </div>
            </li>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset('images/default_profile.png') }}"
                         class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="{{ asset('images/default_profile.png') }}"
                             class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="{{ route('users.show', auth()->id()) }}" class="btn btn-default btn-flat">Profile</a>
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.5
        </div>
        <strong>Copyright &copy; 2018-2020 <a href="https://myohanhtet.com">Htantabin.com</a>.</strong> All rights
        reserved.
    </footer>
</div>

@yield('third_party_scripts')


<script src="{{ mix('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.6/dist/autoComplete.min.js"></script>

<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
@stack('page_scripts')
@if($errors->any())
    <script>
    @foreach ($errors->all() as $error)
            toastr.error("{{$error}}", 'Error!');
    @endforeach
    </script>
@endif
<script>
    @if(Session::has('success'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true,
            "positionClass": "toast-top-right"
        }
    toastr.success("{{ session('success') }}");
    {{ Session::forget('success')}}
    @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.error("{{ session('error') }}");
    {{Session::forget('error')}}
    @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }

    toastr.info("{{ session('info') }}");
    {{Session::forget('info')}}
    @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.warning("{{ session('warning') }}");
    {{Session::forget('warning')}}
    @endif
    // $('ul').Treeview(options)
    var toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
    var currentTheme = localStorage.getItem('theme');
    var mainHeader = document.querySelector('.main-header');

    if (currentTheme) {
        if (currentTheme === 'dark') {
            if (!document.body.classList.contains('dark-mode')) {
                document.body.classList.add("dark-mode");
            }
            if (mainHeader.classList.contains('navbar-light')) {
                mainHeader.classList.add('navbar-dark');
                mainHeader.classList.remove('navbar-light');
            }
            toggleSwitch.checked = true;
        }
    }

    function switchTheme(e) {
        if (e.target.checked) {
            if (!document.body.classList.contains('dark-mode')) {
                document.body.classList.add("dark-mode");
            }
            if (mainHeader.classList.contains('navbar-light')) {
                mainHeader.classList.add('navbar-dark');
                mainHeader.classList.remove('navbar-light');
            }
            localStorage.setItem('theme', 'dark');
        } else {
            if (document.body.classList.contains('dark-mode')) {
                document.body.classList.remove("dark-mode");
            }
            if (mainHeader.classList.contains('navbar-dark')) {
                mainHeader.classList.add('navbar-light');
                mainHeader.classList.remove('navbar-dark');
            }
            localStorage.setItem('theme', 'light');
        }
    }

    toggleSwitch.addEventListener('change', switchTheme, false);
</script>

</body>
</html>
