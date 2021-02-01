<?php require APP_ROOT . '/views/inc/head.php'; ?>
<div class="navbar dark">
    <?php require APP_ROOT . '/views/inc/nav.php' ?>
</div>

<div class="container center">
    <h1><?php echo $data['mobilier']->modele ?></h1>
    <p>Couleur : <?php echo $data['mobilier']->couleur ?> | Taille : <?php echo $data['mobilier']->taille ?> | Type : <?php echo $data['mobilier']->type ?></p>
    <p>Price : <?php echo $data['mobilier']->price ?> €</p>
    <p>Added at : <?php echo $data['mobilier']->added_at ?></p>
    <hr>
    <form action="<?php echo URL_ROOT; ?>/mobiliers/page/<?php echo $data['mobilier']->mobilier_id ?>" method="POST">
        <h1>Commentaires :</h1>
        <div class="form-item">
            <input type="text" name="pseudoComment" id="pseudoComment" placeholder="Pseudo">
            <span class="invalidFeedback">
				<?= $data['pseudoCommentError'] ?>
			</span>
        </div>
        <div class="form-item">
            <textarea name="textComment"></textarea>
        </div>

        <button class="btn green" name="submit" type="submit">Commenter</button>
    </form>

    <div class="container">
        <?php foreach($data['comments'] as $comment): ?>
            <div class="container-item">
                <p style="text-align:left;font-weight:900;font-size:1.6rem;color: #000;"><?php echo $comment->pseudo ?></p>
                <p style="text-align:left;"><?php echo $comment->text ?></p>
                <p style="text-align:right;"><?php echo $comment->created_at ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>