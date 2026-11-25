<?php
declare(strict_types=1);

//Charger l'autoloader (contenu de src)
require './vendor/autoload.php';
require_once './db.php';

use Ps\App\Models\Post;

// Gestion globale des exceptions non interceptées (pas de fuite de stack trace)
set_exception_handler(function (Throwable $e): void {
    error_log((string) $e);
    json_error(500, 'Erreur interne du serveur.');
});

//Une fonction pour comparer les posts par date de publication (du plus au moins récent)
function cmp_posts_by_date(Post $a, Post $b)
{
    if ($a->date_publication == $b->date_publication)
        return 0;
    return $a->date_publication > $b->date_publication ? -1 : 1;
}

/**
 * Envoie une réponse JSON et termine le script.
 */
function json_response(array $payload, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(
        $payload,
        JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    );
    exit;
}

function json_error(int $status, string $message, array $details = []): never
{
    json_response([
        'error' => [
            'message' => $message,
            'details' => $details,
        ],
    ], $status);
}

// Retourne lien de pagination
function provide_link(int $page_id): string {
    return '?' . http_build_query(['page' => $page_id]);
}

/* DEBUT DU SCRIPT */

// Méthode HTTP
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Allow: GET');
    json_error(405, 'Méthode non autorisée.');
}

// Pagination : validation stricte des paramètres
$page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1],
    'flags'   => FILTER_NULL_ON_FAILURE,
]);

if ($page === NULL && isset($_GET['page'])) {
    json_error(400, 'Paramètre invalide.', ['page' => 'Doit être un entier >= 1.']);
}

$page ??= 1;
$perPage = POSTS_PER_PAGE;
$total      = count($posts);
$totalPages = max(1, (int) ceil($total / $perPage));

if ($page > $totalPages) {
    json_error(404, 'Page introuvable.', ['page' => $page, 'total_pages' => $totalPages]);
}

//Tri du plus récent au plus ancien
usort($posts, "cmp_posts_by_date");
// Ou avec le "spaceship operator <=>" (@see https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.spaceship-op)
// usort($posts, fn(Post $a, Post $b) => $b->date_publication <=> $a->date_publication);

$data = array_slice($posts, ($page - 1) * $perPage, $perPage);

json_response([
    'data' => $data, // Post::jsonSerialize()
    'meta' => [
        'page'        => $page,
        'per_page'    => $perPage,
        'total'       => $total,
        'total_pages' => $totalPages,
    ],
    'links' => [
        'self' => provide_link($page),
        'prev' => $page > 1 ? provide_link($page - 1) : NULL,
        'next' => $page < $totalPages ? provide_link($page + 1) : NULL,
    ],
]);
