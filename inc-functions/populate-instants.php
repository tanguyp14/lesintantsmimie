<?php
/**
 * Preremplir le CPT Instants avec les donnees par defaut
 * A executer une seule fois via ?populate_instants=1 en etant admin
 */

add_action('admin_init', 'TYLT_populate_instants');
function TYLT_populate_instants() {
    if (!isset($_GET['populate_instants']) || !current_user_can('manage_options')) {
        return;
    }

    // Verifier si deja execute
    if (get_option('tylt_instants_populated')) {
        wp_die('Les instants ont deja ete crees.');
    }

    $instants = [
        [
            'title' => 'Instant Amour eternel',
            'description' => 'Un accompagnement a la hauteur du plus beau jour de votre vie',
            'tags' => ['Mariage'],
            'color' => '#E5AB63',
        ],
        [
            'title' => 'Instant Celebration',
            'description' => 'Toutes les etapes de la vie meritent d\'etre fetees',
            'tags' => ['Anniversaire', 'Bapteme', 'Fete privee'],
            'color' => '#E5AB63',
        ],
        [
            'title' => 'Instant Evasion',
            'description' => 'Accessible a tous, seul ou a plusieurs',
            'tags' => ['Deconnexion', 'Escapade'],
            'color' => '#E5AB63',
        ],
        [
            'title' => 'Instant Festif',
            'description' => 'Une experience sur mesure pour vos groupes',
            'tags' => ['Aventure', 'Detente', 'Surprise'],
            'color' => '#E5AB63',
        ],
    ];

    foreach ($instants as $instant) {
        // Creer le post
        $post_id = wp_insert_post([
            'post_title'  => $instant['title'],
            'post_type'   => 'instant',
            'post_status' => 'publish',
        ]);

        if ($post_id && !is_wp_error($post_id)) {
            // Ajouter la description courte
            update_field('description_courte', $instant['description'], $post_id);

            // Ajouter les tags
            if (!empty($instant['tags'])) {
                wp_set_post_terms($post_id, $instant['tags'], 'post_tag');
            }
        }
    }

    // Marquer comme execute
    update_option('tylt_instants_populated', true);

    wp_die('4 instants ont ete crees avec succes ! <a href="' . admin_url('edit.php?post_type=instant') . '">Voir les instants</a>');
}
