<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL::asset('css/style.css') ?>">
</head>
<body>
    <header>
        <h1><a title="acceuil" href="accueil"><img id="logo" alt="logo" src="<?php echo URL::asset('images/logo.jpg') ?>"></a></h1>
        <ul>
            <li><span><?php echo "Bonjour " . ucfirst(Auth::user()->username); ?></span></li>
            <li><?php echo HTML::link('accueil', 'Acceuil'); ?></li>
            <li><?php echo HTML::link('message', 'Message'); ?></li>
            <li><?php echo HTML::link('logout', "Deconnexion"); ?></li>
        </ul>
    </header>
    <div class="content">
        <?php echo Form::open(array('method' => 'post', 'files'=>true)); ?>
        <div id="form_upload">
        <span id="red"><?php echo $errors->first(); ?></span>

            <ul>
                <li><?php echo Form::label('title',"Titre de l'annonce :"); ?></li>
                <li><?php echo Form::text('title'); ?></li>
                <li><?php echo Form::label('description',"Description :"); ?></li>
                <li><?php echo Form::textarea('description', null); ?></li>
                <li><?php echo Form::label('categorie',"Catégorie :"); ?></li>
                <li><?php echo Form::select('categorie', array('all' => 'Toutes catégories', 'vehicule' => 'Vehicules', 'multimedia' => 'Multimedia', 'loisirs' => 'loisirs', 'maison' => 'Maison', 'autre' => 'Autres')); ?></li>
                <li><?php echo Form::label('couleur',"Couleur :"); ?></li>
                <li><?php echo Form::text('couleur'); ?></li>
                <li><?php echo Form::label('prix',"Prix :"); ?></li>
                <li><?php echo Form::text('prix',null, array('placeholder'=> '€')); ?></li>
                <li><?php echo Form::label('file1', 'Photo 1: '); ?></li>
                <li><?php echo Form::file('file1'); ?></li>
                <li><?php echo Form::label('file2', 'Photo 2: '); ?></li>
                <li><?php echo Form::file('file2'); ?></li>
                <li><?php echo Form::label('file3', 'Photo 3: '); ?></li>
                <li><?php echo Form::file('file3'); ?></li>
                <li><?php echo Form::submit("Publier mon annonce"); ?></li>
                <li><input type="hidden" name="_token" value="{{{ csrf_token() }}}"></li>
            </ul>
        </div>
        <?php echo Form::close(); ?>    
    </div>
</body>
</html>
