<?php if ( isset( $categories ) ): ?>
	<?php foreach ( $categories as $category ): ?>
		<p><?= Tools::encode( $category->name ) ?></p>
	<?php endforeach; ?>
<?php endif; ?>

