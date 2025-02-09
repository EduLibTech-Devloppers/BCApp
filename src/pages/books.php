<?php
// Vérifie si l'utilisateur est connecté
if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

// Inclut les classes nécessaires
require_once(dirname(__FILE__) . '/../includes/class-books.php');
require_once(dirname(__FILE__) . '/../includes/class-users.php');

// Instancie les classes
$books = new Books();
$users = new Users();

// Récupère les livres
$all_books = $books->get_all_books();

// Gère le tri et le filtrage
$filter_type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
$sort_order = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : '';

// Applique le filtre et le tri
$filtered_books = $books->filter_and_sort_books($all_books, $filter_type, $sort_order);

// Inclut le modèle pour afficher les livres
include(dirname(__FILE__) . '/../templates/books-template.php');
?>