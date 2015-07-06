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
    	<div class="conversation">
	    		<?php foreach ($donne as $message) { ?>
	    			<table class="msg">
	    				<tr>
								<?php if($message->username == Auth::user()->username) { ?>
									<td class="name"><span class="moi"><?php echo "Moi :"; ?></span></td>
								<?php } ?>

								<?php if($message->username !== Auth::user()->username) { ?>
									<td class="name"><span class="x"><?php echo ucfirst($message->username) . ' : ';?></span></td>
								<?php } ?>

								<td class="text"> {{{ $message->content }}} </td>
								<td class="date"><?php echo $message->created_at; ?></td>
						</tr>


					</table>
	    		<?php } ?>

	    	<?php echo Form::open(array('method' => 'post', 'files'=>true)); ?>
	    		<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
				<?php echo Form::textarea('content'); ?>
				<?php echo Form::submit("Envoyer"); ?>
			<?php echo Form::close(); ?>
		</div>
    </div>
</body>
</html>


