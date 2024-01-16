<?php

class Category
{
    private $categoryid;
    private $categoryname;

    public function __construct(int $categoryid, string $categoryname)
    {
        $this->categoryid = $categoryid;
        $this->categoryname = $categoryname;
    }

    public function getCategoryid()
    {
        return $this->categoryid;
    }
    public function setCategoryid($categoryid): void
    {
        $this->categoryid = $categoryid;
    }
    public function getCategoryname()
    {
        return $this->categoryname;
    }
    public function setCategoryname($categoryname): void
    {
        $this->categoryname = $categoryname;
    }

}