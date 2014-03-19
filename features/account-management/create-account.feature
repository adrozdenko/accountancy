Feature: Create Account
    In order to track different sources of income and expense in several currencies
    As a User
    I want to be able to create Accounts

    Scenario: I create Account
        Given there are registered Users:
            | id  | email              | name   |
            | "1" | "foo@example.com"  | "foo"  |

        And there are Accounts:
            | user_id | name  | balance | currency_id |

        And There are Currencies:
            | id  |
            | "1" |
            | "2" |

        And I am signed in as User with Id "1"

        When I create Account with Name "Foo" and Currency "1"

        Then I should not receive any error
        And Accounts should be:
            | user_id | name  | balance | currency_id |
            | "1"     | "Foo" | "0.00"  | "1"         |

    Scenario Outline: I create Account with invalid input
        Given there are registered Users:
            | id  | email              | name   |
            | "1" | "foo@example.com"  | "foo"  |

        And there are Accounts:
            | user_id | id  | name  | balance | currency_id |
            | "1"     | "1" | "Foo" | "0.00"  | "1"         |
        And I am signed in as User with Id "1"

        And There are Currencies:
            | id  |
            | "1" |
            | "2" |

        When I create Account with Name <account-name> and Currency <currency-id>

        Then I should receive <error-message> error
        And Accounts should be:
            | user_id | name  | balance | currency_id |
            | "1"     | "Foo" | "0.00"  | "1"         |

        Examples:
            | account-name | currency-id | error-message                      |
            | "Bar"        | "3"         | "Invalid currency provided"        |
            | "Foo"        | "1"         | "Account 'Foo' already exists"     |
            | ""           | "2"         | "Name of Account can not be empty" |
            | "   "        | "2"         | "Name of Account can not be empty" |

