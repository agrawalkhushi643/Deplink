Feature: Sign up

  Scenario: Join with GitHub enabled
    Given I am on page '/join'
    Then There should be link to page '/join/github'
