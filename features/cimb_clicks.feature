@javascript
Feature: CIMB Clicks
  In order to buy a product
  As a website user
  I need to be able to pay using CIMB Clicks

  Scenario: Follow checkout journey
    Given I am on CIMB Clicks Checkout Form
    And I pay
    Then I should be redirected to Veritrans Cimb Clicks Page
    And I proceed with success CIMB accountID
    Then I should see "Transaksi Sukses"


