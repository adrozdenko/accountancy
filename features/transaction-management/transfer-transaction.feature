Feature: Register Transfer
    In order to track my transfers
    As a User
    I want to be able register Transfer Transactions

    Scenario: I register Transfer Transaction
        Given I have Accounts:
            | id  | name  | balance | currency_id |
            | "1" | "Foo" | "15.14" | "1"         |
            | "2" | "Zoo" | "10.00" | "1"         |

        When I register "5.14" Transfer from Account "1" to Account "2"

        Then My Accounts should be:
            | id  | name  | balance | currency_id |
            | "1" | "Foo" | "10.00" | "1"         |
            | "2" | "Zoo" | "15.14" | "1"         |

    Scenario: I register Transfer Transaction to receive negative account balance
        Given I have Accounts:
            | id  | name  | balance | currency_id |
            | "1" | "Foo" | "15.14" | "1"         |
            | "2" | "Zoo" | "10.00" | "1"         |

        When I register "30.14" Transfer from Account "1" to Account "2"

        Then My Accounts should be:
            | id  | name  | balance  | currency_id |
            | "1" | "Foo" | "-15.00" | "1"         |
            | "2" | "Zoo" | "40.14"  | "1"         |

    Scenario Outline: I register Transfer for incorrect account, currency, counterparty or with incorrect amount
        Given I have Accounts:
            | id  | name  | balance | currency_id |
            | "1" | "Foo" | "10.00" | "1"         |
            | "2" | "Zoo" | "15.14" | "1"         |
            | "3" | "Goo" | "15.14" | "2"         |

        When I register <sum> Transfer from Account <from-account-id> to Account <to-account-id>

        Then I should receive <error-message> error
        And My Accounts should be:
            | id  | name  | balance | currency_id |
            | "1" | "Foo" | "10.00" | "1"         |
            | "2" | "Zoo" | "15.14" | "1"         |
            | "3" | "Goo" | "15.14" | "2"         |

    Examples:
        | sum     | from-account-id | to-account-id | error-message                                 |
        | "5.01"  | "1"             | "10050"       | "Target account doesn't exist"                |
        | "5.01"  | "10050"         | "1"           | "Source account doesn't exist"                |
        | "5.01"  | "1"             | "3"           | "Currency is't supported by target account"   |
        | "-5.10" | "1"             | "2"           | "Amount of money should be greater than zero" |
        | "0.00"  | "1"             | "2"           | "Amount of money should be greater than zero" |


