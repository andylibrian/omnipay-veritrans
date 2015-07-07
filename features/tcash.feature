Feature: TCash
  In order to buy a product
  As a website user
  I need to be able to pay using TCash

  Scenario: Follow checkout journey
    Given I am on TCash Checkout Form
    And I pay
    Then I should see "Transaksi Sukses"


