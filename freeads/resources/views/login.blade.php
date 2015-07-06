<!DOCTYPE html>
<html>
    <head>
        <title>Connexion</title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL::asset('css/style.css') ?>">
    </head>
    <body>
        <header>
            <h1><a title="acceuil" href="../public"><img id="logo" alt="logo" src="<?php echo URL::asset('images/logo.jpg') ?>"></a></h1>
            <ul>
                <li><?php echo HTML::link('inscription', "S'inscrire"); ?></li>
            </ul>
        </header>
        <div id="container">
            <h2 class="h2">Connexion</h2>
            <div id="form">
                <span id="red"><?php echo $errors->first(); ?></span>
                <?php echo Form::open(array('method' => 'post')); ?>
                    <ul>
                        <li><?php echo Form::label('username','Username '); ?></li>
                        <li><?php echo Form::text('username', null,array('class ' => 'form-control')); ?></li>
                        <li><?php echo Form::label('password',' Password '); ?></li>
                        <li><?php echo Form::password('password',array('class' => 'form-control')); ?></li>
                        <li><?php echo Form::submit("Me connecter", array('class' => 'btn btn-primary')); ?></li>
                    </ul>
                <?php echo Form::close(); ?>
            </div>
        </div>

    </body>
</html>