<?php
// Modèle pour afficher la liste des livres sur la page "Les livres"

function display_books($books) {
    if (empty($books)) {
        echo '<p>Aucun livre disponible.</p>';
        return;
    }

    echo '<div class="books-list">';
    foreach ($books as $book) {
        echo '<div class="book-item">';
        echo '<h3>' . esc_html($book->title) . '</h3>';
        echo '<p>Auteur : ' . esc_html($book->author) . '</p>';
        echo '<p>Type : ' . esc_html($book->type) . '</p>';
        echo '<p>Date de sortie : ' . esc_html($book->release_date) . '</p>';
        echo '<p>Description : ' . esc_html($book->description) . '</p>';
        echo '<p>ISBN : ' . esc_html($book->isbn) . '</p>';
        echo '<p>Code du livre : ' . esc_html($book->code) . '</p>';
        echo '<img src="' . esc_url($book->cover_front) . '" alt="Couverture avant" />';
        echo '<img src="' . esc_url($book->cover_back) . '" alt="Couverture arrière" />';
        echo '</div>';
    }
    echo '</div>';
}
?>