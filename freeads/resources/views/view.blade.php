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
        <?php $donne = DB::select('select * from annonces where id = ?', [$_GET['id']]); ?>
        <div id="main">
            <?php foreach ($donne as $annonce) { ?>
                <div class="annonce_view">
                    <h2>{{{ $annonce->title }}}</h2>
                    <div class="desc">
                        <p>{{{ $annonce->description }}}</p>
                    </div>
                    <?php $image = explode('|', $annonce->image); ?>
                    <?php if ($annonce->id_user !== Auth::user()->id) { ?>
                        <div class="chat">
                            <p><a title="message" href="msg?id=<?php echo $annonce->id_user ?>">Envoyer un message</a></p>
                        </div>
                    <?php } ?>
                    <div class="prix">
                        <p><?php echo "Prix : " .  number_format($annonce->prix, $decimals = 0 , $dec_point = "." , $thousands_sep = " " ) . "€"; ?></p>
                    </div>
                    <?php foreach ($image as $key ) { ?>
                        <div class="img">
                            <img class="img" alt="no image" src="annonces/images/<?php echo $key; ?>">
                        </div>
                    <?php } ?>
                </div>

            <?php } ?>
        </div>



    </div>
</body>
</html>
