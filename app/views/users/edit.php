<?php require APP_ROOT . '/views/inc/head.php'; ?>
<div class="navbar dark">
    <?php require APP_ROOT . '/views/inc/nav.php' ?>
</div>

<div class="container">
    <h2>Edit profile</h2>

    <form
            id="edit-form"
            method="POST"
            action="<?php echo URL_ROOT; ?>/users/edit"
    >
        <input type="text" placeholder="Username *" name="username" value="<?php echo $data['user']->username ?>">
        <span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
            </span>

        <input type="text" placeholder="Nom *" name="nom" value="<?php echo $data['user']->nom ?>">
        <span class="invalidFeedback">
                <?php echo $data['nomError']; ?>
            </span>

        <input type="text" placeholder="Prénom *" name="prenom" value="<?php echo $data['user']->prenom ?>">
        <span class="invalidFeedback">
                <?php echo $data['prenomError']; ?>
            </span>

        <input type="text" placeholder="Adresse *" name="adresse" value="<?php echo $data['user']->adresse ?>">
        <span class="invalidFeedback">
                <?php echo $data['adresseError']; ?>
            </span>

        <input type="text" placeholder="Code Postal *" name="code_postal" value="<?php echo $data['user']->code_postal ?>">
        <span class="invalidFeedback">
                <?php echo $data['code_postalError']; ?>
            </span>

        <input type="email" placeholder="Email *" name="email" value="<?php echo $data['user']->email ?>">
        <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>

        <button id="submit" type="submit" value="submit">Edit</button>
    </form>
</div>