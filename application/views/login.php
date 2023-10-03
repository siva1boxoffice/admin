
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags  -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="robots" content="noindex,nofollow">
    <title> <?php echo $app['app_title'];?> :: Login</title>
    <link rel="icon" type="image/png" href="<?php echo $app['general_path'];?>/<?php echo $app['app_favicon'];?>" />

    <!--Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/app.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
     <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css?v=3.9.8" />
     <link rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.css?v=4" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">

</head>

<body>
    <div id="huro-app" class="app-wrapper">

        <!--Full pageloader-->
        <!-- Pageloader -->
        <div class="pageloader is-full"></div>
        <div class="infraloader is-full is-active"></div>
        <div class="auth-wrapper">
            <!--Page body-->
            <div class="modern-login mob_device">

                <div class="underlay h-hidden-mobile h-hidden-tablet-p"></div>

                <div class="columns is-gapless is-vcentered">
                    <div class="column is-relative is-8">
                        <div class="hero is-fullheight is-image">
                            <div class="hero-body main_logo">
                                <div class="container_new">
                                    <div class="columns">
                                        <div class="column">
                                            <!-- <img class="hero-image" src="<?php echo base_url("");?>/<?php echo $app['general_path'];?>/<?php echo $app['login_image'];?>" alt=""> -->
                                            <img class="hero-image" src="/uploads/general_settings/Logo.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-4 is-relative">
                        <div class="is-form">
                            <div class="hero-body">
                                <div class="form-text">
                                    <h2>Sign In</h2>
                                    <p>Welcome back to <?php echo $app['app_name'];?>.</p>
                                </div>
                                <div class="form-text is-hidden">
                                    <h2>Recover Account</h2>
                                    <p>Reset your account password.</p>
                                </div>
                                <form id="login-form" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>login" method="POST">

                                    <div class="control has-validation">
                                        <input type="email" class="input" name="username" placeholder="Email address" value="<?php if(isset($_COOKIE["username"]) && $_COOKIE["username"]!="") { echo $_COOKIE["username"]; } ?>">
                                        <div class="auth-label">Email Address</div>
                                        <div class="auth-icon">
                                            <i class="lnil lnil-envelope"></i>
                                        </div>
                                    </div>
                                    <div class="control has-validation">
                                        <input type="password" class="input" name="password" value="<?php if(isset($_COOKIE["password"]) && $_COOKIE["password"]!="") { echo $_COOKIE["password"]; } ?>">
                                        <div class="auth-label">Password</div>
                                        <div class="auth-icon">
                                            <i class="lnil lnil-lock-alt"></i>
                                        </div>
                                    </div>

                                    <div class="control is-flex">
                                        <label class="remember-toggle">
                                            <input name="remember_me" type="checkbox" checked="<?php if(isset($_COOKIE["password"]) && $_COOKIE["password"]!="") { echo 'checked'; } ?>" >
                                            <span class="toggler">
                                                    <span class="active">
                                                        <i data-feather="check"></i>
                                                    </span>
                                            <span class="inactive">
                                                        <i data-feather="circle"></i>
                                                    </span>
                                            </span>
                                        </label>
                                        <div class="remember-me">Remember Me</div>
                                        <a id="forgot-link">Forgot Password?</a>
                                    </div>
                                    <div class="button-wrap has-help">
                                        <button id="login-submit" type="submit" class="submit button h-button is-big is-rounded is-primary is-bold is-raised">Login Now</button>
                                    </div>
                                </form>

                                <form id="recover-form" class="validate_form login-wrapper is-hidden" action="<?php echo base_url();?>login/send_password_reset_link">
                                    <p class="recover-text">Enter your email and click on the confirm button to reset your password. We'll send you an email reset link to complete the procedure.</p>
                                    <div class="control has-validation">
                                        <input type="text" name="email_id" class="input" placeholder="Email address">
                                        <div class="auth-label">Email Address</div>
                                        <div class="auth-icon">
                                            <i class="lnil lnil-envelope"></i>
                                        </div>
                                    </div>
                                    <div class="button-wrap">
                                        <button id="cancel-recover" type="button" class="button h-button is-white is-big is-rounded is-lower">Cancel</button>
                                        <button type="submit" class="submit button h-button is-solid is-big is-rounded is-lower is-raised is-colored">Confirm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Huro Scripts-->
        <!-- Concatenated plugins -->
        <script src="<?php echo base_url();?>assets/js/app.js"></script>

        <!-- Huro js -->
        <script src="<?php echo base_url();?>assets/js/functions.js"></script>
        <script src="<?php echo base_url();?>assets/js/auth.js"></script>
         <script src="<?php echo base_url();?>assets/js/components.js" async></script>
         <script src="<?php echo base_url();?>assets/js/validate/jquery.validate.js"></script>
          <script type="text/javascript">
<?php if($flag == 1){?>
var notyf = new Notyf({
            duration: 2e3,
            position: { x: "right", y: "bottom" },
            types: [
                { type: "warning", background: themeColors.warning, icon: { className: "fas fa-hand-paper", tagName: "i", text: "" } },
                { type: "info", background: themeColors.info, icon: { className: "fas fa-info-circle", tagName: "i", text: "" } },
                { type: "primary", background: themeColors.primary, icon: { className: "fas fa-car-crash", tagName: "i", text: "" } },
                { type: "accent", background: themeColors.accent, icon: { className: "fas fa-car-crash", tagName: "i", text: "" } },
                { type: "purple", background: themeColors.purple, icon: { className: "fas fa-check", tagName: "i", text: "" } },
                { type: "blue", background: themeColors.blue, icon: { className: "fas fa-check", tagName: "i", text: "" } },
                { type: "green", background: themeColors.green, icon: { className: "fas fa-check", tagName: "i", text: "" } },
                { type: "orange", background: themeColors.orange, icon: { className: "fas fa-check", tagName: "i", text: "" } },
            ],
        });

notyf.success('You have been successfully logged out.', "Logout", {
timeOut: "1400"
});

<?php } ?>
</script>
    </div>
</body>

</html>