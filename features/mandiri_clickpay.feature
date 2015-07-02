Feature: Mandiri Clickpay
  In order to buy a product
  As a website user
  I need to be able to pay using Mandiri Clickpay

  Scenario: Follow checkout journey
    Given I am on Mandiri Clickpay Checkout Form
    And I pay
    Then I should see "Transaksi Sukses"


