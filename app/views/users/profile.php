<?php require APP_ROOT . '/views/inc/head.php'; ?>
<div class="navbar dark">
    <?php require APP_ROOT . '/views/inc/nav.php' ?>
</div>

<div class="container">
    <div class="profile">
        <p>Username : <?php echo $data['user']->username ?></p>
        <p>Nom : <?php echo $data['user']->nom ?></p>
        <p>Prénom : <?php echo $data['user']->prenom ?></p>
        <p>Adresse : <?php echo $data['user']->adresse ?></p>
        <p>Code postal : <?php echo $data['user']->code_postal ?></p>
        <p>Email : <?php echo $data['user']->email ?></p>

        <a href="<?php echo URL_ROOT; ?>/users/edit/<?php echo $_SESSION['user_id'] ?> ">Edit profile</a>
    </div>
</div>