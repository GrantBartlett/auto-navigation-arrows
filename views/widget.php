<?php
$args = array(
	'sort_order'  => 'ASC',
	'sort_column' => 'menu_order',
	'post_type'   => 'page',
	'post_status' => 'publish'
);

$links = new AutoNavigationArrows();
$links->setConfigureLinks( $args );

?>

<?php foreach ( $links->getPrevNextLinks() as $k => $v ) : ?>

	<a href="<?php echo get_permalink( $v ); ?>" title="<?php echo get_the_title( $v ); ?>"><?php echo get_the_title( $v ); ?></a>

<?php endforeach; ?>


