<?php
// Modèle pour afficher les livres empruntés par l'utilisateur connecté

// Vérifier si l'utilisateur est connecté
if (!is_user_logged_in()) {
    echo '<p>Vous devez être connecté pour voir vos livres empruntés.</p>';
    return;
}

// Récupérer l'utilisateur actuel
$current_user = wp_get_current_user();
$user_id = $current_user->ID;

// Récupérer les livres empruntés par l'utilisateur
$borrowed_books = get_user_borrowed_books($user_id); // Fonction à définir dans class-users.php

if (empty($borrowed_books)) {
    echo '<p>Vous n\'avez emprunté aucun livre.</p>';
} else {
    echo '<h2>Mes Livres</h2>';
    echo '<table>';
    echo '<tr><th>Titre</th><th>Auteur</th><th>Date d\'emprunt</th><th>Date de retour</th></tr>';

    foreach ($borrowed_books as $book) {
        $due_date = $book->due_date;
        $is_overdue = (strtotime($due_date) < time()) ? true : false;

        echo '<tr' . ($is_overdue ? ' style="color:red;"' : '') . '>';
        echo '<td>' . esc_html($book->title) . '</td>';
        echo '<td>' . esc_html($book->author) . '</td>';
        echo '<td>' . esc_html(date('d/m/Y', strtotime($book->borrow_date))) . '</td>';
        echo '<td>' . esc_html(date('d/m/Y', strtotime($due_date))) . ' ' . ($is_overdue ? '⏲️' : '') . '</td>';
        echo '</tr>';
    }

    echo '</table>';
}
?>