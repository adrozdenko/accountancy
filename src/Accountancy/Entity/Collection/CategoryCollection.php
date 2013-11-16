<?php
/**
 *
 */

namespace Accountancy\Entity\Collection;

use Accountancy\Entity\Category;

/**
 * Class CategoryCollection
 *
 * @package Accountancy\Entity\Collection
 */
class CategoryCollection
{

    /**
     * @var Array
     */
    protected $categories = array();

    /**
     * @param Array $categories
     *
     * @return $this
     */
    public function setCategories(Array $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param Category $category
     *
     * @return $this
     */
    public function addCategory(Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * @param integer $categoryId
     *
     * @return null|Category
     */
    public function findCategoryById($categoryId)
    {
        foreach ($this->categories as $category) {

            if ($category->getId() === $categoryId) {
                return $category;
            }
        }

        return null;
    }

    /**
     * @param Category $category
     */
    public function updateCategories(Category $category)
    {
        foreach ($this->categories as $key => $value) {

            if ($value->getId() === $category->getId()) {
                $this->categories[$key] = $category;
            }
        }
    }

    /**
     * @param string $categoryName
     *
     * @return null|Category
     */
    public function findCategoryByName($categoryName)
    {

        foreach ($this->categories as $category) {

            if ($category->getName() === $categoryName) {
                return $category;
            }
        }

        return null;
    }

    /**
     * @param integer $categoryId
     *
     * @return $this
     */
    public function deleteCategory($categoryId)
    {
        $deleted = false;

        foreach ($this->categories as $key => $category) {

            if ($category->getId() === $categoryId) {
                unset($this->categories[$key]);
                $deleted = true;
                break;
            }
        }

        if (!$deleted) {
            throw new \LogicException("Category doesn't exist");
        }

        return $this;
    }
}
