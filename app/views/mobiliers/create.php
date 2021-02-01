<?php require APP_ROOT . '/views/inc/head.php'; ?>
<div class="navbar dark">
	<?php require APP_ROOT . '/views/inc/nav.php' ?>
</div>

<div class="container center">
	<h1>Crée une annonce</h1>
	<?php var_dump($_POST); ?>
	<form action="<?= URL_ROOT ?>/mobiliers/create" method="post">
		<div class="form-item">
			<input type="text" name="modele" id="modele" placeholder="Modèle">
			<span class="invalidFeedback">
				<?= $data['modeleError'] ?>
			</span>
		</div>
		<div class="form-item">
			<input type="text" name="couleur" id="couleur" placeholder="Couleur">
			<span class="invalidFeedback">
				<?= $data['couleurError'] ?>
			</span>
		</div>
		<div class="form-item">
			<input type="text" name="taille" id="taille" placeholder="Taille">
			<span class="invalidFeedback">
				<?= $data['tailleError'] ?>
			</span>
		</div>
        <div class="form-item">
            <input type="text" name="type" id="type" placeholder="Type">
            <span class="invalidFeedback">
				<?= $data['typeError'] ?>
			</span>
        </div>

		<div class="form-item">
            <input type="text" name="price" id="price" placeholder="Price">
            <span class="invalidFeedback">
				<?= $data['priceError'] ?>
			</span>
        </div>

		<button class="btn green" name="submit" type="submit">Créer</button>
	</form>
</div>