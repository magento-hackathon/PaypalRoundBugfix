<?php

class Hackathon_PaypalRoundBugfix_Model_Paypal_Ipn
    extends Mage_Paypal_Model_Ipn
{

    /**
     * Process a refund or a chargeback
     */
    protected function _registerPaymentRefund()
    {
        $this->_order->addStatusHistoryComment(
            Mage::helper('paypal')->__(
                'Manuelle Erstattung via Paypal ist erfolgt.'
            )
        )->setIsCustomerNotified(true)->save();
    }

}
