<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Dashboard - Bootstrap Admin</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">    

        <link href="../assets/admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/admin/css/bootstrap-responsive.min.css" rel="stylesheet">

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

        <link href="../assets/admin/css/adminia.css" rel="stylesheet"> 
        <link href="../assets/admin/css/adminia-responsive.css" rel="stylesheet"> 

        <link href="../assets/admin/css/login.css" rel="stylesheet"> 

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
                        <span class="icon-bar"></span> 
                        <span class="icon-bar"></span> 
                        <span class="icon-bar"></span> 				
                    </a>
                    <a class="brand" href="../assets/admin/">Adminia Admin</a>
                    <div class="nav-collapse">
                        <ul class="nav pull-right">
                            <li class="">
                                <a href="javascript:;"><i class="icon-chevron-left"></i> Back to Homepage</a>
                            </li>
                        </ul>
                    </div> <!-- /nav-collapse -->
                </div> <!-- /container -->
            </div> <!-- /navbar-inner -->
        </div> <!-- /navbar -->
        <div id="login-container">
            <div id="login-header">
                <h3>Login</h3>
            </div> <!-- /login-header -->
            <div id="mensagem"></div>
            <div id="login-content" class="clearfix">
                <form data-remote="true" 
                      focus-response="#mensagem" 
                      id="form" method="post" 
                      action="index.php/autenticacao/setDados">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="username">Username</label>
                            <div class="controls">
                                <input type="text" name="usuario" class="" id="username">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="password">Password</label>
                            <div class="controls">
                                <input type="password" name="senha" class="" id="password">
                            </div>
                        </div>
                    </fieldset>

                    <div id="remember-me" class="pull-left">
                        <input type="checkbox" name="remember" id="remember" />
                        <label id="remember-label" for="remember">Remember Me</label>
                    </div>

                    <div class="pull-right">
                        <button type="submit" class="btn btn-warning btn-large">
                            Login
                        </button>
                    </div>
                </form>
            </div> <!-- /login-content -->

            <div id="login-extra">
                <p>Don't have an account? <a href="javascript:;">Sign Up.</a></p>
                <p>Remind Password? <a href="forgot_password.html">Retrieve.</a></p>
            </div> <!-- /login-extra -->

        </div> <!-- /login-wrapper -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../assets/admin/js/jquery-1.7.2.min.js"></script>
        <script src="../assets/admin/js/bootstrap.js"></script>
        <script src="../assets/admin/js/jqform.js"></script>
        <script src="../assets/admin/js/main.js"></script>

    </body>
</html>