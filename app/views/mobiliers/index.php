<?php
	require APP_ROOT . '/views/inc/head.php';
?>
<div class="navbar dark">
	<?php
		require APP_ROOT . '/views/inc/nav.php';
	?>
</div>

<div class="container">
	<?php if(isLoggedIn()): ?>
		<a class="btn green" href="<?php echo URL_ROOT; ?>/mobiliers/create">
			Create
		</a>
	<?php endif; ?>

    <div class="filters-select">
        <form action="<?php echo URL_ROOT; ?>/mobiliers" method="POST">
            <span>Filters</span>
            <select name="filters" id="">
                <option value=""></option>
                <?php foreach($data['filters'] as $filter): ?>
                    <option name="<?php echo $filter->type ?>"><?php echo $filter->type ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">select</button>
        </form>
    </div>

	<?php foreach($data['mobiliers'] as $post): ?>
		<div class="container-item">
			<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post->user_id): ?>
				<a
					class="btn orange"
					href="<?php echo URL_ROOT . "/mobiliers/update/" . $post->mobilier_id ?>">
					Update
				</a>
				
				<form action="<?php echo URL_ROOT . "/mobiliers/delete/" . $post->mobilier_id ?>" method="POST">
					<input type="submit" name="delete" value="Delete" class="btn red">
				</form>
			<?php endif; ?>

            <a href="<?php echo URL_ROOT . "/mobiliers/page/" . $post->mobilier_id ?>"><h2><?php echo $post->modele; ?></h2></a>
			<h3><?php echo 'Created on: ' . date('F j h:m', strtotime($post->added_at)) ?></h3>
			<p><?php echo 'Couleur : ' . $post->couleur . ' | ' . 'Taille : ' . $post->taille . ' | ' . 'Type : ' . $post->type ?></p>
            <p><?php echo 'Prix : ' . $post->price ?> €</p>
		</div>
	<?php endforeach; ?>
</div>