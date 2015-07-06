<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo URL::asset('css/style.css') ?>">
    <title>Inscription</title>
</head>
<body>
    <header>
        <h1><a href="../public"><img id="logo" alt="logo" src="<?php echo URL::asset('images/logo.jpg') ?>"></a></h1>
        <ul>
            <li><?php echo HTML::link('login', "Connexion"); ?></li>
        </ul>
    </header>
    <div id="container">
        <h2 class="h2">Inscription</h2>
        <div id="form">

            <span id="red"><?php echo $errors->first(); ?></span>
            <?php echo Form::open(array('method' => 'post')); ?>
                <ul>
                    <li> <?php echo Form::label('username','Username :'); ?></li>
                    <li> <?php echo Form::text('username', null, array('placeholder'=> 'Min 5 characteres')); ?></li>
                    <li> <?php echo Form::label('name',' Nom : '); ?></li>
                    <li> <?php echo Form::text('name', null,array('class' => 'form-control')); ?></li>
                    <li> <?php echo Form::label('lastname',' Prénom : '); ?></li>
                    <li> <?php echo Form::text('lastname', null,array('class' => 'form-control')); ?></li>
                    <li> <?php echo Form::label('email',' Email :'); ?></li>
                    <li> <?php echo Form::text('email', null,array('class' => 'form-control')); ?></li>
                    <li> <?php echo Form::label('birthdate',' Date de naissance : '); ?></li>
                    <li> <?php echo Form::input('date', 'birthdate'); ?></li>
                    <li> <?php echo Form::label('password',' Mot de pass :'); ?></li>
                    <li> <?php echo Form::password('password',array('class' => 'form-control')); ?></li>
                    <li> <?php echo Form::submit("S'inscrire", array('class' => 'btn btn-primary')); ?></li>
                </ul>
            <?php echo Form::close(); ?>
        </div>
    </div>
</body>
</html>
