<?php

use Behat\Behat\Context\Context;

class FeatureContext implements Context {

    /**
     * @Given there is a response
     */
    public function thereIsAResponse()
    {
        echo 123;
    }
	
}
