<?php $this->layout('layout', ['title' => $title]) ?>

<?php $this->start('main_content') ?>
	<form method="post">
		<label>Identifiant (Adresse Mail) : </label>
		<input type="text" name="email" id="email" value="<?= $email ?>">
		<label>Mot de passe :</label>
		<input type="password" name="password" id="password">
	</form>
<?php $this->stop('main_content') ?>