<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Category.php';
class CategoryRepository extends Repository {
    public function getCategories(): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT categoryid, categoryname FROM public.categories
        ');
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new Exception("Can not receive categories");
        }

        $categories = [];

        foreach ($result as $row) {
            $category = new Category($row['categoryid'], $row['categoryname']);
            array_push($categories, $category);
        }
        return $categories;
    }
}