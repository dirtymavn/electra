<!DOCTYPE html><html>
<!-- Mirrored from light.pinsupreme.com/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 May 2018 15:11:12 GMT -->
<head>
    <title>{{ env('APP_NAME', 'Web Admin') }} | @yield('title', 'Admin')</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Electra" name="author">
    <meta content="Auth" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="{{asset('themes/img/favicon.png')}}" rel="shortcut icon"><link href="{{asset('themes/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <!-- <link href="../fast.fonts.net/cssapi/487b73f1-c2d1-43db-8526-db577e4c822b.css" rel="stylesheet" type="text/css"> -->
    {!! Html::style('themes/bower_components/select2/dist/css/select2.min.css') !!}
    {!! Html::style('themes/bower_components/bootstrap-daterangepicker/daterangepicker.css') !!}
    {!! Html::style('themes/bower_components/dropzone/dist/dropzone.css') !!}
    {!! Html::style('themes/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}
    {!! Html::style('themes/bower_components/fullcalendar/dist/fullcalendar.min.css') !!}
    {!! Html::style('themes/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css') !!}
    {!! Html::style('themes/bower_components/slick-carousel/slick/slick.css') !!}
    {!! Html::style('themes/css/maince5a.css?version=4.4.1') !!}
    @yield('style')
</head>

<body class="auth-wrapper">
    <div class="all-wrapper menu-side with-pattern">
        @yield('body')
    </div>
    @yield('script')
</body>
<!-- Mirrored from light.pinsupreme.com/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 May 2018 15:11:13 GMT -->
</html>
