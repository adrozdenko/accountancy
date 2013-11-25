Feature: Edit Category
    In order to have possibility manage Categories
    As User
    I want to be able create categories

    Background:
        Given there are registered Users:
            | id  | email              | name   |
            | "1" | "foo@example.com"  | "foo"  |
            | "2" | "bar@example.com"  | "bar"  |

        And there are Categories:
            | id  | user_id | name  |
            | "1" | "1"     | "Foo" |
            | "2" | "1"     | "Bar" |
            | "3" | "2"     | "Foo" |

        And I am signed in as User with Id "1"

    Scenario: I edit Category
        When I edit Category "1", set name to "Baz"

        Then I should not receive any error

        And Categories should be:
            | id  | user_id | name  |
            | "1" | "1"     | "Baz" |
            | "2" | "1"     | "Bar" |
            | "3" | "2"     | "Foo" |

    Scenario Outline: I edit category and provide invalid data
        When I edit Category <category-id>, set name to <category-name>

        Then I should receive <error-message> error

        And Categories should be:
            | id  | user_id | name  |
            | "1" | "1"     | "Foo" |
            | "2" | "1"     | "Bar" |
            | "3" | "2"     | "Foo" |

    Examples:
        | category-id | category-name | error-message                    |
        | "1"         | ""            | "Category name can not be empty" |
        | "2"         | "  "          | "Category name can not be empty" |
        | "4"         | "Bar"         | "Category does not exist"        |
        | "3"         | "Bar"         | "Category does not exist"        |

