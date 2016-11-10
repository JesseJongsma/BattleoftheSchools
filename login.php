
<html lang="nl">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Half Slider - Start Bootstrap Template</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        

        <!-- Custom CSS -->
        <link href="css/half-slider.css" rel="stylesheet">
        <link href="css/1-col-portfolio.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">

        <!-- Custom JS -->
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

    <?php
        require "connect.php";

        if (isset($_POST['login-submit']))
        {
            $email = $Connect->link->real_escape_string($_POST['email']);
            $pass = $Connect->link->real_escape_string($_POST['password']);
            $query = "SELECT id, mail, pass FROM werknemers WHERE mail = '$email' AND pass = '$pass';";
            if($result = $Connect->link->query($query))
            {
                while($row = $result->fetch_array(MYSQLI_ASSOC))
                {
                    $id = $row['id'];
                }

                if(isset($id))
                {
                    session_start();
                    echo "logged in";
                    $_SESSION['login'] = true;
                    $_SESSION['id'] = $id;
                }
                else
                {
                    echo "log in failed";
                }
            }
            else
            {
                echo "log in failed";
            }

        }

        if (isset($_POST['register-submit']))
        {
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $pass = $_POST['password'];
            $confirm = $_POST['confirm-password'];

            if($pass == $confirm)
            {
                
            }
        }
    ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">home</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="weergavemeerdere.php">Appartementen</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <div class="container">
        	<div class="row">
    			<div class="col-md-6 col-md-offset-3">
    				<div class="panel panel-login">
    					<div class="panel-heading">
    						<div class="row">
    							<div class="col-xs-6">
    								<a href="#" class="active" id="login-form-link">Login</a>
    							</div>
    							<div class="col-xs-6">
    								<a href="#" id="register-form-link">Registreer</a>
    							</div>
    						</div>
    						<hr>
    					</div>
    					<div class="panel-body">
    						<div class="row">
    							<div class="col-lg-12">
                                    <!--Login-->
    								<form id="login-form" action="" method="post" role="form">
    									<div class="form-group">
    										<input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email">
    									</div>
    									<div class="form-group">
    										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Wachtwoord">
    									</div>
    									<div class="form-group text-center">
    										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
    										<label for="remember"> Onthoud mij</label>
    									</div>
    									<div class="form-group">
    										<div class="row">
    											<div class="col-sm-6 col-sm-offset-3">
    												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log in">
    											</div>
    										</div>
    									</div>
    									<div class="form-group">
    										<div class="row">
    											<div class="col-lg-12">
    												<div class="text-center">
    													<a href="" tabindex="5" class="forgot-password">Wachtwoord vergeten?</a>
    												</div>
    											</div>
    										</div>
    									</div>
    								</form>
                                    <!--/Login-->
                                    <!--Register-->
                                    <div id = "message"></div>
    								<form id="register-form" action="" method="post" role="form">
    									<div class="form-group">
    										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email adres" value="">
    									</div>
                                        <div class="form-group">
                                            <input type="number" name="phone" id="phone" tabindex="1" class="form-control" placeholder="Telefoon nummer" value="">
                                        </div>
    									<div class="form-group">
    										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Wachtwoord">
    									</div>
    									<div class="form-group">
    										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Bevestig wachtwoord">
    									</div>
    									<div class="form-group">
    										<div class="row">
    											<div class="col-sm-6 col-sm-offset-3">
    												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registreer nu!">
    											</div>
    										</div>
    									</div>
    								</form>
                                    <!--/Register-->
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </body>
</html>
