<?php

declare(strict_types=1);

require_once './config.php';
require_once './db.php';


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

usort($posts, fn(Post $a, Post $b) => $b->date_publication <=> $a->date_publication);

$data = array_slice($posts, 0, POSTS_PER_PAGE);

json_response([
    'data'  => $data,
    'count' => count($posts),
]);
