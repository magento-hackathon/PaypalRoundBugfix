<?php
/**
 * Created by IntelliJ IDEA.
 * User: Richard.Vogel
 * Date: 17.07.13
 * Time: 15:37
 * To change this template use File | Settings | File Templates.
 */

class Hackathon_PaypalRoundBugfix_Model_Store extends Mage_Core_Model_Store
{
    /**
     * Round price
     *
     * @param mixed $price
     * @return double
     */
    public function roundPrice($price)
    {
        return round($price, 4);
    }

}