Feature: Delete Category
    In order to have a possibility to reorganize Categories
    As a User
    I want to be able delete unused Category

    Scenario: I delete Category
        Given I have Categories:
            | id  | name  |
            | "1" | "Foo" |

        When I delete Category "1"

        Then My Categories should be:
            | id | name |

    Scenario Outline: I delete Category and provide invalid data
        Given I have Categories:
            | id  | name  |
            | "1" | "Foo" |

        When I delete Category <category-id>

        Then I should receive <error-message> error
        And My Categories should be:
            | id  | name  |
            | "1" | "Foo" |

    Examples:
        | category-id | error-message             |
        | "10050"     | "Category does not exist" |
