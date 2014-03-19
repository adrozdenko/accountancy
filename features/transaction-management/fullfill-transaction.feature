Feature: Register Fulfill
    In order to start work with the system
    As a User
    I want to be able add initial funds to my Accounts

    Background:
        Given there are registered Users:
            | id  | email             | name  |
            | "1" | "foo@example.com" | "Foo" |
            | "2" | "bar@example.com" | "Bar" |

        And there are Accounts:
            | id  | user_id | name  | balance | currency_id |
            | "1" | "1"     | "Foo" | "0.00"  | "1"         |
            | "2" | "2"     | "Foo" | "0.00"  | "1"         |

        And I am signed in as User with Id "1"

    Scenario: I add initial funds to my Account
        When I add "5.14" funds of currency "1" to Account "1"

        Then I should not receive any error

        And Accounts should be:
            | id  | user_id | name  | balance | currency_id |
            | "1" | "1"     | "Foo" | "5.14"  | "1"         |
            | "2" | "2"     | "Foo" | "0.00"  | "1"         |

    Scenario Outline: I add funds to Account that doesn’t belong to me or invalid amount of money
        When I add <sum> funds of currency <currency-id> to Account <account-id>

        Then I should receive <error-message> error

        And Accounts should be:
            | id  | user_id | name  | balance | currency_id |
            | "1" | "1"     | "Foo" | "0.00"  | "1"         |
            | "2" | "2"     | "Foo" | "0.00"  | "1"         |

    Examples:
        | sum     | account-id | currency-id | error-message                                 |
        | "5.01"  | "10050"    | "1"         | "Account doesn't exist"                       |
        | "5.01"  | "2"        | "1"         | "Account doesn't exist"                       |
        | "-5.10" | "1"        | "1"         | "Amount of money should be greater than zero" |
        | "0.00"  | "1"        | "1"         | "Amount of money should be greater than zero" |
        | "5.01"  | "1"        | "2"         | "Currency is't supported by account"          |
