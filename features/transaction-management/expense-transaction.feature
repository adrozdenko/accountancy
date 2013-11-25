Feature: Register Expense
    In order to track my expenses
    As a User
    I want to be able register Expense Transactions

    Background:
        Given there are registered Users:
            | id  | email             | name  |
            | "1" | "foo@example.com" | "Foo" |

        And there are Accounts:
            | id  | user_id | name  | balance | currency_id |
            | "1" | "1"     | "Foo" | "15.14" | "1"         |

        And there are Categories:
            | id  | user_id | name  |
            | "1" | "1"     | "Bar" |

        And there are Counterparties:
            | id  | user_id | name |
            | "1" | "1"     | "Baz |

        And I am signed in as User with Id "1"

    Scenario: I register Expense Transaction
        When I register "4.11" Expense of currency "1" for Account "1" and Category "1" and Counterparty "1"

        Then I should not receive any error

        And Accounts should be:
            | id  | user_id | name  | balance | currency_id |
            | "1" | "1"     | "Foo" | "11.03" | "1"         |

    Scenario: I register Expense Transaction to receive negative account balance
        When I register "30.14" Expense of currency "1" for Account "1" and Category "1" and Counterparty "1"

        Then I should not receive any error

        And Accounts should be:
            | id  | user_id | name  | balance  | currency_id |
            | "1" | "1"     | "Foo" | "-15.00" | "1"         |

    Scenario Outline: I register Expense for incorrect account, currency, counterparty or with incorrect amount
        When I register <sum> Expense of currency <currency-id> for Account <account-id> and Category <category-id> and Counterparty <counterparty-id>

        Then I should receive <error-message> error

        And Accounts should be:
            | id  | user_id | name  | balance | currency_id |
            | "1" | "1"     | "Foo" | "15.14" | "1"         |

    Examples:
        | sum     | currency-id | account-id | counterparty-id | category-id | error-message                                 |
        | "5.01"  | "1"         | "10050"    | "1"             | "1"         | "Account doesn't exist"                       |
        | "5.01"  | "2"         | "1"        | "1"             | "1"         | "Currency isn't supported by account"         |
        | "5.01"  | "1"         | "1"        | "100500"        | "1"         | "Counterparty doesn’t exist"                  |
        | "5.01"  | "1"         | "1"        | "1"             | "100500"    | "Category doesn’t exist"                      |
        | "-5.10" | "1"         | "1"        | "1"             | "1"         | "Amount of money should be greater than zero" |
        | "0.00"  | "1"         | "1"        | "1"             | "1"         | "Amount of money should be greater than zero" |
