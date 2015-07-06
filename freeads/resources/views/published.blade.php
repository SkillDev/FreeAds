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

        <div id="main">
        <?php if(Session::has('message')) { ?>
            <h2><?php echo  Session::get('message') ?></h2>
        <?php } ?>
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
                <div class="edit">
                    <a title="edit" href="edit?id=<?php echo $annonce->id; ?>"> Edit</a>
                    <a title="supprimer" href="delete?id=<?php echo $annonce->id; ?>">Delete </a>
                </div>
            <?php } ?>
        </div>



    </div>
</body>
</html>
