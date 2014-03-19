<?php
/**
 *
 */

namespace Accountancy\Gateway;

use Accountancy\Entity\Category;

/**
 * Interface CategoriesGatewayInterface
 *
 * @package Accountancy\Gateway
 */
interface CategoriesGatewayInterface
{
    /**
     * @param Category $category
     *
     * @return mixed
     */
    public function addCategory(Category $category);

    /**
     * @param Category $category
     *
     * @return mixed
     */
    public function updateCategory(Category $category);

    /**
     * @param integer $userId
     * @param string  $name
     *
     * @return mixed
     */
    public function findCategoryByUserIdAndName($userId, $name);

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function deleteCategory($id);

    /**
     * @param integer $id
     *
     * @return Category
     */
    public function findCategoryById($id);
}
