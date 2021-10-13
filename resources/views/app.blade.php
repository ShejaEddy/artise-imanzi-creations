<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artise-Imanzi Creations</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#FBAD02">

    <!-- /snippets/social-meta-tags.liquid -->
    <meta property="og:site_name" content="imanzi creations">
    <meta property="og:url" content="index.html">
    <meta property="og:title" content="imanzi creations">
    <meta property="og:type" content="website">
    <meta property="og:description" content="imanzi creations">

    <meta name="twitter:site" content="@">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="imanzi creations">
    <meta name="twitter:description" content="imanzi creations">
    <meta property="og:image" content="{{ asset('assets') }}/images/logo/artise-logo.png" />
    <meta property=" og:image:secure_url" content="{{ asset('assets') }}/images/logo/artise-logo.png" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="628" />

    <!--FOR DASHBOARD PAGES-->
    <!-- <link href="{{ asset('assets') }}/css/styles.css" rel="stylesheet" /> -->
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous">
    </script>
    <!--FOR DASHBOARD PAGES--END-->



    <!--FOR MARKET PAGES-->
    {{-- <link href="{{asset('assets')}}/css/checkout.min.css" rel="stylesheet" crossorigin="anonymous" /> --}}
    <link href="{{ asset('assets') }}/css/vela-fonts.css" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('assets') }}/css/plugin.css" rel="stylesheet" type="text/css" media="all" />
    <!-- <link href="{{ asset('assets') }}/css/vela-site.css" rel="stylesheet" type="text/css" media="all" /> -->
    <link href="https://monorail-edge.shopifysvc.com/" rel="dns-prefetch">
    <link rel="canonical" href="index.html">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/favicon.ico" type="image/png">

    <!--FOR MARKET PAGES--END-->

    <style>
        a {
            text-decoration: none !important;
        }
    </style>
</head>

<body>

    <script>
        function loadMyScripts() {

            let pathname = window.location.pathname;
            let splitPath = pathname.split('/')[1];
            if (splitPath == 'artist' || splitPath == 'buyer' || splitPath == 'admin') {
                let link = document.createElement('link');
                link.rel = "stylesheet";
                link.href = "{{ asset('assets') }}/css/styles.css"
                document.head.appendChild(link);

            } else {

                let link = document.createElement('link');
                link.rel = "stylesheet";
                link.href = "{{ asset('assets') }}/css/vela-site.css";
                link.type = "text/css";
                link.media = "all";
                document.head.appendChild(link);
            }
        }
        loadMyScripts();
    </script>

    <div id="app">

    </div>


    <!--FOR DASHBOARD PAGES-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets') }}/js/scripts.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
    <!-- <script src="{{ asset('assets') }}/js/chart-area-demo.js"></script>
   <script src="{{ asset('assets') }}/js/chart-bar-demo.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
   <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script> -->
    <!-- <script src="{{ asset('assets') }}/js/datatables-demo.js"></script> -->
    <!--FOR DASHBOARD PAGES--END -->

    <!--FOR MARKET PAGES-->
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets') }}/js/theme_support/option-selection.js" type="text/javascript"></script>
    <script src="{{ asset('assets') }}/js/theme_support/jquery.js" type="text/javascript"></script>
    <script src="{{ asset('assets') }}/js/vendor.js" type="text/javascript"></script>
    {{-- <script src="{{ asset('assets') }}/js/vela-ajaxcart.js" type="text/javascript"></script> --}}
    <script src="{{ asset('assets') }}/js/lazysizes.min.js" async="async"></script>
    <script src="{{ asset('assets') }}/js/vela.js" type="text/javascript"></script>
    <script src="{{ asset('assets') }}/js/jquery-cookie.js" type="text/javascript"></script>
    <!--FOR MARKET PAGES--END-->

</body>

</html>
