<?php if ( isset( $post ) ): ?>
	<h2><?= Tools::encode( $post->title ) ?></h2>
	<p><?= Tools::encode( $post->body ) ?></p>
	<p><?= Tools::encode( $post->view) ?></p>
	<small><?= Tools::encode( $post->created_at ) ?></small>
<?php endif; ?>

