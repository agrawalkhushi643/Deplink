Feature: Sign up

  Scenario: Join disabled by default
    When I visit page '/join'
    Then I should see 404 error page

  Scenario: Join with GitHub disabled by default
    Given server has configuration:
      """
      JOIN_ENABLED=true
      """
    When I visit page '/join'
    Then there should not be link to page '/join/github'
