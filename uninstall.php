<?php
// Ce fichier gère la désinstallation du plugin BCApp.

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Supprimer les options du plugin
delete_option('bcapp_options');

// Supprimer les tables personnalisées si elles existent
global $wpdb;
$table_name_books = $wpdb->prefix . 'bcapp_books';
$table_name_users = $wpdb->prefix . 'bcapp_users';

$wpdb->query("DROP TABLE IF EXISTS $table_name_books");
$wpdb->query("DROP TABLE IF EXISTS $table_name_users");

// Autres nettoyages nécessaires peuvent être ajoutés ici
?>