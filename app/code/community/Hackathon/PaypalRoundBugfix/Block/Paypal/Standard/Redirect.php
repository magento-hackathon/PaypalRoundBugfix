<?php

class Hackathon_PaypalRoundBugfix_Block_Paypal_Standard_Redirect
    extends Mage_Paypal_Block_Standard_Redirect
{
    protected function _toHtml()
    {
        if (Mage::getStoreConfig('payment/paypal_standard/line_items_enabled')) {
            return parent::_toHtml();
        }

        $standard = Mage::getModel('paypal/standard');

        $form = new Varien_Data_Form();
        $form->setAction($standard->getConfig()->getPaypalUrl())
        ->setId('paypal_standard_checkout')
        ->setName('paypal_standard_checkout')
        ->setMethod('POST')
        ->setUseContainer(true);

        $fields = $standard->getStandardCheckoutFormFields();

        $orderIncrementId = Mage::getModel('checkout/session')->getLastRealOrderId();
        $order = Mage::getModel('sales/order')->loadByIncrementId($orderIncrementId);

        $fields['discount_amount'] =  '0.00';
        $fields['shipping'] =  '0.00';
        $fields['tax'] = '0.00';
        $fields['amount'] = number_format((float) $order->getBaseGrandTotal(),2);


        foreach ($fields as $field => $value) {
            $form->addField(
                $field, 'hidden', array('name' => $field, 'value' => $value)
            );
        }

        $idSuffix = Mage::helper('core')->uniqHash();

        $submitButton = new Varien_Data_Form_Element_Submit(
            array(
                'value' => $this->__(
                    'Click here if you are not redirected within 10 seconds...'
                ),
            )
        );
        $id = "submit_to_paypal_button_{$idSuffix}";
        $submitButton->setId($id);
        $form->addElement($submitButton);
        $html = '<html><body>';
        $html .= $this->__(
            'You will be redirected to the PayPal website in a few seconds.'
        );
        $html .= $form->toHtml();
        $html .= '<script type="text/javascript">' .
        'document.getElementById("paypal_standard_checkout").submit();' .
        '</script>';
        $html .= '</body></html>';

        return $html;
    }
}