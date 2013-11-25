<?php
/**
 *
 */

namespace Accountancy\Gateway\InMemory;

use Accountancy\Entity\Category;
use Accountancy\Gateway\CategoriesGatewayInterface;

/**
 * Class CategoriesGateway
 *
 * @package Accountancy\Gateway\InMemory
 */
class CategoriesGateway implements CategoriesGatewayInterface
{
    protected $categories = array();

    /**
     * @param Category $category
     *
     * @return mixed
     */
    public function addCategory(Category $category)
    {
        $id = count($this->categories) + 1;
        $category->setId($id);
        $this->categories[$id] = $category;
    }

    /**
     * @param Category $category
     *
     * @throws \LogicException
     * @return mixed
     */
    public function updateCategory(Category $category)
    {
        $id = (int) $category->getId();

        if ($id === 0) {
            throw new \LogicException("Category doesn't exist");
        }

        $this->categories[$id] = $category;
    }


    /**
     * @param integer $userId
     * @param string  $name
     *
     * @return mixed
     */
    public function findCategoryByUserIdAndName($userId, $name)
    {
        foreach ($this->categories as $category) {
            if ($category->getUserId() === (int) $userId && $category->getName() === (string) $name) {
                return clone $category;
            }
        }
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function deleteCategory($id)
    {
        if (isset($this->categories[(int) $id])) {
            unset($this->categories[(int) $id]);
        }
    }

    /**
     * @param integer $id
     *
     * @return Category
     */
    public function findCategoryById($id)
    {
        if (isset($this->categories[(int) $id])) {
            return clone $this->categories[(int) $id];
        }
    }
}
