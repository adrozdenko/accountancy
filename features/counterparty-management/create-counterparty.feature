Feature: Create Counterparty
    In order to have a possibility to distinguish my incomes and expenses
    As a User
    I want to be able to create Counterparties

    Scenario: I create Counterparty
        Given I have Counterparties:
            | id | name |

        When I create Counterparty with Name "Foo"

        Then my Counterparties should be:
            | name  |
            | "Foo" |

    Scenario Outline: I create Counterparty with invalid data
        Given I have Counterparties:
            | id  | name  |
            | "1" | "Foo" |

        When I create Counterparty with Name <name>

        Then I should receive <error-message> error
        And my Counterparties should be:
            | id  | name  |
            | "1" | "Foo" |

    Examples:
        | name  | error-message                           |
        | "Foo" | "Counterparty 'Foo' already exists"     |
        | ""    | "Name of Counterparty can not be empty" |
        | "   " | "Name of Counterparty can not be empty" |
