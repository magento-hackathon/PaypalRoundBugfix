<?php

class Hackathon_PaypalRoundBugfix_Test_Config_RewriteTest
    extends EcomDev_PHPUnit_Test_Case_Config
{
    /**
     * Test wether the Ipn model is rewritten
     *
     * @test
     */
    public function checkRewriteOfIpnModel()
    {
        $this->assertModelAlias(
            'paypal/ipn', 'Hackathon_PaypalRoundBugfix_Model_Paypal_Ipn'
        );

        $model = Mage::getModel('paypal/ipn');
        $this->assertInstanceOf(
            'Hackathon_PaypalRoundBugfix_Model_Paypal_Ipn', $model
        );
    }

    /**
     * Test wether the Redirect Block is rewritten
     *
     * @test
     */
    public function checkRewriteOfRedirectBlock()
    {
        $this->assertBlockAlias(
            'paypal/standard_redirect',
            'Hackathon_PaypalRoundBugfix_Block_Paypal_Standard_Redirect'
        );
    }
}