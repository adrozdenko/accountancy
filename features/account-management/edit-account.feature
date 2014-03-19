Feature: Edit Account
    In order to have a possibility to modify existing Accounts
    As a User
    I want to be able to edit them

    Scenario Outline: I edit account and provide invalid data
        Given there are registered Users:
            | id  | email              | name   |
            | "1" | "foo@example.com"  | "foo"  |
            | "2" | "bar@example.com"  | "bar"  |

        And there are Accounts:
            | id  | user_id | name  | balance | currency_id |
            | "1" | "1"     | "Foo" | "13.50" | "1"         |
            | "2" | "1"     | "Bar" | "13.50" | "1"         |
            | "3" | "2"     | "Baz" | "13.50" | "1"         |

        And I am signed in as User with Id "1"

        When I edit Account <account-id>, set name to <account-name>

        Then I should receive <error-message> error

        And Accounts should be:
            | id  | user_id | name  | balance | currency_id |
            | "1" | "1"     | "Foo" | "13.50" | "1"         |
            | "2" | "1"     | "Bar" | "13.50" | "1"         |
            | "3" | "2"     | "Baz" | "13.50" | "1"         |

    Examples:
        | account-id | account-name | error-message                      |
        | "1"        | "Bar"        | "Account 'Bar' already exists"     |
        | "1"        | "   "        | "Name of Account can not be empty" |
        | "1"        | ""           | "Name of Account can not be empty" |
        | "10050"    | "Baz"        | "Account doesn't exist"            |
        | "3"        | "Baz"        | "Account doesn't exist"            |
