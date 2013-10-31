Feature: Register Income
    In order to control my income transaction
    As a User
    I want to be able register Income transaction
    Scenario: I register Income transaction
    	Given I have Accounts:
     	| id | name | balance |
     	| 1  | Foo  | 15.14   |
    	And I have Categories:
     	| id | name |
     	| 1  | Bar  |
    	And I have Counterparties:
     	| id | name |
     	| 1  | Baz  |

    	When I register "30.14" Income for Account 1 and Category 1 and Counterparty 1

    	Then My Accounts should be:
     	| id | name | balance |
     	| 1  | Foo  | 45.28   |

    Scenario Outline: I’m trying to register incorrect Income transaction
    	Given I have Accounts:
     	| id | name | balance |
     	| 1  | Foo  | 15.14   |
    	And I have Categories:
     	| id | name |
     	| 1  | Bar  |
    	And I have Counterparties:
     	| id | name |
     	| 1  | Baz  |
    	 
    	When  I register <sum> Income for Account <account-id> and Category <category-id> and Counterparty <counterparty-id>
   	 
    	Then I should receive <error-message> error
    	And My Accounts should be:
     	| id | name | balance |
     	| 1  | Foo  | 15.14   |

    	Examples:
     	| sum  	   | account-id | counterparty-id | category-id | error-message |
     	| "1.45"   | 2      	|  1          	  | 1       	|  (1)      	|
     	| "2.44"   | 1      	|  2          	  | 1       	|  (2)      	|
     	| "12.32"  | 1      	|  1          	  | 3       	|  (3)      	|
     	| "-12.32" | 1      	|  1          	  | 1       	|  (4)      	|
     	| "-0.00 " | 1      	|  1          	  | 1       	|  (4)      	|