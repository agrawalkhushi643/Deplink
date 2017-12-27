Feature: Logout

  Scenario: Redirect to homepage
    When I visit page '/logout'
    Then I should be on page '/'
