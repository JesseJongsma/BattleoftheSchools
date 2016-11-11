
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
        <link href="css/cover.css" rel="stylesheet">
        

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
            //change database password

            $Connect = new Connect("localhost","root","root","bos","werknemers");
            $Connect = new Connect("localhost","root","","bos","werknemers");

            $email = $Connect->link->real_escape_string($_POST['email']);
            $pass = $Connect->link->real_escape_string($_POST['password']);
            $password = $pass; //hash ("sha256", $pass);
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
                    $_SESSION['login'] = true;
                    $_SESSION['id'] = $id;
                    $_SESSION['gebruiker'] = "werknemer";
                    header("Location: /BattleoftheSchools/index.php");
                }
                else
                {

                    $Connect = new Connect("localhost","root","root","bos","bedrijven");
                    $Connect = new Connect("localhost","root","","bos","bedrijven");
                    $query = "SELECT id, mail, pass FROM bedrijven WHERE mail = '$email' AND pass = '$pass';";
                    $result = $Connect->link->query($query);
                    while($row = $result->fetch_array(MYSQLI_ASSOC))
                    {
                        $id = $row['id'];
                    }

                    if(isset($id))
                    {
                        session_start();
                        $_SESSION['login'] = true;
                        $_SESSION['id'] = $id;
                        $_SESSION['gebruiker'] = "werkgever";
                        header("Location: /BattleoftheSchools/index.php");
                    }
                    else
                    {
                        echo "login mislukt";
                    }
                }
            }
            else
            {
                echo "login mislukt";
            }

        }
    ?>

        <!-- Navigation -->
        

        <!-- Page Content -->
        <div class="container">
        	<div class="row">
    			<div class="col-md-6 col-md-offset-3">
    				<div class="panel panel-login">
    					<div class="panel-heading">
    						<div class="row">
    							<div class="col-xs-6">
    								<a href="#" class="btn" id="login-form-link">Login</a>
    							</div>
    							<div class="col-xs-6">
    								<a class="btn" href="register.php">Registreer</a>
    							</div>
    						</div>
    						<hr>
    					</div>
    					<div class="panel-body">
    						<div class="row">
    							<div class="col-lg-12">
                                    <!--Login-->
    								<form id="login-form" action="" method="post" role="form">
                                        <div></div>
    									<div class="form-group">
    										<input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email">
    									</div>
    									<div class="form-group">
    										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Wachtwoord">
    									</div>
    									<div class="form-group">
    										<div class="row">
    											<div class="col-sm-6 col-sm-offset-3">
    												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn" value="Log in">
    											</div>
    										</div>
    									</div>
    									<div class="form-group">
    										<div class="row">
    											<div class="col-lg-12">
    												<div class="text-center">
    													<a href="forgot.php">Wachtwoord vergeten?</a>
    												</div>
    											</div>
    										</div>
    									</div>
    								</form>
                                    <!--/Login-->
                                    <!--Register-->
                                    <div id = "message"></div>
    								<form id="register-form" action="" method="post" role="form">

                                    <!--email-->
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" tabindex="2" class="form-control" placeholder="email">
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
    												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registreer nu!">
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
                                                    <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registreer nu!">
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
