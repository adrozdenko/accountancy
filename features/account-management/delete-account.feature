Feature: Delete Account
    In order to have a possibility to reorganize my Accounts
    As a User
    I want to be able delete unused Accounts

    Scenario: I delete Account
        Given I have Accounts:
            | id  | name  | balance | currency_id |
            | "1" | "Foo" | "0.00"  | "1"         |

        When I delete Account "1"
        Then My Accounts should be:
            | id | name | balance | currency_id |

    Scenario Outline: I delete Account and provide invalid data
        Given I have Accounts:
            | id  | name  | balance | currency_id |
            | "1" | "Foo" | "0.00"  | "1"         |

        When I delete Account <account-id>
        Then I should receive <error-message> error
        And My Accounts should be:
            | id  | name  | balance | currency_id |
            | "1" | "Foo" | "0.00"  | "1"         |

    Examples:
        | account-id | error-message           |
        | "100500"   | "Account doesn't exist" |
