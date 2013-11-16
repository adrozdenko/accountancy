<?php
/**
 *
 */

namespace Accountancy\Features\CategoryManagement;


use Accountancy\Entity\User;
use Accountancy\Features\FeatureException;

/**
 * Class DeleteCategory
 *
 * @package Accountancy\Features\AccountManagement
 */
class DeleteCategory
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var int
     */
    protected $categoryId;

    /**
     * @param int $categoryId
     *
     * @return $this
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = (int) $categoryId;

        return $this;
    }

    /**
     * @param \Accountancy\Entity\User $user
     *
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @throws \Accountancy\Features\FeatureExceptions
     */
    public function run()
    {
        try {
            $this->user->getCategories()->deleteCategory($this->categoryId);
        } catch (\LogicException $e) {
            throw new FeatureException("Category does not exist");
        }
    }
}
