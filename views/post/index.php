<?php

use App\Model\{Category, Post};
use App\Connection;
use App\PaginatedQuery;

$title = 'Mon Blog';
$pdo = Connection::getPDO();

$paginatedQuery = new PaginatedQuery(
        "SELECT * FROM post ORDER BY created_at DESC",
        "SELECT COUNT(id) FROM post");

$posts = $paginatedQuery->getItems(Post::class);
$postsByID = [];
foreach ($posts as $post) {
    $postsByID[$post->getID()] = $post;
}

$implodeId = implode(",",array_keys($postsByID));

$categories = $pdo
    ->query("SELECT c.*, pc.post_id 
                                    FROM post_category pc 
                                    JOIN category c ON c.id = pc.category_id 
                                    WHERE pc.post_id IN ($implodeId)")
    ->fetchAll(PDO::FETCH_CLASS, Category::class);

foreach ($categories as $category) {
    $postsByID[$category->getPostID()]->addCategory($category);
};

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