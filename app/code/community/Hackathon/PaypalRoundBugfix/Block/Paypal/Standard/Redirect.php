<?php

class Hackathon_PaypalRoundBugfix_Block_Paypal_Standard_Redirect
    extends Mage_Paypal_Block_Standard_Redirect
{
    protected function _toHtml()
    {
        $standard = Mage::getModel('paypal/standard');

        $form = new Varien_Data_Form();
        $form->setAction($standard->getConfig()->getPaypalUrl())
        ->setId('paypal_standard_checkout')
        ->setName('paypal_standard_checkout')
        ->setMethod('POST')
        ->setUseContainer(true);

        $fields = $standard->getStandardCheckoutFormFields();

        $sumOne = (float)$fields["amount"] +
        (float)$fields["tax"] - (float)$fields["discount_amount"];

        $sumTwo = 0;
        if (isset($fields["amount_1"])) {
            $sumTwo += (float)$fields["amount_1"];
        }
        if (isset($fields["amount_2"])) {
            $sumTwo += (float)$fields["amount_2"];
        }
        if (isset($fields["amount_3"])) {
            $sumTwo += (float)$fields["amount_3"];
        }
        if (isset($fields["amount_4"])) {
            $sumTwo += (float)$fields["amount_4"];
        }
        if (isset($fields["amount_5"])) {
            $sumTwo += (float)$fields["amount_5"];
        }
        if (isset($fields["amount_6"])) {
            $sumTwo += (float)$fields["amount_6"];
        }
        if (isset($fields["amount_7"])) {
            $sumTwo += (float)$fields["amount_7"];
        }
        if (isset($fields["amount_8"])) {
            $sumTwo += (float)$fields["amount_8"];
        }
        if (isset($fields["amount_9"])) {
            $sumTwo += (float)$fields["amount_9"];
        }
        if (isset($fields["amount_10"])) {
            $sumTwo += (float)$fields["amount_10"];
        }
        $sumTwo += (float)$fields["tax_cart"] -
        (float)$fields["discount_amount_cart"];

        //Wird noch programmatisch gelöst,
        // bisher nur 10 Artikel hardcoded, deshalb Bremse
        if ($sumOne <> $sumTwo && !array_key_exists('amount_11', $fields)) {
            $fields["amount_1"] =
            (string)(float)$fields["amount_1"] + ($sumOne - $sumTwo);
        }

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