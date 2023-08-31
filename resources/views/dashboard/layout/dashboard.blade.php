<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title> Exam</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/font-awesome.css') }}" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/bootstrap-duallistbox.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/bootstrap-multiselect.css')}}"/>
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/jquery-ui.custom.css')}}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/chosen.css')}}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/datepicker.css')}}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/bootstrap-timepicker.css')}}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/daterangepicker.css')}}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/bootstrap-datetimepicker.css')}}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/colorpicker.css')}}" />

    <!-- text fonts -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/ace-fonts.css') }}" />

    <!-- ace styles -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/ace.css') }}" class="ace-main-stylesheet"
        id="main-ace-style" />

    <!--[if lte IE 9]>
   <link rel="stylesheet" href="\{\{ asset('dashboard/assets/css/ace-part2.css')}}" class="ace-main-stylesheet" />
  <![endif]-->

    <!--[if lte IE 9]>
  <link rel="stylesheet" href="{\{ asset('dashboard/assets/css/ace-ie.css')}}" />
  <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="{{ asset('dashboard/assets/js/ace-extra.js') }}"></script>
    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
  <script src="{\{ asset('dashboard/assets/js/html5shiv.js')}}"></script>
  <script src="{\{ asset('dashboard/assets/js/respond.js')}}"></script>
  <![endif]-->
</head>

<body class="no-skin">
    <!-- #section:basics/navbar.layout -->
    <div id="navbar" class="navbar navbar-default">
        <script type="text/javascript">
            try {
                ace.settings.check('navbar', 'fixed')
            } catch (e) {}
        </script>

        <div class="navbar-container" id="navbar-container">
            <!-- #section:basics/sidebar.mobile.toggle -->
            @include('dashboard.layout.include.navbar')
        </div><!-- /.navbar-container -->
    </div>

    <!-- /section:basics/navbar.layout -->
    <div class="main-container" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.check('main-container', 'fixed')
            } catch (e) {}
        </script>

        <!-- #section:basics/sidebar -->
        <div id="sidebar" class="sidebar                  responsive">
            @include('dashboard.layout.include.sidbar');


        </div>

        <!-- /section:basics/sidebar -->
        <div class="main-content">
            <div class="main-content-inner">
                <!-- #section:basics/content.breadcrumbs -->
                <div class="breadcrumbs" id="breadcrumbs">
                    <script type="text/javascript">
                        try {
                            ace.settings.check('breadcrumbs', 'fixed')
                        } catch (e) {}
                    </script>

                    <ul class="breadcrumb">
                        <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a href="{{ route('dash.index') }}">Home</a>
                        </li>
                        <li class="active">Dashboard</li>
                    </ul><!-- /.breadcrumb -->

                    <!-- #section:basics/content.searchbox -->
                    <div class="nav-search" id="nav-search">
                        <form class="form-search">
                            <span class="input-icon">
                                <input type="text" placeholder="Search ..." class="nav-search-input"
                                    id="nav-search-input" autocomplete="off" />
                                <i class="ace-icon fa fa-search nav-search-icon"></i>
                            </span>
                        </form>


                    </div><!-- /.nav-search -->

                    <!-- /section:basics/content.searchbox -->
                </div>

                <!-- /section:basics/content.breadcrumbs -->
                <div class="page-content">
                    {{-- @if ($module_name != 'dash') --}}
                        <div class="widget-box">

                            <!-- /section:settings.box -->

                            <div class="widget-header">
                                <div class="widget-header widget-header-large">


                                    <h2 style="margin:0" class="widget-title">


                                    </h2>



                                    <div class="widget-toolbar">

                                        <div class="d-none d-md-block">

                                    </div>


                                </div>

                            </div>


                            <div class="widget-body">

                                <div class="widget-main">
                                    @if ($message = \Session::get('success'))
                                        <div class="alert alert-success">
                                            {{ $message }}
                                        </div>
                                    @endif
                                    @if ($message = \Session::get('error'))
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @endif


                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    {{-- @endif --}}
                </div>
            </div><!-- /.page-content -->


        </div><!-- /.main-content -->




    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='{{ asset('dashboard/assets/js/jquery.js') }}'>" + "<" + "/script>");
    </script>

    <!-- <![endif]-->

    <!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='{/{ asset('dashboard/assets/js/jquery1x.js')}}>" + "<" + "/script>");
</script>
<![endif]-->
<script type="text/javascript">
    if ('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
</script>

    <script src="{{ asset('dashboard/assets/js/bootstrap.js') }}"></script>

    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
  <script src="{\{ asset('dashboard/assets/js/excanvas.js')}}"></script>
  <![endif]-->

    <script src="{{ asset('dashboard/assets/js/jquery-ui.custom.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/jquery.ui.touch-punch.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/jquery.easypiechart.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/jquery.sparkline.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/markdown/markdown.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/markdown/bootstrap-markdown.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/jquery.hotkeys.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/bootstrap-wysiwyg.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/bootbox.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/chosen.jquery.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/jquery.autosize.js') }}"></script>

    <!-- ace scripts -->
    <script src="{{ asset('dashboard/assets/js/ace/elements.scroller.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/elements.colorpicker.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/elements.fileinput.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/elements.typeahead.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/elements.wysiwyg.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/elements.spinner.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/elements.treeview.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/elements.wizard.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/elements.aside.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/ace.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/ace.ajax-content.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/ace.touch-drag.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/ace.sidebar.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/ace.sidebar-scroll-1.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/ace.submenu-hover.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/ace.widget-box.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/ace.settings.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/ace.settings-rtl.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/ace.settings-skin.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/ace.widget-on-reload.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/ace.searchbox-autocomplete.js') }}"></script>


    <script src="{{ asset('dashboard/assets/js/dataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/dataTables/jquery.dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js') }}"></script>
    @stack('js')
    <!-- the following scripts are used in demo only for onpage help and you don't need them -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/ace.onpage-help.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/docs/js/themes/sunburst.css') }}" />

    <script type="text/javascript">
        ace.vars['base'] = '..';
    </script>
    <script src="{{ asset('dashboard/assets/js/ace/elements.onpage-help.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/ace/ace.onpage-help.js') }}"></script>
    <script src="{{ asset('dashboard/assets/docs/js/rainbow.js') }}"></script>
    <script src="{{ asset('dashboard/assets/docs/js/language/generic.js') }}"></script>
    <script src="{{ asset('dashboard/assets/docs/js/language/html.js') }}"></script>
    <script src="{{ asset('dashboard/assets/docs/js/language/css.js') }}"></script>
    <script src="{{ asset('dashboard/assets/docs/js/language/javascript.js') }}"></script>

    <script src="{{ asset('dashboard/assets/js/my-js.js') }}"></script>




</body>

</html>
