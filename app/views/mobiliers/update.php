<?php require APP_ROOT . '/views/inc/head.php'; ?>

<div class="navbar dark">
    <?php require APP_ROOT . '/views/inc/nav.php'; ?>
</div>

<div class="container center">
    <h1>Update post</h1>

    <form action="<?php echo URL_ROOT; ?>/mobiliers/update/<?php echo $data['mobilier']->mobilier_id ?>" method="POST">
        <div class="form-item">
            <input type="text" name="modele" value="<?php echo $data['mobilier']->modele ?>">
            <span class="invalidFeedback"><?php echo $data['modeleError']; ?></span>
        </div>

        <div class="form-item">
            <input type="text" name="couleur" value="<?php echo $data['mobilier']->couleur ?>">
            <span class="invalidFeedback"><?php echo $data['couleurError']; ?></span>
        </div>

        <div class="form-item">
            <input type="text" name="taille" value="<?php echo $data['mobilier']->taille ?>">
            <span class="invalidFeedback"><?php echo $data['tailleError']; ?></span>
        </div>

        <div class="form-item">
            <input type="text" name="type" value="<?php echo $data['mobilier']->type ?>">
            <span class="invalidFeedback"><?php echo $data['typeError']; ?></span>
        </div>

        <div class="form-item">
            <input type="text" name="price" value="<?php echo $data['mobilier']->price ?>">
            <span class="invalidFeedback"><?php echo $data['priceError']; ?></span>
        </div>

        <button class="btn green" name="submit" type="submit">Submit</button>
    </form>
</div>
