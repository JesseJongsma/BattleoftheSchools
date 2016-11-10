
<html lang="en">

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

        if(isset($_POST['register-submit-wz']))
        {
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = hash ("sha256", $_POST['password']);
            $confirm = hash ("sha256", $_POST['confirm-password']);

            $results = array("$email","$phone","$password");

            if ($password == $confirm) 
            {
                $Connect = new Connect("localhost","root","NuclearHotdog94","battleoftheschools","werknemers");
                if($Connect->Create($results))
                {
                    header("Location: login.php");
                }
                else
                {
                    echo "test";
                }
            }
        }

        if(isset($_POST['register-submit-wg']))
        {

            $name = $_POST['name'];
            $adres = $_POST['adres'];
            $huisnummer = $_POST['huisnummer'];
            $postcode = $_POST['postcode'];
            $woonplaats = $_POST['woonplaats'];
            $beschrijving = $_POST['beschrijving'];
            $telefoon = $_POST['telefoon'];
            $password = hash ("sha256", $_POST['password']);
            $confirm = hash ("sha256", $_POST['confirm-password']);

            $results = array("$name","$adres","$huisnummer","$postcode","$woonplaats","$beschrijving","$telefoon","$password");

            if ($password == $confirm) 
            {
                $Connect = new Connect("localhost","root","NuclearHotdog94","battleoftheschools","bedrijven");
                if($Connect->Create($results))
                {
                    header("Location: login.php");
                }
                else
                {
                    echo "test";
                }
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

    </header>

    <!-- Page Content -->
    <div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Register als werkzoekende</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register als werkgever</a>
							</div>
						</div>
						<hr>
					</div>
                    <div id = "message"></div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<!--Register-->
                                    <div id = "message"></div>
                                    <form id="login-form" action="" method="post" role="form">

                                    <!--email-->
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" tabindex="2" class="form-control" placeholder="email">
                                        </div>

                                    <!--wachtwoord-->
                                        <div class="form-group">
                                            <input type="number" name="phone" id="phone" tabindex="2" class="form-control" placeholder="phone">
                                        </div>

                                    <!--wachtwoord-->
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Wachtwoord">
                                        </div>

                                    <!--confirm-->
                                        <div class="form-group">
                                            <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Bevestig wachtwoord">
                                        </div>

                                    <!--submit-->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="register-submit-wz" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registreer nu!">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <!-- /Register -->
                                <!-- Register -->
                                    <form id="register-form" action="" method="post" role="form">
                                    <!--naam-->
                                        <div class="form-group">
                                            <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Naam Bedrijf" value="">
                                        </div>

                                    <!--adres-->
                                        <div class="form-group">
                                            <input type="text" name="adres" id="adres" tabindex="1" class="form-control" placeholder="Adres" value="">
                                        </div>

                                    <!--huisnummer-->
                                        <div class="form-group">
                                            <input type="text" name="huisnummer" id="huisnummer" tabindex="1" class="form-control" placeholder="Huisnummer" value="">
                                        </div>

                                    <!--postcode-->
                                        <div class="form-group">
                                            <input type="text" name="postcode" id="postcode" tabindex="1" class="form-control" placeholder="Postcode" value="">
                                        </div>

                                    <!--woonplaats-->
                                        <div class="form-group">
                                            <input type="text" name="woonplaats" id="woonplaats" tabindex="1" class="form-control" placeholder="woonplaats" value="">
                                        </div>

                                    <!--beschrijving-->
                                        <div class="form-group">
                                            <textarea  class="form-control" rows="4" cols="50" name="beschrijving" id="beschrijving" placeholder="Korte omschrijving"></textarea>
                                        </div>

                                    <!--telefoon-->
                                        <div class="form-group">
                                            <input type="number" name="telefoon" id="telefoon" tabindex="1" class="form-control" placeholder="Telefoonnummer" value="">
                                        </div>

                                    <!--wachtwoord-->
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Wachtwoord">
                                        </div>

                                    <!--confirm-->
                                        <div class="form-group">
                                            <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Bevestig wachtwoord">
                                        </div>

                                    <!--submit-->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="register-submit-wg" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registreer nu!">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <!-- /Register -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
