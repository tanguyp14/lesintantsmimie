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
        'rewrite'            => ['slug' => '/', 'with_front' => false],
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => ['title', 'thumbnail', 'editor'],
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

/**
 * 3 - Fix pour les URLs des instants a la racine
 */

// Flush les rewrite rules quand necessaire
add_action('init', 'TYLT_flush_rewrite_rules_once');
function TYLT_flush_rewrite_rules_once() {
    if (get_option('tylt_flush_rewrite_rules') !== 'done_v2') {
        flush_rewrite_rules();
        update_option('tylt_flush_rewrite_rules', 'done_v2');
    }
}

// Permettre aux instants d'etre resolus a la racine
add_filter('post_type_link', 'TYLT_instant_permalink', 10, 2);
function TYLT_instant_permalink($post_link, $post) {
    if ($post->post_type === 'instant') {
        return home_url('/' . $post->post_name . '/');
    }
    return $post_link;
}

// Parser les URLs racine pour les instants et les pages
// On utilise le filtre 'request' (avant parse_query) pour intercepter les query vars brutes
add_filter('request', 'TYLT_instant_query_fix');
function TYLT_instant_query_fix($query_vars) {
    // Le query_var du CPT 'instant' est présent quand la règle de réécriture a capturé l'URL
    if (!isset($query_vars['instant']) && !isset($query_vars['name'])) {
        return $query_vars;
    }

    $slug = $query_vars['instant'] ?? $query_vars['name'] ?? '';

    if (!$slug) {
        return $query_vars;
    }

    global $wpdb;

    // Les instants ont la priorité
    $instant_id = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type = 'instant' AND post_status = 'publish'",
        $slug
    ));

    if ($instant_id) {
        $query_vars['post_type'] = 'instant';
        $query_vars['name']      = $slug;
        unset($query_vars['instant'], $query_vars['pagename']);
        return $query_vars;
    }

    // Pas un instant : vérifier si c'est une page
    $page_id = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type = 'page' AND post_status = 'publish'",
        $slug
    ));

    if ($page_id) {
        $query_vars['pagename'] = $slug;
        unset($query_vars['instant'], $query_vars['name'], $query_vars['post_type']);
    }

    return $query_vars;
}

