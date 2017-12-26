Feature: Sign up

  Scenario: Join with GitHub
    Given Server has configuration:
      """
      [auth]
      signup = on

      [github]
      enabled = on
      """
    When I visit page '/join'
    Then There should be link to page '/join/github'

  @unimplemented
  Scenario: Disabled join
    Given Server has configuration:
      """
      [auth]
      signup = off
      """
    When I visit page '/join'
    Then I should see error page 404

  Scenario: Disabled join with external providers
    Given Server has configuration:
      """
      [auth]
      signup = on

      [github]
      enabled = off
      """
    When I visit page '/join'
    Then There should not be link to page '/join/github'
