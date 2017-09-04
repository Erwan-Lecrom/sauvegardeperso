<?php $this->layout('layout', ['title' => $title]) ?>

<?php $this->start('main_content') ?>
	<form method="post">
		<label for="email">Identifiant (Adresse Mail) : </label>
		<input type="text" name="email" id="email" value="<?= $email ?>">
		<label for="password">Mot de passe :</label>
		<input type="password" name="password" id="password">
		<label for="repeat_password">Répétez le mot de passe :</label>
		<input type="password" name="repeat_password" id="repeat_password">
		<label for="firstname">Prenom :</label>
		<input type="text" name="firstname" id="firstname" value="<?= $firstname ?>">
		<label for="lastname">Nom :</label>
		<input type="text" name="lastname" id="lastname" value="<?= $lastname ?>">
		<label for="birthdate">Date de naissance : </label>
		<input type="text" name="birthdate" id="birthdate" value="<?= $birthdate ?>">
		<select name="departement">
			<option value="nord">Nord</option>
			<option value="pas_de_calais">Pas De Calais</option>
		</select>
		<label for="autism">Situation :</label>
		<input type="text" name="autism" id="autism" value="<?= $autism ?>">
		<select name="situation">
			<option value="autiste">Autiste</option>
			<option value="parent d'autiste">Parent d'autiste</option>
			<option value="medecin">Medecin</option>
		</select>
		<button>S'inscrire</button>
	</form>
<?php $this->stop('main_content') ?>