<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am on CIMB Clicks Checkout Form
     */
    public function iAmOnCimbClicksCheckoutForm()
    {
        $this->visitPath('/cimb_clicks/form.html');
    }

    /**
     * @Given I am on Mandiri Clickpay Checkout Form
     */
    public function iAmOnMandiriClickpayCheckoutForm()
    {
        $this->visitPath('/mandiri_clickpay/form.html');
    }

    /**
     * @Given I pay
     */
    public function iPay()
    {
        $this->pressButton('btn-pay');
    }

    /**
     * @Then I should be redirected to Veritrans Cimb Clicks Page
     * @Then I should be redirected to Veritrans BRI Epay Page
     */
    public function iShouldBeRedirectedToVeritransCimbClicksPage()
    {
        sleep(2);
        $this->urlMatches('/api.sandbox.veritrans.co.id/');
    }

    /**
     * Checks that current session address matches regex.
     *
     * @param string $regex
     *
     * @throws ExpectationException
     */
    public function urlMatches($regex)
    {
        $actual = $this->getSession()->getCurrentUrl();
        $message = sprintf('Current page "%s" does not match the regex "%s".', $actual, $regex);

        $this->assert((bool) preg_match($regex, $actual), $message);
    }

    /**
     * Asserts a condition.
     *
     * @param bool   $condition
     * @param string $message   Failure message
     *
     * @throws ExpectationException when the condition is not fulfilled
     */
    private function assert($condition, $message)
    {
        if ($condition) {
            return;
        }

        throw new ExpectationException($message, $this->getSession());
    }

    /**
     * @Then I proceed with success CIMB accountID
     */
    public function iProceedWithSuccessCimbAccountid()
    {
        $this->fillField('account', 'testuser00');
        $button = $this->getSession()->getPage()->find('css', 'form[action=payment] button[type=submit]');
        $button->press();
    }

    /**
     * @Given I am on BRI Epay Checkout Form
     */
    public function iAmOnBriEpayCheckoutForm()
    {
        $this->visitPath('/bri_epay/form.html');
    }

    /**
     * @Then I proceed with success BRI Epay accountID
     */
    public function iProceedWithSuccessBRIEpayAccountid()
    {
        $this->fillField('username', 'testuser00');
        $button = $this->getSession()->getPage()->find('css', 'form[action=payment] button[type=submit]');
        $button->press();
    }
}
