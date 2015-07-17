<?php
/**
 * Post type : banners
 */
function banners_init() {
  $labels = array(
    'name'               => 'Banners',
    'singular_name'      => 'Banner',
    'add_new'            => 'Adicionar Novo',
    'add_new_item'       => 'Adicionar novo Banner',
    'edit_item'          => 'Editar Banner',
    'new_item'           => 'Novo Banner',
    'all_items'          => 'Todos os banners',
    'view_item'          => 'Ver Banner',
    'search_items'       => 'Buscar banners',
    'not_found'          => 'N&atilde;o encontrado',
    'not_found_in_trash' => 'N&atilde;o encontrado',
    'parent_item_colon'  => '',
    'menu_name'          => 'Slider'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    //'taxonomies'        => array('post_tag'),
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => '' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => true,
    'menu_position'      => 4,
    'supports'           => array( 'title' )
  );

  register_post_type( 'banners', $args );
}
add_action( 'init', 'banners_init' );

?>