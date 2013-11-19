Feature: Update Profile
    In order to keep my personal information up to date
    As a user
    I want to be able to change it after registration

    Scenario: User updates personal information
        Given there are registered Users:
            | id | email              | name |
            | 1  | foo@expample.com   | foo  |
            | 2  | bar@expample.com   | bar  |

        And I am a User with the following properties:
            | id | email              | name  |
            | 1  | foo@expample.com   | foo   |

        When I update my profile, set name "baz"

        Then I become a User with the following properties:
            | id | email              | name |
            | 1  | foo@expample.com   | baz  |

        And registered Users should be:
            | id | email              | name |
            | 1  | foo@expample.com   | baz  |
            | 2  | bar@expample.com   | bar  |
