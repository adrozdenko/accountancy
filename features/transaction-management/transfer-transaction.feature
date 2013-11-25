Feature: Register Transfer
    In order to track my transfers
    As a User
    I want to be able register Transfer Transactions

    Background:
        Given there are registered Users:
            | id  | email             | name  |
            | "1" | "foo@example.com" | "Foo" |
            | "2" | "bar@example.com" | "Bar" |

        And there are Accounts:
            | id  | user_id | name  | balance  | currency_id |
            | "1" | "1"     | "Foo" | "15.14"  | "1"         |
            | "2" | "1"     | "Bar" | "10.00"  | "1"         |
            | "3" | "2"     | "Foo" | "15.14"  | "1"         |
            | "4" | "2"     | "Bar" | "10.00"  | "1"         |
            | "5" | "1"     | "Baz" | "10.00"  | "2"         |

        And I am signed in as User with Id "1"

    Scenario: I register Transfer Transaction
        When I register "5.14" Transfer from Account "1" to Account "2"

        Then I should not receive any error

        And Accounts should be:
            | id  | user_id | name  | balance  | currency_id |
            | "1" | "1"     | "Foo" | "10.00"  | "1"         |
            | "2" | "1"     | "Bar" | "15.14"  | "1"         |
            | "3" | "2"     | "Foo" | "15.14"  | "1"         |
            | "4" | "2"     | "Bar" | "10.00"  | "1"         |
            | "5" | "1"     | "Baz" | "10.00"  | "2"         |

    Scenario: I register Transfer Transaction to receive negative account balance
        When I register "30.14" Transfer from Account "1" to Account "2"

        Then I should not receive any error

        And Accounts should be:
            | id  | user_id | name  | balance  | currency_id |
            | "1" | "1"     | "Foo" | "-15.00" | "1"         |
            | "2" | "1"     | "Bar" | "40.14"  | "1"         |
            | "3" | "2"     | "Foo" | "15.14"  | "1"         |
            | "4" | "2"     | "Bar" | "10.00"  | "1"         |
            | "5" | "1"     | "Baz" | "10.00"  | "2"         |

    Scenario Outline: I register Transfer for incorrect account, currency, counterparty or with incorrect amount

        When I register <sum> Transfer from Account <from-account-id> to Account <to-account-id>

        Then I should receive <error-message> error
        And Accounts should be:
            | id  | user_id | name  | balance  | currency_id |
            | "1" | "1"     | "Foo" | "15.14"  | "1"         |
            | "2" | "1"     | "Bar" | "10.00"  | "1"         |
            | "3" | "2"     | "Foo" | "15.14"  | "1"         |
            | "4" | "2"     | "Bar" | "10.00"  | "1"         |
            | "5" | "1"     | "Baz" | "10.00"  | "2"         |

    Examples:
        | sum     | from-account-id | to-account-id | error-message                                 |
        | "5.01"  | "1"             | "10050"       | "Target account doesn't exist"                |
        | "5.01"  | "1"             | "3"           | "Target account doesn't exist"                |
        | "5.01"  | "10050"         | "1"           | "Source account doesn't exist"                |
        | "5.01"  | "4"             | "1"           | "Source account doesn't exist"                |
        | "5.01"  | "1"             | "5"           | "Currency isn't supported by target account"  |
        | "-5.10" | "1"             | "2"           | "Amount of money should be greater than zero" |
        | "0.00"  | "1"             | "2"           | "Amount of money should be greater than zero" |
