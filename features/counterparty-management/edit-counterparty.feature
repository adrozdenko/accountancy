Feature: Edit Counterparty
    In order to have a possibility to modify Counterparties
    As a User
    I want to be able to edit them
    Background:
        Given there are registered Users:
            | id  | email              | name   |
            | "1" | "foo@example.com"  | "foo"  |
            | "2" | "bar@example.com"  | "bar"  |

        And there are Counterparties:
            | id  | user_id | name  |
            | "1" | "1"     | "Foo" |
            | "2" | "1"     | "Bar" |
            | "3" | "2"     | "Foo" |

        And I am signed in as User with Id "1"

    Scenario: I edit Counterparty
        When I edit Counterparty "1", set name "Baz"

        Then I should not receive any error

        And Counterparties should be:
            | id  | user_id | name  |
            | "1" | "1"     | "Baz" |
            | "2" | "1"     | "Bar" |
            | "3" | "2"     | "Foo" |

    Scenario Outline: I edit Counterparty and provide invalid data
        When I edit Counterparty <counterparty-id>, set name <name>

        Then I should receive <error-message> error

        And Counterparties should be:
            | id  | user_id | name  |
            | "1" | "1"     | "Foo" |
            | "2" | "1"     | "Bar" |
            | "3" | "2"     | "Foo" |

    Examples:
        | counterparty-id | name  | error-message                           |
        | "1"             | ""    | "Name of Counterparty can not be empty" |
        | "1"             | "  "  | "Name of Counterparty can not be empty" |
        | "100500"        | "Bar" | "Counterparty doesn't exist"            |
        | "3"             | "Bar" | "Counterparty doesn't exist"            |
