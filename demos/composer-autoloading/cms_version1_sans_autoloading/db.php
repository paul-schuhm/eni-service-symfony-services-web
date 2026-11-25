<?php

require_once './src/Models/User.php';
require_once './src/Models/Post.php';


/**
 * Liste des users en base
 */
$users = [
    new User("John", "Doe"), # id 1
    new User("Jane", "Doe"), # id 2
];

/**
 * Liste des posts en base
 */
$posts = [
    new Post("post-a", "Article A", new DateTimeImmutable("2026-11-01"), 1),
    new Post("post-b", "Article B", new DateTimeImmutable("2026-11-02"), 2),
    new Post("post-c", "Article C", new DateTimeImmutable("2026-11-03"), 1),
    new Post("post-d", "Article D", new DateTimeImmutable("2026-11-04"), 2),
    new Post("post-e", "Article E", new DateTimeImmutable("2026-11-05"), 1),
    new Post("post-f", "Article F", new DateTimeImmutable("2026-11-06"), 2)
];
