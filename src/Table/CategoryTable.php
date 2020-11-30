<?php
namespace App\Table;
use PDO;
use App\Model\{Post, Category};

final class CategoryTable extends Table {

    protected $table = "category";
    protected $class = Category::class;

    /**
     * @param Post[] $posts
     */
    public function hydratePosts (array $posts): void
    {
        $postsByID = [];
        foreach ($posts as $post) {
            $post->setCategories([]);
            $postsByID[$post->getID()] = $post;
        }
        $implodeId = implode(',',array_keys($postsByID));
        $categories = $this->pdo
            ->query("SELECT c.*, pc.post_id 
                                    FROM post_category pc 
                                    JOIN category c ON c.id = pc.category_id 
                                    WHERE pc.post_id IN ($implodeId)")
            ->fetchAll(PDO::FETCH_CLASS, $this->class);
        foreach ($categories as $category) {
            $postsByID[$category->getPostID()]->addCategory($category);
        }
    }



    public function list (): array
    {
        $categories = $this->queryAndFetchAll("SELECT * FROM {$this->table} ORDER BY name ASC");
        $results = [];
        foreach ($categories as $category) {
            $results[$category->getID()] = $category->getName();
        }
        return $results;
    }

}