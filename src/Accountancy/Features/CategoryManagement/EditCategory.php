<?php
/**
 *
 */

namespace Accountancy\Features\CategoryManagement;

use Accountancy\Features\FeatureException;
use Accountancy\Features\FeatureInterface;
use Accountancy\Gateway\CategoriesGatewayInterface;

/**
 * Class EditCategory
 *
 * @package Accountancy\Features\AccountManagement
 */
class EditCategory implements FeatureInterface
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
     * @return Array
     * @throws \Accountancy\Features\FeatureException
     */
    public function run(Array $input)
    {
        $category = $this->categories->findCategoryById($input['id']);

        if (is_null($category)) {
            throw new FeatureException("Category does not exist");
        }

        if ($category->getUserId() !== (int) $input['user_id']) {
            throw new FeatureException("Category does not exist");
        }

        if (trim($input['name']) == '') {
            throw new FeatureException("Category name can not be empty");
        }

        $category->setName($input['name']);

        $this->categories->updateCategory($category);

        return array();
    }
}
