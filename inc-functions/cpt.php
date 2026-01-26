<?php
/**
 * CPT
 *
 * 1 - Instants
 * 2 - Masquer les articles par defaut
 */

/**
 * 1 - CPT Instants
 */
add_action('init', 'TYLT_register_instants_cpt');
function TYLT_register_instants_cpt() {

    $labels = [
        'name'                  => 'Instants',
        'singular_name'         => 'Instant',
        'menu_name'             => 'Instants',
        'name_admin_bar'        => 'Instant',
        'add_new'               => 'Ajouter',
        'add_new_item'          => 'Ajouter un instant',
        'new_item'              => 'Nouvel instant',
        'edit_item'             => 'Modifier l\'instant',
        'view_item'             => 'Voir l\'instant',
        'all_items'             => 'Tous les instants',
        'search_items'          => 'Rechercher un instant',
        'not_found'             => 'Aucun instant trouve',
        'not_found_in_trash'    => 'Aucun instant dans la corbeille',
        'featured_image'        => 'Image de l\'instant',
        'set_featured_image'    => 'Definir l\'image de l\'instant',
        'remove_featured_image' => 'Supprimer l\'image',
        'use_featured_image'    => 'Utiliser comme image de l\'instant',
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'instants'],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => ['title', 'thumbnail'],
        'taxonomies'         => ['post_tag'],
    ];

    register_post_type('instant', $args);
}

/**
 * 2 - Masquer les articles par defaut
 */
add_action('admin_menu', 'TYLT_hide_posts_menu');
function TYLT_hide_posts_menu() {
    remove_menu_page('edit.php');
}

// Masquer aussi dans la barre d'admin "+ Nouveau"
add_action('admin_bar_menu', 'TYLT_hide_posts_admin_bar', 999);
function TYLT_hide_posts_admin_bar($wp_admin_bar) {
    $wp_admin_bar->remove_node('new-post');
}

// Rediriger si quelqu'un tente d'acceder directement
add_action('admin_init', 'TYLT_redirect_posts_page');
function TYLT_redirect_posts_page() {
    global $pagenow;
    if ($pagenow === 'edit.php' && !isset($_GET['post_type'])) {
        wp_redirect(admin_url());
        exit;
    }
}
