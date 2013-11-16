Feature: Delete Counterparty
    In order to have a possibility to reorganize Counterparties
    As a User
    I want to be able to delete unused Counterparty

    Scenario: I delete Counterparty
        Given I have Counterparties:
            | id | name  |
            | 1  | "Foo" |

        When I delete Counterparty "1"
        Then my Counterparties should be:
            | id | name |

    Scenario Outline: I delete Counterparty and provide invalid data
        Given I have Counterparties:
            | id | name |
            | 1  | Foo  |

        When I delete Counterparty <counterparty-id>
        Then I should receive <error-message> error
        And my Counterparties should be:
            | id | name |
            | 1  | Foo  |

    Examples:
        | counterparty-id | error-message               |
        | "100500"        | "Counterparty doesn't exit" |
