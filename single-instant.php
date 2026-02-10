<?php
/**
 * Template pour les singles Instants
 */

get_header();

// Récupérer les données
$instant_title = get_the_title();
$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
$current_id = get_the_ID();

// Récupérer tous les instants pour la navigation en boucle
$all_instants = get_posts([
    'post_type' => 'instant',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'fields' => 'ids'
]);

// Trouver l'index actuel
$current_index = array_search($current_id, $all_instants);
$total_instants = count($all_instants);

// Calculer prev/next avec boucle infinie
$prev_index = ($current_index - 1 + $total_instants) % $total_instants;
$next_index = ($current_index + 1) % $total_instants;

$prev_instant_id = $all_instants[$prev_index];
$next_instant_id = $all_instants[$next_index];

$prev_link = get_permalink($prev_instant_id);
$next_link = get_permalink($next_instant_id);
$prev_title = get_the_title($prev_instant_id);
$next_title = get_the_title($next_instant_id);
?>

<header class="instant-header" <?php if ($featured_image): ?>style="background-image: url('<?php echo esc_url($featured_image); ?>');"<?php endif; ?>>
    <div class="instant-header__overlay"></div>

    <!-- Navigation -->
    <?php if ($total_instants > 1): ?>
        <nav class="instant-header__navigation">
            <a href="<?php echo esc_url($prev_link); ?>" class="instant-header__nav instant-header__nav--prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                <span><?php echo esc_html($prev_title); ?></span>
            </a>
            <a href="<?php echo esc_url($next_link); ?>" class="instant-header__nav instant-header__nav--next">
                <span><?php echo esc_html($next_title); ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>
        </nav>
    <?php endif; ?>

    <h1 class="instant-header__title"><?php echo esc_html($instant_title); ?></h1>
</header>

<?php
the_content();

get_footer();
