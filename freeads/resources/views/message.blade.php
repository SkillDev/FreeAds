<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL::asset('css/style.css') ?>">
</head>
<body>
    <header>
        <h1><a title="acceuil" href="accueil"><img id="logo" alt="logo" src="<?php echo URL::asset('images/logo.jpg') ?>"></a></h1>
        <p class="add"><?php echo HTML::link('upload', 'Ajouter une annonce'); ?></p>
        <ul>
            <li><span><?php echo "Bonjour " . ucfirst(Auth::user()->username); ?></span></li>
            <li><?php echo HTML::link('profil', 'Modifier mes infos'); ?></li>
            <li><?php echo HTML::link('message', 'Message'); ?></li>
            <li><?php echo HTML::link('logout', "Deconnexion"); ?></li>
        </ul>
    </header>
    <div class="content">
        <ul class="lol">
            <li><?php echo HTML::link('received', 'Messages reçus'); ?></li>
            <li><?php echo HTML::link('sended', 'Messages envoyés'); ?></li>
        </ul>

    </div>
</body>
</html>
