
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>Image Quiz Login</title>

        <meta name="description" content="uAdmin is a Professional, Responsive and Flat Admin Template created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <meta name="viewport" content="width=device-width,initial-scale=1">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{asset('uploads/assets')}}/img/favicon.ico">
        <link rel="apple-touch-icon" href="{{asset('uploads/assets')}}/img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="{{asset('uploads/assets')}}/img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="{{asset('uploads/assets')}}/img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="{{asset('uploads/assets')}}/img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="{{asset('uploads/assets')}}/img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="{{asset('uploads/assets')}}/img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="{{asset('uploads/assets')}}/img/icon152.png" sizes="152x152">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="{{asset('uploads/assets')}}/css/bootstrap.css">

        <!-- Related styles of various javascript plugins -->
        <link rel="stylesheet" href="{{asset('uploads/assets')}}/css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="{{asset('uploads/assets')}}/css/main.css">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it, eg IE8) -->
        <script src="{{asset('uploads/assets')}}/js/vendor/modernizr-respond.min.js"></script>
    </head>
    <body class="login">
        <!-- Login Container -->
        <div id="login-container">
            <div style="margin-bottom: 20px">
                <a href="">
                    <img src="{{asset('uploads/assets')}}/img/template/uadmin_logo.png" alt="logo">
                </a>
            </div>

            @if (session('exists'))
                <strong class="text-danger">{{session('exists')}}</strong>
            @endif

            @if (session('wrong'))
                <strong class="text-danger">{{session('wrong')}}</strong>
            @endif
            <!-- Login Form -->
            <form action="{{route('attempt.login')}}" method="POST" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <div class="col-xs-12" style="margin-bottom: 10px">
                        <input type="email" name="email" placeholder="Email.." class="form-control">
                        @error('email')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="col-xs-12" style="margin-bottom: 10px">
                        <input type="password" id="login-password" name="password" placeholder="Password.." class="form-control">
                        @error('password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                </div>
                <div class="clearfix">
                    <div class="btn-group btn-group-sm pull-right">
                        <button type="submit" class="btn btn-success"><i class="fa fa-arrow-right"></i> Login</button>
                    </div>
                </div>
            </form>
            <!-- END Login Form -->
        </div>
        <!-- END Login Container -->

        <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="{{asset('uploads/assets')}}/js/vendor/jquery-1.11.1.min.js"%3E%3C/script%3E'));</script>

        <!-- Bootstrap.js -->
        <script src="{{asset('uploads/assets')}}/js/vendor/bootstrap.min.js"></script>

        <!-- Jquery plugins and custom javascript code -->
        <script src="{{asset('uploads/assets')}}/js/plugins.js"></script>
        <script src="{{asset('uploads/assets')}}/js/main.js"></script>

        <!-- Javascript code only for this page -->
        <script>
            $(function () {
                var loginButtons = $('#login-buttons');
                var loginForm = $('#login-form');

                // Reveal login form
                $('#login-btn-email').click(function () {
                    loginButtons.slideUp(600);
                    loginForm.slideDown(450);
                });

                // Hide login form
                $('.login-back').click(function () {
                    loginForm.slideUp(450);
                    loginButtons.slideDown(600);
                });
            });
        </script>
    </body>
</html>