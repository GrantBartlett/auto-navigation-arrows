<?php

// Instantiate new class
$navArrows = new AutoNavigationArrows();

// Custom page arguments
$args = array(
    'sort_order'   => 'ASC',
    'sort_column'  => 'menu_order',
    'hierarchical' => 1,
    'exclude'      => '',
    'include'      => '',
    'meta_key'     => '',
    'meta_value'   => '',
    'authors'      => '',
    'child_of'     => 0,
    'parent'       => - 1,
    'exclude_tree' => '',
    'number'       => '',
    'offset'       => '0',
    'post_type'    => 'page',
    'post_status'  => 'publish'
);

$navArrows->setConfigureLinks($args);
$current = array_search(get_the_ID(), $navArrows->getConfigureLinks());

echo $navArrows->getConfigureLinks($current);


?>

<style>
    .fixed-navigation {
        display: none!important; /*annoying as hell */
    }
</style>