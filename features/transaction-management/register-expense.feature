Feature: Register Expense
In order to track my expenses
As a User
I want to be able register Expense Transactions
    Scenario: I register Expense Transaction
        Given I have Accounts:
        | id | name | balance |
        | 1  | Foo  | 15.14   |
        And I have Categories:
        | id | name |
        | 1  | Bar  |
        And I have Counterparties:
        | id | name |
        | 1  | Baz  |

        When I register "4.11" Expense for Account 1 and Category 1 and Counterparty 1

        Then My Accounts should be:
        | id | name | balance |
        | 1  | Foo  | 11.03   |

    Scenario Outline: I register Expense for incorrect account, counterparty or with incorrect amount
        Given I have Accounts:
        | id | name | balance |
        | 1  | Foo  | 15.14   |
        And I have Categories:
        | id | name |
        | 1  | Bar
        And I have Counterparties:
        | id | name |
        | 1  | Baz  |

        When I register <sum> Expense for Account <account-id> and Category <category-id> and Counterparty <counterparty-id>

        Then I should receive <error-message> error
        And My Accounts should be:
        | id | name | balance |
        | 1  | Foo  | 15.14   |

        Examples:
        | sum     | account-id | counterparty-id | category-id | error-message                                 |
        | "5.01"  | 10050      | 1               | 1           | "Account doesn’t exist"                       |
        | "5.01"  | 1          | 100500          | 1           | "Counterparty doesn’t exist"                  |
        | "5.01"  | 1          | 1               | 100500      | "Category doesn’t exist"                      |
        |"-5.10"  | 1          | 1               | 1           | "Amount of money should be greater than zero" |
        | "0.00"  | 1          | 1               | 1           | "Amount of money should be greater than zero" |
        | "30.00" | 1          | 1               | 1           | "Amount of money should be greater than zero" |
