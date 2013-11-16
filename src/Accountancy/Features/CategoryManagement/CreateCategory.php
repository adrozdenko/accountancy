<?php
/**
 *
 */

namespace Accountancy\Features\CategoryManagement;

use Accountancy\Entity\Category;
use Accountancy\Entity\User;
use Accountancy\Features\FeatureException;

/**
 * Class CreateCategory
 *
 * @package Accountancy\Features\AccountManagement
 */
class CreateCategory
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var string
     */
    protected $categoryName;

    /**
     * @param string $categoryName
     *
     * @return $this
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = (string) $categoryName;

        return $this;
    }

    /**
     * @param \Accountancy\Entity\User $user
     *
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @throws \Accountancy\Features\FeatureException
     */
    public function run()
    {
        if (trim($this->categoryName) == '') {
            throw new FeatureException("Category name can not be empty");
        }

        if ($this->user->getCategories()->findCategoryByName($this->categoryName) instanceof Category) {
            throw new FeatureException(sprintf("Category '%s' already exists", $this->categoryName));
        }

        $category = new Category();

        $category->setName($this->categoryName);

        $this->user->getCategories()->addCategory($category);
    }
}
