<?php

function type_post_materiais()
{
    $labels = array(
        'name' => _x('Materiais', 'post type general name'),
        'singular_name' => _x('Materiais', 'post type singular name'),
        'add_new' => _x('Adicionar Novo', 'Novo item'),
        'add_new_item' => __('Novo Material'),
        'edit_item' => __('Editar Material'),
        'new_item' => __('Novo Material'),
        'view_item' => __('Ver Material'),
        'search_items' => __('Procurar Materiais'),
        'not_found' => __('Nenhum material encontrado'),
        'not_found_in_trash' => __('Nenhum material encontrado na lixeira'),
        'parent_item_colon' => '',
        'menu_name' => 'Materiais'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_position' => 5,
        'public_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-media-text',
        'supports' => array('title', 'thumbnail')
    );

    register_post_type('materiais', $args);
    //flush_rewrite_rules();
}

add_action('init', 'type_post_materiais');

//register_taxonomy(
//    "categorias",
//    "materiais",
//    array(
//        "label" => "Categorias",
//        "singular_label" => "Categoria",
//        "rewrite" => true,
//        "hierarchical" => true
//    )
//);