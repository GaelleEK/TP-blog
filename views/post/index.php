<?php

use App\Model\Post;
use App\Connection;
use App\PaginatedQuery;



$title = 'Mon Blog';
$pdo = Connection::getPDO();

$paginatedQuery = new PaginatedQuery(
        "SELECT * FROM post ORDER BY created_at DESC",
        "SELECT COUNT(id) FROM post");

$posts = $paginatedQuery->getItems(Post::class);


$link = $router->url('home');

?>

    <h1>Mon blog</h1>

    <div class="row">
        <?php foreach ($posts as $post): ?>
        <div class="col-md-3">
            <?php require 'card.php' ?>
        </div>
        <?php endforeach; ?>
    </div>

<div class="d-flex justifiy-content-between my-4">
    <?= $paginatedQuery->previousLink($link) ?>
    <?= $paginatedQuery->nextLink($link) ?>
</div>