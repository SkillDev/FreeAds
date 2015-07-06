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
            <li><span><?php echo HTML::link('profil', "Bonjour " . ucfirst(Auth::user()->username)); ?></span></li>
            <li><?php echo HTML::link('published', "Mes annonces"); ?></li>
            <li><?php echo HTML::link('message', 'Message'); ?></li>
            <li><?php echo HTML::link('logout', "Deconnexion"); ?></li>
        </ul>
    </header>
    <div class="content">
        <div class="search">
            <?php echo Form::open(array('method' => 'post')); ?>
                <?php echo Form::text('cle', NULL, array('placeholder' => 'Mot clé')); ?>
                <?php echo Form::select('categorie', array('all' => 'Toutes catégories', 'vehicule' => 'Vehicules', 'multimedia' => 'Multimedia', 'loisirs' => 'loisirs', 'maison' => 'Maison', 'autre' => 'Autres')); ?>
                <?php echo Form::text('prix', NULL, array('placeholder' => 'Prix')); ?>
                <?php echo Form::text('couleur', NULL, array('placeholder' => 'Couleur')); ?>
                <?php echo Form::submit("Rechercher"); ?>
            <?php echo Form::close(); ?>
        </div>
        <div id="main">
            <?php foreach ($donne as $annonce) { ?>
                <a href="view?id=<?php echo $annonce->id; ?>"><div class="annonce_div">
                    <h2>{{{ ucfirst($annonce->title) }}}</h2>
                    <?php $image = explode('|', $annonce->image); ?>
                        <img class="img" alt="no image" src="annonces/images/<?php echo $image[0]; ?>">   
                    <div class="prix">
                        <p><?php echo "Prix : " .  number_format($annonce->prix, $decimals = 0 , $dec_point = "." , $thousands_sep = " " ) . "€"; ?></p>
                    </div>
                    <p><?php echo "Posté le "  .  date("d/m/Y", strtotime(substr($annonce->created_at, 0, 10))) . " à " . substr($annonce->created_at, 10); ?></p>
                </div></a>

            <?php } ?>
        </div>


    </div>
</body>
</html>
