<?php
require('includes/inc_functions.php');
require('includes/inc_db_con.php');
session_start();

 ?>
 <!--Main HTML content-->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <title>WordPress installer</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">

    <link href="css/main.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style type="text/css">
      #wp_form fieldset:not(:first-of-type) {
        display: none;
      }
    </style>
		<!--Google recaptha-->
	  <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body>
    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">WordPress installer</h2>
										<div class="progress">
										    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
										  </div>
										  <form id="wp_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
										  <fieldset>
										    <h3>Field 1: Create SQL database</h3>
										    <div class="form-group  div-input">
										    <label for="sql">SQL database</label>
										    <input type="text" class="form-control" id="sql" name="wp_db" placeholder="SQL database" maxlength="12" value="<?php if (isset($_POST['wp_db'])) echo $_POST['wp_db']; ?>">
										    </div>
										    <input type="button"  class="next btn btn-info" value="Next" />
										  </fieldset>
										  <fieldset>
										    <h3> Field 2: Create Word Press Directory</h3>
										    <div class="form-group div-input">
										    <label for="wp_dir">Word Press Directory</label>
										    <input type="text" class="form-control" name="wp_dir" id="wp_dir" placeholder="WP directory" maxlength="12" value="<?php if (isset($_POST['wp_dir'])) echo $_POST['wp_dir']; ?>">
										    </div>
										    <input type="button" name="previous" class="previous btn btn-secondary" value="Previous" />
                        <input type="button"   class="next btn btn-info" value="Next" />
										  </fieldset>
                      <fieldset>
                        <h2><center> Ready to go!</center></h2>
                        <h3><center> One last step is security check.</center></h3>
                        <!--Main submit button-->
                        <center>
                        <div class="float-none recapt">
                          <!-- Google recaptcha site key-->

                            <div class="g-recaptcha recapt" data-sitekey="PASTE YOUR KEY HERE"></div>

                        </div>
                        </center>
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                      </fieldset>
										  </form>

												<?php
                        if(isset($_POST['g-recaptcha-response'])) {
                          // RECAPTCHA CALLS
                         $captcha = $_POST['g-recaptcha-response'];
                         $ip = $_SERVER['REMOTE_ADDR'];
                         //SECRET KEY
                         $key = 'PASTE YOUR KEY HERE';
                         $url = 'https://www.google.com/recaptcha/api/siteverify';

                         // RECAPTCHA RESPONSE
                         $recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
                         $data = json_decode($recaptcha_response);

                         if(isset($data->success) &&  $data->success === true) {

                            require('action.php');
                         }else {
                           ?>
														<div class="alert alert-danger" role="alert" id="dialog" >
																<p><strong>You did not pass security test! Please check I am not a robot button. </strong></p>
														</div>
														<?php

                         }
                       }
                        ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script>
				$(document).ready(function(){
				var current = 1,current_step,next_step,steps;
				steps = $("fieldset").length;
				$(".next").click(function(){
					current_step = $(this).parent();
					next_step = $(this).parent().next();
					next_step.show();
					current_step.hide();
					setProgressBar(++current);
				});
				$(".previous").click(function(){
					current_step = $(this).parent();
					next_step = $(this).parent().prev();
					next_step.show();
					current_step.hide();
					setProgressBar(--current);
				});
				setProgressBar(current);
				// Change progress bar action
				function setProgressBar(curStep){
					var percent = parseFloat(100 / 3) * curStep;
					percent = percent.toFixed();
					$(".progress-bar")
						.css("width",percent+"%")
						.html(percent+"%");
				}
				});
		</script>
</body>

</html>
<!-- end document-->
<?php session_destroy(); ?>
