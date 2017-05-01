<?php
error_reporting(0);

// unset cookies
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}

//error_reporting(E_NONE);
 //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.
 
$db_config_path = '../application/config/database.php';
// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();


	// Validate the post data
	if($core->validate_post($_POST) == true)
	{

		// First create the database, then create tables, then write config file
		if($database->create_database($_POST) == false) {
			$message = $core->show_message('error',"The database could not be created, please verify your settings.");
		} else if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		} else if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod application/config/database.php file to 777");
		}


		// If no errors, redirect to registration page
		if(!isset($message)) {
		  $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
	      $redir .= "://".$_SERVER['HTTP_HOST'];
	      $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
	      $redir = str_replace('install/','',$redir); 
				header( 'Location: ' . $redir);

		}

	}
	else {
		$message = $core->show_message('error','Not all fields have been filled in correctly. The host, username, password, and database name are required.');
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Install | LMS</title>

		<style type="text/css">
	 html, body{
      background: url(bg.png);
      background-size:cover;
      width: 100%;
      height: 100%; background-repeat:no-repeat; background-attachment:local;  font-size: 90%;
		    font-family: Helvetica,Arial,sans-serif;
		   
		    margin: 0 auto; 
      }
		  input  {
		    display: block;
		    font-size: 12px;
		    margin: 0; height:25px; padding:0px 5px;
		  
		  }
		  label {
		    margin: 5px 0px !important; float:left; font-weight:bold;
		  }
		  input.input_text {
		    width: 96%; 
		  }
		  input#submit {
		    float:left; margin:15px 0px;
		    font-size: 15px; 
			
			width: 75px;
height: 32px;
background: #384145;
border-radius: 0 !important;
border-bottom: 4px solid #000;
border-left: 0 !important;
border-right: 0 !important;
border-top: 0 !important;
font-size: 14px;
line-height: 30px; color:#fff;
 
 
		  }
		  fieldset {
		    padding: 15px;
		    border-radius:10px; border:none;
		  }
		  legend {
		    font-size: 14px;
		    font-weight: bold; padding:0px 15px;
		  }
		  .error {
		    background: #ffd1d1;
		    border: 1px solid #ff5858;
        padding: 4px; float:left; margin:5px; clear:both;
		  }
		  .install{    background: none repeat scroll 0 0 #fff;
    border-radius: 5px;
    margin: 65px auto 0;
    width: 32%;}
		  .form-hed {
font-size: 20px;
color: #437ba3;
text-shadow: 0 0px 0px rgba(0, 0, 0, 0.0) !important;
text-align: left;
border-bottom: 1px solid #ccc; padding:5px 10px; margin-top:10px; float:left; width:93.5%;
  }
  .fluid-hedder {
    background: none repeat scroll 0 0 #ffdb31;
    border-bottom: 3px solid #ffffff;
    clear: both;
    display: flex;
    margin: 0 auto;
    position: relative;
    width: 100%;
    z-index: 999999;
}
.logo {
background: #437ba3;
padding: 0; float:left;
}
		</style>
	</head>
	<body>
<div class=" fluid-hedder ">
         <div class="logo"><a href="#"><img src="thumbnail-80x80.JPG" align="center" ></a></div>
</div>



<div class="install"> 
    <h1 class="form-hed">Installation</h1> 
	    <?php if(is_writable($db_config_path)){?>
		
		<div>
			<?php if(isset($message)) {echo '<p class="error">' . $message . '</p>';}?>	
		</div>

		<form id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
        
          <label for="hostname">Host Name</label><input type="text" id="hostname" value="localhost" class="input_text" name="hostname" required />
          <label for="username">User Name</label><input type="text" id="username" class="input_text" name="username" required />
          <label for="password">Password</label><input type="password" id="password" class="input_text" name="password"  />
          <label for="database">Database Name</label><input type="text" id="database" class="input_text" name="database" required />
          <input type="submit" value="Install" id="submit" />
        </fieldset>
		  </form>

	  <?php } else { ?>
      <p class="error">Please make the application/config/database.php file writable. <strong>Example</strong>:<br /><br /><code>chmod 777 application/config/database.php</code></p>
	  <?php } ?>
</div>
	</body>
</html>