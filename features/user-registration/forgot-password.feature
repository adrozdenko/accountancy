Feature: Forgot Password
In order to be able restore my password
As a Visitor
I want to be able to request password reset email
    Scenario: Visitor requests password reset email
        Given there are registered Users:
        | id | email              | name   |
        | 1  | "test@example.cmo" | "Test" |
        | 2  | "foo@bar.com"      | "Foo"  |

        When I request pasword reset email for "test@example.com"

        Then notification email is sent to "test@exampel.com" with title "Password Reset"
        And notification email contains the following text:
        """
        Dear Test,

        And here goes password reset URL

        """

    Scenario Outline: Visitor requests password reset email using invalid data
        Examples:
        | email |
