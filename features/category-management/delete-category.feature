Feature: Delete Category
    In order to have a possibility to reorganize Categories
    As a User
    I want to be able delete unused Category

    Background:
        Given there are registered Users:
            | id  | email              | name   |
            | "1" | "foo@example.com"  | "foo"  |

        And there are Categories:
            | id  | user_id | name  |
            | "1" | "1"     | "Foo" |
            | "2" | "1"     | "Bar" |

        And I am signed in as User with Id "1"

    Scenario: I delete Category
        When I delete Category "1"

        Then I should not receive any error

        And Categories should be:
            | id  | user_id |  name |
            | "2" | "1"     | "Bar" |

    Scenario Outline: I delete Category and provide invalid data
        When I delete Category <category-id>

        Then I should receive <error-message> error

        And Categories should be:
            | id  | user_id | name  |
            | "1" | "1"     | "Foo" |
            | "2" | "1"     | "Bar" |

    Examples:
        | category-id | error-message             |
        | "10050"     | "Category does not exist" |
