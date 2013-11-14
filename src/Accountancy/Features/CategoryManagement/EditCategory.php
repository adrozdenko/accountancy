<?php
/**
 *
 */

namespace Accountancy\Features\CategoryManagement;

use Accountancy\Entity\User;
use Accountancy\Features\FeatureException;

/**
 * Class EditCategory
 *
 * @package Accountancy\Features\AccountManagement
 */
class EditCategory
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var integer
     */
    protected $categoryId;

    /**
     * @param integer $categoryId
     *
     * @return $this
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = (int) $categoryId;

        return $this;
    }

    /**
     * @param string $newName
     *
     * @return $this
     */
    public function setNewName($newName)
    {
        $this->newName = (string) $newName;

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

        $category = $this->user->findCategoryById($this->categoryId);

        if (is_null($category)) {
            throw new FeatureException("Category does not exist");
        }

        if (trim($this->newName) == '') {
            throw new FeatureException("Category name can not be empty");
        }

        $category->setName($this->newName);

        $categories = $this->user->getCategories();

        foreach ($categories as $key => $value) {

            if ($value->getId() === $this->categoryId) {
                $categories[$key] = $category;
            }
        }

        $this->user->setCategories($categories);
    }
}
