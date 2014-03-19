<?php
/**
 *
 */

namespace Accountancy;

use Accountancy\Features\CounterpartyManagement\EditCounterparty;
use Accountancy\Features\CounterpartyManagement\DeleteCounterparty;
use Accountancy\Features\CounterpartyManagement\CreateCounterparty;
use Accountancy\Entity\Counterparty;
use Accountancy\Gateway\CounterpartiesGatewayInterface;
use Accountancy\Gateway\InMemory\CounterpartiesGateway;
use Behat\Gherkin\Node\TableNode;

trait CounterpartyTrait
{
    /**
     * @var CounterpartiesGatewayInterface
     */
    private $counterparties;

    /**
     * @return CounterpartiesGatewayInterface
     */
    public function getCounterpartiesGateway()
    {
        if ($this->counterparties === null) {
            $this->counterparties = new CounterpartiesGateway();
        }

        return $this->counterparties;
    }

    /**
     * @param TableNode $counterpartiesTable
     *
     * @Given /^there are Counterparties:$/
     */
    public function thereAreCounterparties(TableNode $counterpartiesTable)
    {
        foreach ($counterpartiesTable->getHash() as $row) {
            foreach ($row as $key => $value) {
                $row[$key] = substr($value, 1, -1);
            }

            $user = $this->getUsersGateway()->findUserById($row['user_id']);
            assertInstanceOf('\\Accountancy\\Entity\\User', $user, sprintf("Counterparties should match to registered users, user '%s' not found", $row['user_id']));

            $counterparty = new Counterparty();

            if (isset($row['id'])) {
                $counterparty->setId($row['id']);
            }

            if (isset($row['user_id'])) {
                $counterparty->setUserId($row['user_id']);
            }

            if (isset($row['name'])) {
                $counterparty->setName($row['name']);
            }

            $this->getCounterpartiesGateway()->addCounterparty($counterparty);
        }


    }

    /**
     * @param string $name
     *
     * @When /^I create Counterparty with Name "([^"]*)"$/
     */
    public function iCreateCounterpartyWithName($name)
    {
        $feature = new CreateCounterparty();
        $feature->setCounterparties($this->getCounterpartiesGateway());

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
     * @param TableNode $counterpartiesTable
     *
     * @Then /^Counterparties should be:$/
     */
    public function counterpartiesShouldBe(TableNode $counterpartiesTable)
    {
        foreach ($counterpartiesTable->getHash() as $row) {
            foreach ($row as $key => $value) {
                $row[$key] = substr($value, 1, -1);
            }

            assertArrayHasKey("name", $row, "'name' field must be present in 'Counterparties should be' table");
            assertArrayHasKey("user_id", $row, "'user_id' field must be present in 'Counterparties should be' table");
            $counterparty = $this->getCounterpartiesGateway()->findCounterpartyByUserIdAndName($row['user_id'], $row['name']);
            assertInstanceOf("\\Accountancy\\Entity\\Counterparty", $counterparty, sprintf("Counterparty with name '%s' doesn't exist", $row['name']));

            if (isset($row['id'])) {
                assertEquals($row['id'], $counterparty->getId(), sprintf("Id does not match for counterparty '%s'", $row['name']));
            }

            if (isset($row['user_id'])) {
                assertEquals($row['user_id'], $counterparty->getUserId(), sprintf("userId does not match for category '%s'", $row['name']));
            }

            if (isset($row['name'])) {
                assertEquals($row['name'], $counterparty->getName(), sprintf("Name does not match for counterparty '%s'", $row['name']));
            }
        }
    }

    /**
     * @param int $counterpartyId
     *
     * @When /^I delete Counterparty "([^"]*)"$/
     */
    public function iDeleteCounterparty($counterpartyId)
    {
        $feature = new DeleteCounterparty();
        $feature->setCounterparties($this->getCounterpartiesGateway());

        try {
            $output = $feature->run(array(
                'user_id' => $this->signedInUserId,
                'id' => $counterpartyId,
            ));
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @param int    $counterpartyId
     * @param string $name
     *
     * @When /^I edit Counterparty "([^"]*)", set name "([^"]*)"$/
     */
    public function iEditCounterpartySetName($counterpartyId, $name)
    {
        $feature = new EditCounterparty();
        $feature->setCounterparties($this->getCounterpartiesGateway());

        try {
            $output = $feature->run(array(
                'user_id' => $this->signedInUserId,
                'id' => $counterpartyId,
                'name' => $name,
            ));
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }
}
