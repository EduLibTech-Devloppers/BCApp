<?php
// Vérifie si l'utilisateur est connecté
if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

// Récupère l'utilisateur actuel
$current_user = wp_get_current_user();
$user_id = $current_user->ID;

// Inclut la classe des livres
require_once(dirname(__FILE__) . '/../includes/class-books.php');
$books_class = new Books();

// Récupère les livres empruntés par l'utilisateur
$borrowed_books = $books_class->get_borrowed_books($user_id);

get_header(); ?>

<div class="my-books">
    <h1>Mes Livres</h1>
    <?php if (!empty($borrowed_books)): ?>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Date d'emprunt</th>
                    <th>Date de retour</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($borrowed_books as $book): ?>
                    <tr class="<?php echo (strtotime($book->return_date) < time()) ? 'overdue' : ''; ?>">
                        <td><?php echo esc_html($book->title); ?></td>
                        <td><?php echo esc_html($book->author); ?></td>
                        <td><?php echo esc_html(date('d/m/Y', strtotime($book->borrow_date))); ?></td>
                        <td><?php echo esc_html(date('d/m/Y', strtotime($book->return_date))); ?>
                            <?php if (strtotime($book->return_date) < time()): ?>
                                <span class="overdue-icon">⏲️</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun livre emprunté.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>