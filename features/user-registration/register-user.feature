Feature: Register User
    In order to start using accountancy
    As a anonymous Visitor
    I want to be able become registered User

    Scenario Outline: Visitor becomes registered
        Given there are registered Users:
            | id | email | password | name |

        When I register using name <name> email <email> password <password>

        Then authentication payload is created <authentication-payload>
        And registered Users should be:
            | email   | password | name   | authentication_payload   | is_email_verified |
            | <email> | "/^.*$/" | <name> | <authentication-payload> | false             |

        And notification email is sent to <email> with title "Welcome to Home Accountancy"
        And notification email contains the following text:
        """
        Dear<greeting>,
        Welcome to Home Accountancy

        Your email address  needs to be verified.
        Please open https://example.com/verify-email/<authentication-payload> in your browser to verify your email address.

        Best Regards,

        """

    Examples:
        | name  | email             | password | greeting | authentication-payload |
        | "Foo" | "foo@example.com" | "bar"    | " Foo"   | "some-code"            |
        | ""    | "foo@example.com" | "bar"    | ""       | "another-code"         |
        | "   " | "foo@example.com" | "bar"    | ""       | "foobarbaz"            |

    Scenario Outline: Visitor tries to register with invalid data
        Given there are registered Users:
            | id | email             | password | name  |
            | 1  | "foo@example.com" | "bar"    | "Foo" |

        When I register using name <name> email <email> password <password>

        Then registered Users should be:
            | id | email             | password | name  |
            | 1  | "foo@example.com" | "bar"    | "Foo" |

        And I should receive <error-message> error

    Examples:
        | name  | email             | password | error-message                                   |
        | "foo" | "bar"             | "baz"    | "Email address is invalid"                      |
        | "foo" | ""                | "baz"    | "Email address is invalid"                      |
        | "foo" | "   "             | "baz"    | "Email address is invalid"                      |
        | "foo" | "user@example"    | "baz"    | "Email address is invalid"                      |
        | "foo" | "example.com"     | "baz"    | "Email address is invalid"                      |
        | "foo" | "foo@example.com" | "      " | "Password can not be empty"                     |
        | "foo" | "foo@example.com" | "12345"  | "Password should be at least 6 characters long" |

