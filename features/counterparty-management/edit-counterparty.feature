Feature: Edit Counterparty
In order to have a possibility to modify Counterparties
As a User
I want to be able to edit them
    Scenario: I edit Counterparty
        Given I have Counterparties:
        | id | name  |
        | 1  | "Foo" |

        When I edit Counterparty 1, set name "Bar"
        Then my Counterparties should be:
        | id | name  |
        | 1  | "Bar" |

    Scenario Outline: I edit Counterparty and provide invalid data
        Given I have Counterparties:
        | id | name  |
        | 1  | "Foo" |
        When I edit Counterparty <counterparty-id>, set name <name>
        Then I should receive <error-message> error
        And my Counterparties should be:
        | id | name  |
        | 1  | "Foo" |
        Examples:
        | counterparty-id | name  | error-message                           |
        | 1               | ""    | "Name of Counterparty can not be empty" |
        | 1               | "  "  | "Name of Counterparty can not be empty" |
        | 100500          | "Bar" | "Counterparty doesn't exist"            |
