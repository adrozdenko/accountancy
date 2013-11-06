Feature: Edit Account
In order to have a possibility to modify existing Accounts
As a User
I want to be able to edit them
    Scenario: I edit Account
        Given I have Accounts:
        | id | name  | balance | currency_id |
        | 1  | Foo   | 13.50    | 1           |

        When I edit Account 1, set name to "Bar"
        Then My Accounts should be:
        | id | name  | balance | currency_id |
        | 1  | Bar   | 13.50    | 1           |

    Scenario Outline: I edit account and provide invalid date
        Given I have Accounts:
        | id | name  | balance | currency_id |
        | 1  | Foo   | 13.50    | 1           |
        | 2  | Bar   | 13.50    | 1           |

        When I edit Account <account-id>, set name to <account-name>
        Then I should receive <error-message> error
        And My Accounts should be:
        | id | name  | balance | currency_id |
        | 1  | Foo   | 13.50    | 1           |
        | 2  | Bar   | 13.50    | 1           |

        Examples:
        | account-id | account-name | error-message                                  |
        | 1          | "Bar"        | "Account 'Bar' already exists"                 |
        | 1          | "   "        | "Name of Account can not be empty"             |
        | 1          | ""           | "Name of Account can not be empty"             |
        | 10050      | "Baz"        | "Account doesn't exist"                        |
