Feature: Funds Flow
    In order to track the flow of money
    As a User
    I want to be able to register incomes and expenses

    Scenario: User registers income
        Given User has an Account called "Incomes"
        And Debit of the "Incomes" Account is "0 USD"
        And Credit of the "Incomes" Account is "0 USD"

        When User adds "5 USD" funds to "Incomes" Account

        Then Debit of the "Incomes" Account should be equal to "0 USD"
        And Credit of the "Incomes" Account should be equal to "5 USD"

    Scenario: User registers income when Account's credit is not zero
        Given User has an Account called "Incomes"
        And Debit of the "Incomes" Account is "0 USD"
        And Credit of the "Incomes" Account is "15.69 USD"

        When User adds "16.20 USD" funds to "Incomes" Account

        Then Debit of the "Incomes" Account should be equal to "0 USD"
        And Credit of the "Incomes" Account should be equal to "31.89 USD"

    Scenario: User registers an expense
        Given User has an Account called "Incomes"
        And User has an Account called "Expenses"
        And Debit of the "Incomes" Account is "0 USD"
        And Credit of the "Incomes" Account is "10 USD"
        And Debit of the "Expenses" Account is "0 USD"
        And Credit of the "Expenses" Account is "0 USD"

        When user registers "5 USD" of expense from "Incomes" Account to "Expenses"

        Then Debit of the "Incomes" Account should be equal to "5 USD"
        And Credit of the "Incomes" Account should be equal to "5 USD"
        And Debit of the "Expenses" Account should be equal to "0 USD"
        And Credit of the "Expenses" Account should be equal to "5 USD"
