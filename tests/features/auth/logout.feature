Feature: Logout

  Scenario: Redirect to homepage
    When I go to "/logout"
    Then I should be on the homepage
