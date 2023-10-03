<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="LetStart Admin is a full featured, multipurpose, premium bootstrap admin template built with Bootstrap 4 Framework, HTML5, CSS and JQuery.">
    <meta name="keywords"
        content="admin, panels, dashboard, admin panel, multipurpose, bootstrap, bootstrap4, all type of dashboards">
    <meta name="author" content="MatrrDigital">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>
        <?php echo $app['app_title']; ?> :: Login
    </title>
    <link rel="shortcut icon" href="<?php echo $app['general_path']; ?>/<?php echo $app['app_favicon']; ?>"
        type="image/x-icon" />

    <!-- ================== BEGIN PAGE LEVEL CSS START ================== -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/zenith_assets/css/icons.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/zenith_assets/libs/wave-effect/css/waves.min.css" />
    <!-- ================== BEGIN PAGE LEVEL END ================== -->
    <!-- ================== Plugins CSS  ================== -->
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>assets/zenith_assets/libs/owl-carousel/css/owl.carousel.min.css" />
    <!-- ================== Plugins CSS end ================== -->
    <!-- ================== BEGIN APP CSS  ================== -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/zenith_assets/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/zenith_assets/css/styles.css" />
    <!-- ================== END APP CSS ================== -->

    <!-- ================== BEGIN POLYFILLS  ================== -->
    <!--[if lt IE 9]>
     <script src="assets/libs/html5shiv/js/html5shiv.js"></script>
     <script src="assets/libs/respondjs/js/respond.min.js"></script>
  <![endif]-->
    <!-- ================== END POLYFILLS  ================== -->
</head>

<body>
    <!-- Begin Page -->
    <div class="auth-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-11">
                    <div class="row justify-content-center">
                        <div class="col-md-6 pr-md-0">
                            <div class="auth-page-sidebar rounded-0">
                                <img src="<?php echo base_url(); ?>assets/zenith_assets/img/logo_login.png"
                                    alt="Lettstart Admin">
                            </div>
                        </div>
                        <div class="col-md-6 pl-md-0">
                            <div class="card mb-0 p-2 p-md-3 rounded-0">
                                <div class="card-body">
                                    <div class="clearfix">
                                    </div>
                                    <h5 class="mt-4 font-weight-600">Welcome back!</h5>
                                    <p class="text-muted mb-4">Enter your email address and password to access admin
                                        panel.</p>
                                    <!-- <form id="login-form" name="login-form" novalidate> -->
                                    <form id="login-form" name="login-form" novalidate
                                        class="validate_form_v1 login-wrapper" action="<?php echo base_url(); ?>login"
                                        method="POST">

                                        <div class="control has-validation form-group floating-label label_popup ">
                                            <input type="email" class=" input form-control" name="username"
                                                id="username"
                                                value="<?php if (isset($_COOKIE["username"]) && $_COOKIE["username"] != "") {
                                                    echo $_COOKIE["username"];
                                                } ?>" />
                                            <label for="email">Email Address</label>
                                            <div class="validation-error d-none font-size-13">
                                                <p>Email must be a valid email address</p>
                                            </div>
                                        </div>

                                        <div class="control has-validation form-group floating-label label_popup ">
                                            <input type="password" class="input form-control" name="password"
                                                id="password"
                                                value="<?php if (isset($_COOKIE["password"]) && $_COOKIE["password"] != "") {
                                                    echo $_COOKIE["password"];
                                                } ?>" />
                                            <label for="password">Password</label>
                                            <div class="validation-error d-none font-size-13">
                                                <p>This field is required</p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input name="remember_me" type="checkbox" class="custom-control-input"
                                                    id="checkbox-signin"
                                                    checked="<?php if (isset($_COOKIE["password"]) && $_COOKIE["password"] != "") {
                                                        echo 'checked';
                                                    } ?>">
                                                <label class="custom-control-label" for="checkbox-signin">Remember
                                                    me</label>
                                            </div>
                                        </div>

                                        <div class="form-group text-center">
                                            <button class="btn btn-primary btn-block" data-effect="wave" type="submit">
                                                Log In
                                            </button>
                                        </div>
                                        <!-- <div class="clearfix text-center">
                                            <a href="#" class="text-primary">Forgot your password?</a>
                                        </div> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- Page End -->
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?php echo base_url(); ?>assets/zenith_assets/js/vendor.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script> sessionStorage.clear(); </script>
    <!-- ================== END BASE JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="<?php echo base_url(); ?>assets/zenith_assets/js/utils/colors.js"></script>
    <script src="<?php echo base_url(); ?>assets/zenith_assets/libs/owl-carousel/js/owl.carousel.min.js"></script>
    <script
        src="<?php echo base_url(); ?>assets/zenith_assets/libs/jquery-validation/js/jquery.validate.min.js"></script>
    <script
        src="<?php echo base_url(); ?>assets/zenith_assets/libs/jquery-validation/js/additional-methods.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <!-- ================== BEGIN PAGE JS ================== -->
    <script src="<?php echo base_url(); ?>assets/zenith_assets/js/app.js"></script>


    <!-- ================== END PAGE JS ================== -->
    <script>
        //Initialize form
        $('#login-form').validate({

            focusInvalid: false,
            rules: {
                'username': {
                    required: true,
                    email: true
                },
                'password': {
                    required: true,
                }
            },
            errorPlacement: function errorPlacement(error, element) {
                $(element).siblings(".validation-error").removeClass("d-none")
                return true
            },
            highlight: function (element) {
                var $el = $(element);
                var $parent = $el.parents('.form-group');
                $parent.addClass("invalid-field")
            },
            unhighlight: function (element) {
                var $el = $(element);
                var $parent = $el.parents('.form-group');
                $parent.removeClass("invalid-field");
                $(element).siblings(".validation-error").addClass("d-none")
            },
            submitHandler: function (form) {
                var formdata = $(form).serializeArray();
                var data = {};
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });

                var action_url = "<?php echo base_url(); ?>login";
                $.ajax({
                    url: action_url,
                    type: 'POST',
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        // Handle success response here
                        window.location.href = response.redirect_url;
                        // response.redirect_url
                    },
                    error: function () {
                        $(form)[0].reset();
                        return false;
                    }
                });
                // prevent default form submit


                //alert('test');
                // console.log(formdata);
                //  alert("Data has been submitted. Please see console log");
                //  console.log("form data ===>", data);
                $(form)[0].reset();
                // $(".floating-label").removeClass("enable-floating-label");
            }
        });
    </script>

    <script type="text/javascript">

    </script>
</body>

</html>