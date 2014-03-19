Feature: Create Category
    In order to have possibility to group transactions by categories
    As User
    I want to be able create categories

    Background:
        Given there are registered Users:
            | id  | email              | name   |
            | "1" | "foo@example.com"  | "foo"  |

        And there are Categories:
            | id  | user_id | name  |
            | "1" | "1"     | "Foo" |

        And I am signed in as User with Id "1"

    Scenario: I create Category
        When I create Category "Bar"

        Then I should not receive any error

        And Categories should be:
            | id  | user_id | name  |
            | "1" | "1"     | "Foo" |
            | "2" | "1"     | "Bar" |

    Scenario Outline: I create invalid Category

        When I create Category <category-name>

        Then I should receive <error-message> error

        And Categories should be:
            | id  | user_id | name  |
            | "1" | "1"     | "Foo" |

    Examples:
        | category-name | error-message                    |
        | "Foo"         | "Category 'Foo' already exists"  |
        | ""            | "Category name can not be empty" |
        | "  "          | "Category name can not be empty" |
