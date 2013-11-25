<?php
/**
 *
 */

namespace Accountancy\Features\CategoryManagement;

use Accountancy\Entity\Category;
use Accountancy\Features\FeatureException;
use Accountancy\Features\FeatureInterface;
use Accountancy\Gateway\CategoriesGatewayInterface;

/**
 * Class CreateCategory
 *
 * @package Accountancy\Features\AccountManagement
 */
class CreateCategory implements FeatureInterface
{
    /**
     * @var CategoriesGatewayInterface
     */
    protected $categories;

    /**
     * @param \Accountancy\Gateway\CategoriesGatewayInterface $categories
     *
     * @return $this
     */
    public function setCategories(CategoriesGatewayInterface $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @param Array $input
     *
     * @throws \Accountancy\Features\FeatureException
     * @return Array
     */
    public function run(Array $input)
    {
        if (trim($input['name']) == '') {
            throw new FeatureException("Category name can not be empty");
        }

        if ($this->categories->findCategoryByUserIdAndName($input['user_id'], $input['name']) instanceof Category) {
            throw new FeatureException(sprintf("Category '%s' already exists", $input['name']));
        }

        $category = new Category();

        $category->setUserId($input['user_id']);
        $category->setName($input['name']);

        $this->categories->addCategory($category);

        return array();
    }
}
