<!DOCTYPE html>
<html>
	<head>
	    <title>Freeads</title>
	    <link rel="stylesheet" type="text/css" href="<?php echo URL::asset('css/style.css') ?>">
	</head>
	<body id="welcome">
	    <header>
	        <h1><a title="acceuil" href=""><img id="logo" alt="logo" src="<?php echo URL::asset('images/logo.jpg') ?>"></a></h1>
	        <ul>
	                <li><?php echo HTML::link('login', 'Login'); ?></li>
	                <li><?php echo HTML::link('inscription', "S'inscrire"); ?></li>
	        </ul>
	    </header>
	    
	</body>
</html>

