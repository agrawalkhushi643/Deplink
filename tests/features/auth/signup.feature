Feature: Sign up

  Scenario: Join disabled by default
    When I go to "/join"
    Then I should see "Page not found"

  Scenario: Join with GitHub disabled by default
    Given server has configuration:
      """
      SIGNUP_ENABLED=true
      """
    When I go to "/join"
    Then I should not see an "a[href='/join/github']" element
    And I should not see "Page not found"
