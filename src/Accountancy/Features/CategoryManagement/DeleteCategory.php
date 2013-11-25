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
 * Class DeleteCategory
 *
 * @package Accountancy\Features\AccountManagement
 */
class DeleteCategory implements FeatureInterface
{
    /**
     * @var CategoriesGatewayInterface
     */
    protected $categories;

    /**
     * @param \Accountancy\Gateway\CategoriesGatewayInterface $categories
     */
    public function setCategories(CategoriesGatewayInterface $categories)
    {
        $this->categories = $categories;
    }

    /**
     * @param Array $input
     *
     * @throws \Accountancy\Features\FeatureException
     * @return Array
     */
    public function run(Array $input)
    {
        $category = $this->categories->findCategoryById($input['id']);

        if (!$category instanceof Category) {
            throw new FeatureException("Category does not exist");
        }

        if ($category->getUserId() !== (int) $input['user_id']) {
            throw new FeatureException("Category does not exist");
        }

        $this->categories->deleteCategory($input['id']);

        return array();
    }
}
