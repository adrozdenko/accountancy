<?php
/**
 *
 */

namespace Accountancy;

use Accountancy\Entity\Category;
use Accountancy\Gateway\InMemory\CategoriesGateway;
use Behat\Gherkin\Node\TableNode;
use Accountancy\Features\CategoryManagement\CreateCategory;
use Accountancy\Features\CategoryManagement\DeleteCategory;
use Accountancy\Features\CategoryManagement\EditCategory;

trait CategoryTrait
{
    /**
     * @var CategoriesGatewayInterafce
     */
    protected $categories;

    /**
     * @return \Accountancy\Gateway\CategoriesGatewayInterafce
     */
    public function getCategoriesGateway()
    {
        if ($this->categories === null) {
            $this->categories = new CategoriesGateway();
        }

        return $this->categories;
    }

    /**
     * @param TableNode $categoriesTable
     *
     * @Given /^there are Categories:$/
     */
    public function thereAreCategories(TableNode $categoriesTable)
    {
        foreach ($categoriesTable->getHash() as $row) {
            foreach ($row as $key => $value) {
                $row[$key] = substr($value, 1, -1);
            }

            $user = $this->getUsersGateway()->findUserById($row['user_id']);
            assertInstanceOf('\\Accountancy\\Entity\\User', $user, sprintf("Categories should match to registered users, user '%s' not found", $row['user_id']));

            $category = new Category();

            if (isset($row['id'])) {
                $category->setId($row['id']);
            }

            if (isset($row['user_id'])) {
                $category->setUserId($row['user_id']);
            }

            if (isset($row['name'])) {
                $category->setName($row['name']);
            }

            $this->getCategoriesGateway()->addCategory($category);
        }
    }


    /**
     * @param TableNode $categoriesTable
     *
     * @Then /^Categories should be:$/
     */
    public function categoriesShouldBe(TableNode $categoriesTable)
    {
        foreach ($categoriesTable->getHash() as $row) {
            foreach ($row as $key => $value) {
                $row[$key] = substr($value, 1, -1);
            }

            assertArrayHasKey("name", $row, "'name' field must be present in 'Categories should be' table");
            assertArrayHasKey("user_id", $row, "'user_id' field must be present in 'Categories should be' table");
            $category = $this->getCategoriesGateway()->findCategoryByUserIdAndName($row['user_id'], $row['name']);
            assertInstanceOf("\\Accountancy\\Entity\\Category", $category, sprintf("Category with name '%s' doesn't exist", $row['name']));

            if (isset($row['id'])) {
                assertEquals($row['id'], $category->getId(), sprintf("Id does not match for category '%s'", $row['name']));
            }

            if (isset($row['user_id'])) {
                assertEquals($row['user_id'], $category->getUserId(), sprintf("userId does not match for category '%s'", $row['name']));
            }

            if (isset($row['name'])) {
                assertEquals($row['name'], $category->getName(), sprintf("Name does not match for category '%s'", $row['name']));
            }
        }
    }

    /**
     * @param string $name
     *
     * @When /^I create Category "([^"]*)"$/
     */
    public function iCreateCategory($name)
    {
        $feature = new CreateCategory();
        $feature->setCategories($this->getCategoriesGateway());

        try {
            $output = $feature->run(array(
                'user_id' => $this->signedInUserId,
                'name' => $name,
            ));
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @param int $categoryId
     *
     * @When /^I delete Category "([^"]*)"$/
     */
    public function iDeleteCategory($categoryId)
    {
        $feature = new DeleteCategory();
        $feature->setCategories($this->getCategoriesGateway());

        try {
            $output = $feature->run(array(
                'user_id' => $this->signedInUserId,
                'id' => $categoryId,
            ));
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @param int    $categoryId
     * @param string $name
     *
     * @When /^I edit Category "([^"]*)", set name to "([^"]*)"$/
     */
    public function iEditCategorySetNameTo($categoryId, $name)
    {
        $feature = new EditCategory();
        $feature->setCategories($this->getCategoriesGateway());

        try {
            $output = $feature->run(array(
                'user_id' => $this->signedInUserId,
                'id' => $categoryId,
                'name' => $name,
            ));
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }
}
