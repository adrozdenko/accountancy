Feature: User Authentication
    In order to access my accountancy
    As a Visitor
    I want to be authenticated by providing my credentials

    Scenario: Visitor becomes authenticated using email and password
        Given there are registered Users:
            | id  | email             | password | is_authenticated | is_email_verified |
            | "1" | "foo@example.com" | "bar"    | "false"          | "true"            |

        When I sign in using email "foo@example.com" and password "bar"

        Then I become a User with the following properties:
            | id  | email             | password | is_authenticated |
            | "1" | "foo@example.com" | "bar"    | "true"           |

    Scenario: Visitor becomes authenticated using authentication payload
        Given there are registered Users:
            | id  | email             | password | is_authenticated  | authentication_payload | is_email_verified |
            | "1" | "foo@example.com" | "bar"    | "false"           | "baz"                  | "false"           |

        When I sign in using authentication payload "baz"

        Then I become a User with the following properties:
            | id  | email             | password | is_authenticated | authentication_payload | is_email_verified |
            | "1" | "foo@example.com" | "bar"    | "true"           | ""                     | "true"            |

    Scenario Outline: Visitor tries become authenticated using invalid email and password
        Given there are registered Users:
            | id  | email                      | password | is_authenticated | is_email_verified |
            | "1" | "foo@example.com"          | "bar"    | "false"          | "true"            |
            | "2" | "not-verified@example.com" | "bar"    | "false"          | "false"           |

        When I sign in using email <email> and password <password>

        Then I should not become an authenticated User
        And I should receive <error-message> error

    Examples:
        | email                      | password  | error-message                                                                                              |
        | "invalid@example.com"      | "bar"     | "Invalid email or password"                                                                                |
        | "foo@example.com"          | "invalid" | "Invalid email or password"                                                                                |
        | "not-verified@example.com" | "bar"     | "Your email address has not yet been verified. Please check your email and follow the URL provided in it." |


    Scenario Outline: Visitor tries become authenticated using invalid authentication payload
        Given there are registered Users:
            | id  | email                      | password | is_authenticated | is_email_verified | authentication_payload |
            | "1" | "verified@expample.com"    | "bar"    | "false"          | "true"            | ""                     |
            | "2" | "not-verified@example.com" | "bar"    | "false"          | "false"           | "bar"                  |

        When I sign in using authentication payload <authentication-payload>

        Then I should not become an authenticated User
        And I should receive <error-message> error

    Examples:
        | authentication-payload | error-message                    |
        | ""                     | "Verification code is not valid" |
        | "  "                   | "Verification code is not valid" |
        | "invalid"              | "Verification code is not valid" |



