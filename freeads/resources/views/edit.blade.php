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
            <li><?php echo HTML::link('logout', "Deconnexion"); ?></li>
        </ul>
    </header>
    <div class="content">

        <div id="main">
            <?php echo Form::open(array('method' => 'post', 'files'=>true)); ?>

            <?php foreach ($donne as $annonce) { ?>
            <div class="edit_div">
                <ul>
                    <li><?php echo Form::label('title',"Titre de l'annonce :"); ?></li>
                    <li><?php echo Form::text('title', ucfirst($annonce->title)); ?></li>
                    <li><?php echo Form::label('description',"Description :"); ?></li>
                    <li><?php echo Form::textarea('description', ucfirst($annonce->description)); ?></li>
                    <?php $image = explode('|', $annonce->image); ?>
                    <?php foreach ($image as $key ) { ?>
                            <li><img alt="image" src="annonces/images/<?php echo $key; ?>"></li>
                    <?php } ?> 
                    <li><input type="hidden" name="id" value="<?php echo $annonce->id; ?>"></li>
                    <li><?php echo Form::label('prix',"Prix :"); ?></li>
                    <li><?php echo Form::text('prix', $annonce->prix); ?></li>
                    <li><?php echo "Posté le "  .  date("d/m/Y", strtotime(substr($annonce->created_at, 0, 10))) . " à " . substr($annonce->created_at, 10); ?></li>
                    <li><?php echo Form::submit("Update"); ?></li>
                </ul>
            </div>
            <?php } ?>
            <?php echo Form::close(); ?>    
        </div>




    </div>
</body>
</html>
