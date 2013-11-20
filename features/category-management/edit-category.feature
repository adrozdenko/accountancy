Feature: Edit Category
    In order to have possibility manage Categories
    As User
    I want to be able create categories

    Scenario: I edit Category
        Given I have Categories:
            | id  | name  |
            | "1" | "Foo" |
        When I edit Category "1", set name to "Bar"
        Then My Categories should be:
            | id  | name  |
            | "1" | "Bar" |

    Scenario Outline: I edit category and provide invalid data
        Given I have Categories:
            | id  | name  |
            | "1" | "Foo" |
        When I edit Category <category-id>, set name to <category-name>
        Then I should receive <error-message> error
        And My Categories should be:
            | id  | name  |
            | "1" | "Foo" |

    Examples:
        | category-id | category-name | error-message                    |
        | "1"         | ""            | "Category name can not be empty" |
        | "1"         | "  "          | "Category name can not be empty" |
        | "2"         | "Bar"         | "Category does not exist"        |

