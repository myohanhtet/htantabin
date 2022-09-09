
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>{{ config('app.name') }}</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/pricing/">

    <!-- Bootstrap core CSS -->
    <link href="{!! asset('/css/bootstrap.min.css') !!}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
    crossorigin="anonymous"/>
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <style>
        @font-face {
            font-family: "MyanmarSabae";
            src:  url("/fonts/MyanmarSabae.ttf");
        }
        body {
            font-family: "MyanmarSabae","Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol" !important;
        }
    </style>
<meta name="theme-color" content="#563d7c">

</head>
  <body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">ထန်းတပင်ကျောင်းတိုက်</h5>
  <nav class="my-2 my-md-0 mr-md-3">

    <a class="p-2 {{ request()->routeIs('frontend.index') ? 'btn btn-outline-dark' : 'text-dark'}}" href="{{ route('frontend.index') }}">မူလစာမျက်နှာ</a>

    <a class="p-2 {{ request()->routeIs('frontend.donors') ? 'btn btn-outline-dark' : 'text-dark'}}" href="{{ route('frontend.donors') }}">အလှူရှင်များ</a>

  </nav>
  {{-- <a class="btn btn-outline-primary" href="{{ route('donors') }}">အလှူရှင်များ</a> --}}
</div>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-6" style="line-height: 150%">ရန်ကုန်တိုင်းဒေသကြီး၊ ကမာရွတ်မြို့နယ်၊ ထန်းတပင်ကျောင်းတိုက်</h1>
  <p class="lead">(၁၀၆)ကြိမ်မြောက်၊ ဗုဒ္ဓပူဇနိယပွဲတော်၊ စာရေးတံမဲလောင်းလှူပွဲ</p>
</div>

<div class="container">
  <div class="card-deck mb-3 text-center">

    @yield('content')

  </div>
</div>
</body>
</html>
