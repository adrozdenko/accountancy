Feature: Delete Account
    In order to have a possibility to reorganize my Accounts
    As a User
    I want to be able delete unused Accounts

    Scenario: I delete Account
        Given there are registered Users:
            | id  | email              | name   |
            | "1" | "foo@example.com"  | "foo"  |

        And there are Accounts:
            | user_id | name  | balance | currency_id |
            | "1"     | "Foo" | "0.00"  | "1"         |

        And I am signed in as User with Id "1"


        When I delete Account "1"

        Then I should not receive any error

        And Accounts should be:
            | id | name | balance | currency_id |

    Scenario Outline: I delete Account and provide invalid data
        Given there are registered Users:
            | id  | email              | name   |
            | "1" | "foo@example.com"  | "foo"  |

        And there are Accounts:
            | id  | user_id | name  | balance | currency_id |
            | "1" | "1"     | "Foo" | "0.00"  | "1"         |

        And I am signed in as User with Id <user-id>

        When I delete Account <account-id>
        Then I should receive <error-message> error
        And Accounts should be:
            | id  | user_id | name  | balance | currency_id |
            | "1" | "1"     | "Foo" | "0.00"  | "1"         |

    Examples:
        | user-id  | account-id | error-message           |
        | "1"      | "100500"   | "Account doesn't exist" |
        | "100500" | "1"        | "Account doesn't exist" |
