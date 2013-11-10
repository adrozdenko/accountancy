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
        if (empty($this->categoryName)) {
            throw new FeatureException("Category name can not be empty");
        }

        $category = new Category();

        if (is_null($this->user->findCategoryByName($this->categoryName))) {
            $category->setName($this->categoryName);
        } else {
            throw new FeatureException(sprintf("Category '%s' already exists", $this->categoryName));
        }

        $this->user->addCategory($category);
    }
}
