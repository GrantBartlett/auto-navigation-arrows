<?php

/***
 * Frontend public face of plugin
 */

$args = array(
	'sort_order'  => 'ASC',
	'sort_column' => 'menu_order',
	'post_type'   => 'page',
	'post_status' => 'publish'
);

$links = new AutoNavigationArrows();
$links->setConfigureLinks( $args );
?>

<?php foreach ( $links->getPrevNextLinks() as $linkType => $id ) : ?>
	<div class="fixed-navigation <?php echo $linkType; ?>">
		<a href="<?php echo get_permalink( $id ); ?>" title="<?php echo get_the_title( $id ); ?>"><?php echo get_the_title( $id ); ?></a>
	</div>
<?php endforeach; ?>