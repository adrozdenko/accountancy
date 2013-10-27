Feature: Funds Flow
	In order to track the flow of money
	As a User
	I want to be able to register incomes and expenses
	
		Scenario: User registers income
			Given “Incomes” account  
			And Debit of the “Incomes” is “0 USD” 
			And Credit of the “Incomes” is “0 USD”

			When User adds “5 USD” to “Incomes”

			Then Debit of the “Incomes” equals to “0 USD” 
			And Credit of the “Incomes” equals to “5 USD”

		Scenario: User registers an expense
			Given “Incomes” account
			And User has an Account called “Expenses”  
			And Debit of the “Incomes” is “0 USD” 
			And Credit of the “Incomes” is “10 USD”
			And Debit of the “Expenses” is “0 USD” 
			And Credit of the “Expenses” is “0 USD”
			When user registers “5 USD” of expense from “Incomes” to “Expenses”
			Then Debit of the “Incomes” equals to “5 USD” 
			And Credit of the “Incomes” equals to “5 USD”
			And Debit of the “Expenses” equals to “0 USD”
			And Credit of the “Expenses” equals to “5 USD”
