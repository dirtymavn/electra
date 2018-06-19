<!DOCTYPE html><html>
<!-- Mirrored from light.pinsupreme.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 May 2018 15:08:06 GMT -->
<head>
    <title>{{ env('APP_NAME', 'Web Admin') }} | @yield('title', 'Admin')</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Electra" name="author">
    <meta content="Admin" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('themes/img/favicon.png')}}" rel="shortcut icon"><link href="{{asset('themes/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <!-- <link href="../fast.fonts.net/cssapi/487b73f1-c2d1-43db-8526-db577e4c822b.css" rel="stylesheet" type="text/css"> -->
    {!! Html::style('themes/bower_components/select2/dist/css/select2.min.css') !!}
    {!! Html::style('themes/bower_components/bootstrap-daterangepicker/daterangepicker.css') !!}
    {!! Html::style('themes/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}
    {!! Html::style('themes/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css') !!}
    {!! Html::style('themes/bower_components/slick-carousel/slick/slick.css') !!}
    {!! Html::style('themes/css/maince5a.css?version=4.4.1') !!}
    {!! Html::style('themes/icon_fonts_assets/font-awesome/css/font-awesome.min.css') !!}
    <!-- {!! Html::style('themes/css/main_custom.css') !!} -->
    {!! Html::style('css/custom.css') !!}
    <style>
        body {
            height: 100% !important;
        }
    </style>
    @yield('style')
</head>

<body class="menu-position-side menu-side-left full-screen">
<div class="spinner">
  <div class="rect1"></div>
  <div class="rect2"></div>
  <div class="rect3"></div>
  <div class="rect4"></div>
  <div class="rect5"></div>
</div>
    <div class="all-wrapper solid-bg-all">
        <div class="search-with-suggestions-w" style="display:none;">
            <div class="search-with-suggestions-modal">
                <div class="element-search">
                    <input class="search-suggest-input" placeholder="Start typing to search..." type="text">
                    <div class="close-search-suggestions"><i class="os-icon os-icon-x"></i></div>
                    </input>
                </div>
                <div class="search-suggestions-group">
                    <div class="ssg-header">
                        <div class="ssg-icon">
                            <div class="os-icon os-icon-box"></div>
                        </div>
                        <div class="ssg-name">Projects</div>
                        <div class="ssg-info">24 Total</div>
                    </div>
                    <div class="ssg-content">
                        <div class="ssg-items ssg-items-boxed">
                            <a class="ssg-item" href="users_profile_big.html">
                                <div class="item-media" style="background-image: url(themes/img/company6.png)"></div>
                                <div class="item-name">Integ<span>ration</span> with API</div>
                            </a>
                            <a class="ssg-item" href="users_profile_big.html">
                                <div class="item-media" style="background-image: url(themes/img/company7.png)"></div>
                                <div class="item-name">Deve<span>lopm</span>ent Project</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="search-suggestions-group">
                    <div class="ssg-header">
                        <div class="ssg-icon">
                            <div class="os-icon os-icon-users"></div>
                        </div>
                        <div class="ssg-name">Customers</div>
                        <div class="ssg-info">12 Total</div>
                    </div>
                    <div class="ssg-content">
                        <div class="ssg-items ssg-items-list">
                            <a class="ssg-item" href="users_profile_big.html">
                                <div class="item-media" style="background-image: url(themes/img/avatar1.jpg)"></div>
                                <div class="item-name">John Ma<span>yer</span>s</div>
                            </a>
                            <a class="ssg-item" href="users_profile_big.html">
                                <div class="item-media" style="background-image: url(themes/img/avatar2.jpg)"></div>
                                <div class="item-name">Th<span>omas</span> Mullier</div>
                            </a>
                            <a class="ssg-item" href="users_profile_big.html">
                                <div class="item-media" style="background-image: url(themes/img/avatar3.jpg)"></div>
                                <div class="item-name">Kim C<span>olli</span>ns</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="search-suggestions-group">
                    <div class="ssg-header">
                        <div class="ssg-icon">
                            <div class="os-icon os-icon-folder"></div>
                        </div>
                        <div class="ssg-name">Files</div>
                        <div class="ssg-info">17 Total</div>
                    </div>
                    <div class="ssg-content">
                        <div class="ssg-items ssg-items-blocks">
                            <a class="ssg-item" href="#">
                                <div class="item-icon"><i class="os-icon os-icon-file-text"></i></div>
                                <div class="item-name">Work<span>Not</span>e.txt</div>
                            </a>
                            <a class="ssg-item" href="#">
                                <div class="item-icon"><i class="os-icon os-icon-film"></i></div>
                                <div class="item-name">V<span>ideo</span>.avi</div>
                            </a>
                            <a class="ssg-item" href="#">
                                <div class="item-icon"><i class="os-icon os-icon-database"></i></div>
                                <div class="item-name">User<span>Tabl</span>e.sql</div>
                            </a>
                            <a class="ssg-item" href="#">
                                <div class="item-icon"><i class="os-icon os-icon-image"></i></div>
                                <div class="item-name">wed<span>din</span>g.jpg</div>
                            </a>
                        </div>
                        <div class="ssg-nothing-found">
                            <div class="icon-w"><i class="os-icon os-icon-eye-off"></i></div><span>No files were found. Try changing your query...</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layout-w">

            @include('partials.sidebar')

            <div class="content-w">
                
                @include('partials.header')

                @yield('breadcrumb')
                <div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span></div>
                <div class="content-i">
                    <div class="content-box">
                        <div class="element-wrapper">
                            <h6 class="element-header">@yield('page_title')</h6>
                            <div class="element-box">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="display-type"></div>
    </div>
    {!! Html::script('themes/bower_components/jquery/dist/jquery.min.js') !!}
    {!! Html::script('themes/bower_components/popper.js/dist/umd/popper.min.js') !!}
    {!! Html::script('themes/bower_components/moment/moment.js') !!}
    {!! Html::script('themes/bower_components/chart.js/dist/Chart.min.js') !!}
    {!! Html::script('themes/bower_components/select2/dist/js/select2.full.min.js') !!}
    {!! Html::script('themes/bower_components/ckeditor/ckeditor.js') !!}
    {!! Html::script('themes/bower_components/bootstrap-validator/dist/validator.min.js') !!}
    {!! Html::script('themes/bower_components/bootstrap-daterangepicker/daterangepicker.js') !!}
    {!! Html::script('themes/bower_components/editable-table/mindmup-editabletable.js') !!}
    {!! Html::script('themes/bower_components/datatables.net/js/jquery.dataTables.min.js') !!}
    {!! Html::script('themes/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}
    {!! Html::script('themes/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') !!}
    {!! Html::script('themes/bower_components/slick-carousel/slick/slick.min.js') !!}
    {!! Html::script('themes/bower_components/bootstrap/js/dist/util.js') !!}
    {!! Html::script('themes/bower_components/bootstrap/js/dist/alert.js') !!}
    {!! Html::script('themes/bower_components/bootstrap/js/dist/button.js') !!}
    {!! Html::script('themes/bower_components/bootstrap/js/dist/carousel.js') !!}
    {!! Html::script('themes/bower_components/bootstrap/js/dist/collapse.js') !!}
    {!! Html::script('themes/bower_components/bootstrap/js/dist/dropdown.js') !!}
    {!! Html::script('themes/bower_components/bootstrap/js/dist/modal.js') !!}
    {!! Html::script('themes/bower_components/bootstrap/js/dist/tab.js') !!}
    {!! Html::script('themes/bower_components/bootstrap/js/dist/tooltip.js') !!}
    {!! Html::script('themes/bower_components/bootstrap/js/dist/popover.js') !!}
    {!! Html::script('themes/js/dataTables.bootstrap4.min.js') !!}
    {!! Html::script('themes/js/demo_customizerce5a.js?version=4.4.1') !!}
    {!! Html::script('themes/js/maince5a.js?version=4.4.1') !!}
    <!-- {!! Html::script('themes/js/main_custom.js') !!} -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // (function(i, s, o, g, r, a, m) {
        //     i['GoogleAnalyticsObject'] = r;
        //     i[r] = i[r] || function() {
        //         (i[r].q = i[r].q || []).push(arguments)
        //     }, i[r].l = 1 * new Date();
        //     a = s.createElement(o),
        //         m = s.getElementsByTagName(o)[0];
        //     a.async = 1;
        //     a.src = g;
        //     m.parentNode.insertBefore(a, m)
        // })(window, document, 'script', '../www.google-analytics.com/analytics.js', 'ga');

        // ga('create', 'UA-42863888-9', 'auto');
        // ga('send', 'pageview');
        function initSelect2(element, placeholder) {
            element.select2({
                placeholder: placeholder,
                allowClear: true
            }); 
        }

        function spinnerLoad(element) {
            element.submit(function() {
                if (element.find('.has-error').length <= 0) {
                    element.find('.has-errors').removeClass('has-errors');
                    $('div.spinner').show(); 
                    return true;
                }
                
                element.find('.has-error').each(function(i, obj) {
                    var idTab = $('.tab-pane .form-group.has-error').eq(i).parent().parent().parent().parent().parent().attr('id');
                    if (idTab !== undefined) {
                        var thisNavItem = $('.os-tabs-controls .nav-item a.nav-link');
                        if (thisNavItem.attr('href') == '#'+idTab) {
                            $("a[href*='#"+idTab+"']").addClass('has-errors');
                        }
                    }
                });

                return false;
            });
        }

        $('.only_number').keypress(function (event) {
            var charCode = event.which;
            var value = $(this).val();
            var dotcontains = value.indexOf(".") != -1;
            if (dotcontains)
                if (charCode == 46) return false;
            if (charCode == 46) return true;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        });
        function bulkDelete(url, ids) {
            $('#bulk-delete-modal').modal('show');
            $('#bulk-delete-id').val(ids.join());
            $('#form-bulk-delete').attr('action', url);
        }

        $('.only_numeric').keypress(function (event) {
            var iKeyCode = (event.which) ? event.which : event.keyCode;
            if (iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
                return false;

            return true;
        });

        function initDatatable(element, url, columnss, datas = null) {
            element.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: url,
                    method: 'POST',
                    data: datas
                },
                columns: columnss,
                paging:   false,
                ordering: false,
                info:     false,
                searching:     false
            });

        }
    </script>
    @yield('script')
    @yield('part_script')
</body>
</html>
