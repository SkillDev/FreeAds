<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL::asset('css/style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo URL::asset('css/dropezone.css') ?>">
</head>
<body>
    <header>
        <h1><a title="acceuil" href="accueil"><img id="logo" alt="logo" src="<?php echo URL::asset('images/logo.jpg') ?>"></a></h1>
        <ul>
            <li><span><?php echo "Bonjour " . ucfirst(Auth::user()->username); ?></span></li>
            <li><?php echo HTML::link('accueil', 'Acceuil'); ?></li>
            <li><?php echo HTML::link('logout', "Deconnexion"); ?></li>
        </ul>
    </header>
    <div class="content">
        <p><?php echo HTML::link('password', "Changer mon mot de pass"); ?></p>
        <?php echo Form::open(array('method' => 'post', 'files'=>true)); ?>
        <div id="form_upload">
            <span id="red"><?php echo $errors->first(); ?></span>
            <ul>
                <li><?php echo Form::label('username',"Nom d'utilisateur :"); ?></li>
                <li><?php echo Form::text('username',Auth::user()->username, array('placeholder'=> 'Minimum 5 characters')); ?></li>
                <li><?php echo Form::label('email',"email :"); ?></li>
                <li><?php echo Form::text('email', Auth::user()->email); ?></li>
                <li><?php echo Form::submit("Enregistrer les modifications"); ?></li>
            </ul>
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
        </div>
            <?php echo Form::close(); ?>
        
    </div>
    <script src="<?php echo URL::asset('js/dropezone.js') ?>"> </script>
</body>
</html>
