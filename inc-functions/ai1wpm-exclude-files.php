<?php
/**
 * All In One WP Migration: exclude node_modules folder from export files
 *
 * Change 'your-theme-name' with the real name of your theme folder
 * save this file inside your 'inc' folder and require it inside 'functions.php'
 *
 * @package le_tengu_starter
 */
function mb_ai1wm_exclude_node_modules($exclude_filters) {
  $exclude_filters[] = 'le_tengu_starter/node_modules';
  return $exclude_filters;
}

add_filter('ai1wm_exclude_themes_from_export', 'mb_ai1wm_exclude_node_modules');