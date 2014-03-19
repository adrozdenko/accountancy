Feature: Change Password
    In order to keep my records secure
    As a User
    I want to be able to change it

    Background:
        Given there are registered Users:
            | id  | email             | password |
            | "1" | "foo@example.com" | "foo"    |

        And I am signed in as User with Id "1"

    Scenario: User changes password
        When I change my password to "barbar"

        Then I should not receive any error

        And I become signed in User with Id "1"

        And registered Users should be:
            | id  | email             | password |
            | "1" | "foo@example.com" | "barbar" |

    Scenario Outline:
        When I change my password to <new-password>

        Then I should receive <error-message> error

        And I become signed in User with Id "1"

        And registered Users should be:
            | id  | email             | password |
            | "1" | "foo@example.com" | "foo"    |

    Examples:
        | new-password | error-message                                   |
        | ""           | "Password can not be empty"                     |
        | "   "        | "Password can not be empty"                     |
        | "12345"      | "Password should be at least 6 characters long" |