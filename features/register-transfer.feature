Feature: Register Transfer
	In order control my transfer transaction
	As a User
	I want to be able register Transfer transaction
    Scenario: I register transfer transaction
		Given I have Accounts:
		| id | name | balance |
		| 1  | Foo  | 15.14   |
		| 2  | Foz  | 0.00    |
		And I have Categories:
		| id | name |  
		| 1  | Bar  |
		And I have Counterparties:
		| id | name |  
		| 1  | Baz  |
		When I register Transfer from Account “1” to Account “2” and Category “1” and Counterparty “1” 
		Then My Accounts should be:
		| id | name | balance |
		| 1  | Foo  | 0.00    |
		| 2  | Foz  | 15.14   |

	Scenario Outline: I register Transfer for incorrect account, category or counterparty or with incorrect amount of money
		Given I have Accounts:
		| id | name | balance |
		| 1  | Foo  | 15.14   |
		| 2  | Foz  | 0.00    |
		And I have Categories:
		| id | name |  
		| 1  | Bar  |
		And I have Counterparties:
		| id | name |  
		| 1  | Baz  |

		When I register <sum> Transfer from Account <account-from-id> to Account <account-to-id> and Category <category-id> and Counterparty <counterparty-id>
        Then I should receive <error-message> error
        And My Accounts should be:
        | id | name | balance |
	    | 1  | Foo  | 15.14   |
	    | 2  | Foz  | 0.00    |
			    
		Examples:
		| sum   | account-from-id | account-to-id | counterparty-id | category-id | error-message |
		| 5.01  | 10050           | 2             | 1               | 1           |(1)            | 
		| 5.01  | 1               | 10050         | 1               | 1           |(1)            | 
		| 5.01  | 1               | 2             | 100500          | 1           |(2)            |
		| 5.01  | 1               | 2             | 1               | 100500      |(3)            |
		|-5.10  | 1               | 2             | 1               | 1           |(4)            |
		| 0.00  | 1               | 2             | 1               | 1           |(4)            | 
		| 30.00 | 1               | 2             | 1               | 1           |(5)            |