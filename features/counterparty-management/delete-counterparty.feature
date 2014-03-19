Feature: Delete Counterparty
    In order to have a possibility to reorganize Counterparties
    As a User
    I want to be able to delete unused Counterparty

    Background:
        Given there are registered Users:
            | id  | email              | name   |
            | "1" | "foo@example.com"  | "foo"  |
            | "2" | "bar@example.com"  | "bar"  |

        And there are Counterparties:
            | id  | user_id | name  |
            | "1" | "1"     | "Foo" |
            | "2" | "2"     | "Bar" |

        And I am signed in as User with Id "1"

    Scenario: I delete Counterparty
        When I delete Counterparty "1"

        Then I should not receive any error

        And Counterparties should be:
            | id  | user_id | name  |
            | "2" | "2"     | "Bar" |

    Scenario Outline: I delete Counterparty and provide invalid data
        When I delete Counterparty <counterparty-id>

        Then I should receive <error-message> error

        And Counterparties should be:
            | id  | user_id | name  |
            | "1" | "1"     | "Foo" |
            | "2" | "2"     | "Bar" |

    Examples:
        | counterparty-id | error-message               |
        | "100500"        | "Counterparty doesn't exit" |
        | "2"             | "Counterparty doesn't exit" |
