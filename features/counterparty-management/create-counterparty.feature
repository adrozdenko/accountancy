Feature: Create Counterparty
    In order to have a possibility to distinguish my incomes and expenses
    As a User
    I want to be able to create Counterparties

    Background:
        Given there are registered Users:
            | id  | email              | name   |
            | "1" | "foo@example.com"  | "foo"  |

        And there are Counterparties:
            | id  | user_id | name  |
            | "1" | "1"     | "Foo" |

        And I am signed in as User with Id "1"

    Scenario: I create Counterparty

        When I create Counterparty with Name "Bar"

        Then I should not receive any error

        And Counterparties should be:
            | id  | user_id | name  |
            | "1" | "1"     | "Foo" |
            | "2" | "1"     | "Bar" |

    Scenario Outline: I create Counterparty with invalid data
        When I create Counterparty with Name <name>

        Then I should receive <error-message> error

        And Counterparties should be:
            | id  | user_id | name  |
            | "1" | "1"     | "Foo" |

    Examples:
        | name  | error-message                           |
        | "Foo" | "Counterparty 'Foo' already exists"     |
        | ""    | "Name of Counterparty can not be empty" |
        | "   " | "Name of Counterparty can not be empty" |
