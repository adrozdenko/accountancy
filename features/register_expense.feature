Feature: Register Expenses
In order to track my expenses
As a User
I want to be able to register money that I spend
    Scenario: User registers Exepnse
        Given User has categories of Expense: 
        | categoryId | categoryName |
        | 1          | Food         |
        And amount of money on Users account is "20 USD"
        When User registers "5 USD" Expense for Category "1"
        Then amount of money on Users account should be "15 USD"