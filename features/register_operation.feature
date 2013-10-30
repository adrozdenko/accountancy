Feature: Register Operation
In order to track my founds operations
As a User
I want to be able to register founds operations
    Scenario: User registers Income operation
        Given User has categories:
        | categoryId | categoryName |
        | 1          | Salary       |
        Given User has payees:
        | payeeId    | payeeName    |
        | 2          | EPAM         |
        And amount of money on Users balance is "15"
        When User registers "15" Income for Category "1" and Payee "2"
        Then amount of money on Users balance should be "30"
    Scenario: User registers Expense operation
        Given User has categories:
        | categoryId | categoryName |
        | 1          | Salary       |
        Given User has payees:
        | payeeId    | payeeName    |
        | 2          | EPAM         |
        And amount of money on Users balance is "30"
        When User registers "15" Expense for Category "1" and Payee "2"
        Then amount of money on Users balance should be "15"
