<?php
/*
Plugin Name: BCApp
Plugin URI: https://edulibtech-devloppers.github.io/.github/
Description: Gestion de bibliothèque pour les utilisateurs et les livres, avec des fonctionnalités de gestion et de tri.
Version: 1.0.0
Author: EduLibTech
Author URI: https://edulibtech-devloppers.github.io/.github/
License: GNU General Public License v3.0
*/

// Sécuriser l'accès direct au fichier
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Inclure les fichiers nécessaires
require_once plugin_dir_path( __FILE__ ) . 'src/includes/class-books.php';
require_once plugin_dir_path( __FILE__ ) . 'src/includes/class-users.php';
require_once plugin_dir_path( __FILE__ ) . 'src/includes/class-management.php';

// Initialiser le plugin
function bcapp_init() {
    // Enregistrement des pages
    add_menu_page( 'BCApp', 'BCApp', 'manage_options', 'bcapp', 'bcapp_books_page' );
    add_submenu_page( 'bcapp', 'Les livres', 'Les livres', 'manage_options', 'bcapp', 'bcapp_books_page' );
    add_submenu_page( 'bcapp', 'Mes Livres', 'Mes Livres', 'read', 'bcapp-my-books', 'bcapp_my_books_page' );
    add_submenu_page( 'bcapp', 'Gestion', 'Gestion', 'manage_options', 'bcapp-management', 'bcapp_management_page' );
}

// Fonction pour afficher la page "Les livres"
function bcapp_books_page() {
    include plugin_dir_path( __FILE__ ) . 'src/templates/books-template.php';
}

// Fonction pour afficher la page "Mes Livres"
function bcapp_my_books_page() {
    include plugin_dir_path( __FILE__ ) . 'src/templates/my-books-template.php';
}

// Fonction pour afficher la page "Gestion"
function bcapp_management_page() {
    include plugin_dir_path( __FILE__ ) . 'src/templates/management-template.php';
}

// Hook pour initialiser le plugin
add_action( 'admin_menu', 'bcapp_init' );

// Chargement des fichiers de langue
function bcapp_load_textdomain() {
    load_plugin_textdomain( 'bcapp', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'bcapp_load_textdomain' );
?>