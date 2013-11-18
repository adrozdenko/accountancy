Feature: Change Password
    In order to keep my records secure
    As a User
    I want to be able to change it

    Scenario: User changes password
        Given there are registered Users:
            | id | email              | password |
            | 1  | "foo@expample.com" | "foo"    |

        And I am a User with the following properties:
            | id | email              | password | is_authenticated |
            | 1  | "foo@expample.com" | "foo"    | true             |

        When I change my password to "barbar"

        Then I become a User with the following properties:
            | id | email              | password | is_authenticated |
            | 1  | "foo@expample.com" | "barbar" | true             |

        And registered Users should be:
            | id | email              | password |
            | 1  | "foo@expample.com" | "barbar" |


    Scenario Outline:
        Given there are registered Users:
            | id | email              | password |
            | 1  | "foo@expample.com" | "foo"    |

        And I am a User with the following properties:
            | id | email              | password | is_authenticated |
            | 1  | "foo@expample.com" | "foo"    | true             |

        When I change my password to <new-password>

        Then I should receive <error-message> error
        And I become a User with the following properties:
            | id | email              | password | is_authenticated |
            | 1  | "foo@expample.com" | "foo"    | true             |

        And registered Users should be:
            | id | email              | password |
            | 1  | "foo@expample.com" | "foo"    |

    Examples:
        | new-password | error-message                                   |
        | ""           | "Password can not be empty"                     |
        | "   "        | "Password can not be empty"                     |
        | "12345"      | "Password should be at least 6 characters long" |