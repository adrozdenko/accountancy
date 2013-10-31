Feature: Register Fulfill
    In order to start work with the system
    As a User
    I want to be able add initial funds to my Accounts
    Scenario: I add funds to my Account
    	Given I have Accounts:
     	| id | name | balance |
     	| 1  | Foo  | 15.14   |

    	When I add "5.14" funds to Account 1

    	Then My Accounts should be:
     	| id | name | balance |
     	| 1  | Foo  | 20.28   |

    Scenario Outline: I add funds to Account that doesn’t belong to me or invalid amount of money
    	Given I have Accounts:
     	| id | name | balance |
     	| 1  | Foo  | 15.14   |

    	When I add <sum> funds to Account <account-id>

    	Then I should receive <error-message> error
    	And My Accounts should be:
     	| id | name | balance |
     	| 1  | Foo  | 15.14   |

    	Examples:
     	| sum	 | account-id   | error-message |
     	| "5.01" | 10050  	| (1)       	|
     	|"-5.10" | 1      	| (4)       	|
     	| "0.00" | 1      	| (4)       	|