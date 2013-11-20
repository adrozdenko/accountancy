Feature: Register Income
    In order to track my incomes
    As a User
    I want to be able register Income Transactions

    Scenario: I register Income Transaction
        Given I have Accounts:
            | id  | name  | balance | currency_id |
            | "1" | "Foo" | "15.14" | "1"         |
        And I have Categories:
            | id  | name  |
            | "1" | "Bar" |
        And I have Counterparties:
            | id  | name  |
            | "1" | "Baz" |

        When I register "4.86" Income of currency "1" for Account "1" and Category "1" and Counterparty "1"

        Then My Accounts should be:
            | id  | name  | balance | currency_id |
            | "1" | "Foo" | "20.00" | "1"         |

    Scenario: I register Income Transaction to receive negative account balance
        Given I have Accounts:
            | id  | name  | balance  | currency_id |
            | "1" | "Foo" | "-15.14" | "1"         |
        And I have Categories:
            | id  | name  |
            | "1" | "Bar" |
        And I have Counterparties:
            | id  | name  |
            | "1" | "Baz" |

        When I register "10.04" Income of currency "1" for Account "1" and Category "1" and Counterparty "1"

        Then My Accounts should be:
            | id  | name  | balance | currency_id |
            | "1" | "Foo" | "-5.10" | "1"         |

    Scenario Outline: I register Income for incorrect account, currency, counterparty or with incorrect amount
        Given I have Accounts:
            | id  | name  | balance  | currency_id |
            | "1" | "Foo" | "15.14"  | "1"         |
        And I have Categories:
            | id  | name  |
            | "1" | "Bar" |
        And I have Counterparties:
            | id  | name  |
            | "1" | "Baz" |

        When I register <sum> Income of currency <currency-id> for Account <account-id> and Category <category-id> and Counterparty <counterparty-id>

        Then I should receive <error-message> error
        And My Accounts should be:
            | id  | name  | balance | currency_id |
            | "1" | "Foo" | "15.14" | "1"         |

    Examples:
        | sum     | currency-id | account-id | counterparty-id | category-id | error-message                                 |
        | "5.01"  | "1"         | "10050"    | "1"             | "1"         | "Account doesn't exist"                       |
        | "5.01"  | "2"         | "1"        | "1"             | "1"         | "Currency is't supported by account"          |
        | "5.01"  | "1"         | "1"        | "100500"        | "1"         | "Counterparty doesn’t exist"                  |
        | "5.01"  | "1"         | "1"        | "1"             | "100500"    | "Category doesn’t exist"                      |
        | "-5.10" | "1"         | "1"        | "1"             | "1"         | "Amount of money should be greater than zero" |
        | "0.00"  | "1"         | "1"        | "1"             | "1"         | "Amount of money should be greater than zero" |


