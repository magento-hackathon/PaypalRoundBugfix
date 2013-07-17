<?php
/**
 * Created by IntelliJ IDEA.
 * User: Richard.Vogel
 * Date: 14.06.13
 * Time: 08:42
 * To change this template use File | Settings | File Templates.
 */

class Hackathon_PaypalRoundBugfix_Model_Order_Payment extends Mage_Sales_Model_Order_Payment
{

    /**
     * Decide whether authorization transaction may close (if the amount to capture will cover entire order)
     * @param float $amountToCapture
     * @return bool
     */
    protected function _isCaptureFinal($amountToCapture)
    {
        if (parent::_isCaptureFinal($amountToCapture)) {
            return true;
        }

        $amountToCapture = $this->_formatAmount($amountToCapture, true);
        $orderGrandTotal = $this->_formatAmount($this->getOrder()->getBaseGrandTotal(), true);

        if (abs($orderGrandTotal - ($this->_formatAmount($this->getBaseAmountPaid(), true) + $amountToCapture)) <= 0.01) {
            if (false !== $this->getShouldCloseParentTransaction()) {
                $this->setShouldCloseParentTransaction(true);
            }
            return true;
        }
        return false;
    }
}