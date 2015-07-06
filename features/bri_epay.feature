@javascript
Feature: BRI Epay
  In order to buy a product
  As a website user
  I need to be able to pay using BRI Epay

  Scenario: Follow checkout journey
    Given I am on BRI Epay Checkout Form
    And I pay
    Then I should be redirected to Veritrans BRI Epay Page
    And I proceed with success BRI Epay accountID
    Then I should see "Transaksi Sukses"


