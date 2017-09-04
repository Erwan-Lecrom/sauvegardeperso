<?php $this->layout('layout', ['title' => $title]) ?>

<?php $this->start('main_content') ?>
<?php 
	foreach ($errors as $error) {
		?>
		<?= $error ?> <br/>
<?php	}
?>
	<form method="post">
		<div class="form-group">
			<label for="email">Identifiant (Adresse Mail) : </label>
			<input type="email" name="email" id="email" value="<?= $email ?>"><br/>
		</div>
		<div class="form-group">
			<label for="password">Mot de passe :</label>
			<input type="password" name="password" id="password"><br/>
		</div>
		<div class="form-group">
			<label for="repeat_password">Répétez le mot de passe :</label>
			<input type="password" name="repeat_password" id="repeat_password"><br/>
		</div>
		<div class="form-group">
			<label for="firstname">Prenom :</label>
			<input type="text" name="firstname" id="firstname" value="<?= $firstname ?>"><br/>
		</div>
		<div class="form-group">
			<label for="lastname">Nom :</label>
			<input type="text" name="lastname" id="lastname" value="<?= $lastname ?>"><br/>
		</div>
		<div class="form-group">
			<label for="birthday">Date de naissance : </label>
		<input type="text" name="birthday" id="birthday" value="<?= $birthday ?>"><br/>
		</div>
		<div class="form-group">
			<label for="departement">Departement</label>
			<select name="departement" id="departement">
				<option value="nord">Nord</option>
				<option value="pas de calais">Pas De Calais</option>
			</select><br/>
		</div>
		<div class="form-group">
			<label for="autism">Autismes</label>
			<select name="autism" id="autism">
				<option></option>
			</select><br/>
		</div>
		<div class="form-group">
			<label for="situation">Situation</label>
			<select name="situation">
				<option value="autiste">Autiste</option>
				<option value="parent d'autiste">Parent d'autiste</option>
				<option value="medecin">Medecin</option>
			</select><br/>
		</div>
		<button>S'inscrire</button>
	</form>
<?php $this->stop('main_content') ?>