<?php
/**
 *
 */

namespace Accountancy;

use Accountancy\Entity\Category;
use Behat\Gherkin\Node\TableNode;
use Accountancy\Features\CategoryManagement\CreateCategory;
use Accountancy\Features\CategoryManagement\DeleteCategory;
use Accountancy\Features\CategoryManagement\EditCategory;

trait CategoryTrait
{
    /**
     * @param TableNode $categoriesTable
     *
     * @Given /^I have Categories:$/
     */
    public function iHaveCategories(TableNode $categoriesTable)
    {
        foreach ($categoriesTable->getHash() as $row) {
            $category = new Category();

            if (isset($row['id'])) {
                $category->setId($row['id']);
            }

            if (isset($row['name'])) {
                $category->setName($row['name']);
            }

            $this->user->getCategories()->addCategory($category);
        }
    }

    /**
     * @param TableNode $categoriesTable
     *
     * @Then /^My Categories should be:$/
     */
    public function myCategoriesShouldBe(TableNode $categoriesTable)
    {
        $categoriesByName = array();
        foreach ($this->user->getCategories()->getCategories() as $category) {
            $categoriesByName[$category->getName()] = $category;
        }

        foreach ($categoriesTable->getHash() as $row) {
            assertArrayHasKey("name", $row, "'name' field must be present in 'My Categories should be' table");
            assertArrayHasKey($row['name'], $categoriesByName, sprintf("Category with name '%s' doesn't exist", $row['name']));
            $category = $categoriesByName[$row['name']];


            if (isset($row['id'])) {
                assertEquals($row['id'], $category->getId(), sprintf("Id does not match for category '%s'", $row['name']));
            }

            if (isset($row['name'])) {
                assertEquals($row['name'], $category->getName(), sprintf("Name does not match for category '%s'", $row['name']));
            }
        }

        $expected = count($categoriesTable->getHash());
        $actual = count($categoriesByName);
        assertEquals($expected, $actual, sprintf("Expected %s categories, got %s", $expected, $actual));
    }

    /**
     * @param string $name
     *
     * @When /^I create Category "([^"]*)"$/
     */
    public function iCreateCategory($name)
    {
        $feature = new CreateCategory();
        $feature->setUser($this->user)
            ->setCategoryName($name);

        try {
            $feature->run();
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
        $feature->setUser($this->user)
            ->setCategoryId($categoryId);

        try {
            $feature->run();
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
        $feature->setUser($this->user)
            ->setCategoryId($categoryId)
            ->setNewName($name);

        try {
            $feature->run();
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }
}
