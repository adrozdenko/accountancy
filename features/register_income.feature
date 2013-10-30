Feature: Register Income
In order to track my incomes
As a User
I want to be able to register money that I receive
	Scenario: User registers Income
	Given categories of Income: 
	| categoryId | categoryName |
	| 1          | Salary       |
	And amount of money on Users account is "15 USD"
	When User registers "15 USD" Income for Category "1"
	Then amount of money on Users account should be "30 USD"