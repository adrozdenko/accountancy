Feature: Create Category
In order to have possibility to group transactions by categories
As User
I want to be able create categories
    Scenario: I create Category
        Given I have Categories:
        | id | name |
        When I create Category with name "Foo"
        Then my Categories should be:
        | id | name  |
        | 1  | "Foo" |

    Scenario Outline: I create invalid Category
        Given I have Categories:
        | id | name  |
        | 1  | "Foo" |
        When I create Category with name <category-name>
        Then I should receive <error-message> error
        And my Categories should be:
        | id | name  |
        | 1  | "Foo" |

        Examples:
        | category-name | error-message                    |
        | ""            | "Category name can not be empty" |
        | "  "          | "Category name can not be empty" |
        | "Foo"         | "Category 'Foo' already exists"  |
