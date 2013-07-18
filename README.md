#Hackathon_PaypalRoundBugfix

This module rewrites a block of Mage_Paypal. Only the whole BaseGrandTotal is submitted to Paypal now. This works ONLY with "transfer cart line items" set to false.
The Paypal-Response is often in conflict with the order-data. By rewriting the Payment Method there is now a tolerance of less than one cent. It should also be possible with a tolerance of less than half of a cent but I didn't dare to try it on production.
And it removes the functionality to refund orders with paypal, because there are bugs in it.

##For Developers

We rewrite

    Mage_Paypal_Model_Ipn with Hackathon_PaypalRoundBugfix_Model_Paypal_Ipn,
    Mage_Sales_Model_Order_Payment with Hackathon_PaypalRoundBugfix_Model_Order_Payment,
    Mage_Paypal_Block_Standard_Redirect with Hackathon_PaypalRoundBugfix_Block_Paypal_Standard_Redirect,
    Mage_Core_Model_Store with Hackathon_PaypalRoundBugfix_Model_Store.

We know, that rewriting is the worst strategy here. Please tell us, if there are some useful events. We didn't found any. The rewriting of Mage_Core_Model_Store sounds very hard. We must check, if there is another solution for this.

If you don't care about the one Cent and are just annoyed of the "Suspected Fraud"-Status, you ONLY need one class. Just rewrite

    Mage_Sales_Model_Order_Payment with Hackathon_PaypalRoundBugfix_Model_Order_Payment,

and set ``transfer_cart_line_items`` to false.

## Tested
I added two Unittests to be sure that the files are rewritten. Further tests follow. TDD was kind of hard to test Paypal-specific transactions.

##Thanks

Thanks to Andreas Vogt <andreas.vogt@webvisum.de> for the files. He made the work, I (Fabian Blechschmidt <blechschmidt@fabian-blechschmidt.de>) just made a magento module out of it.

##Attention!
This module changes the redirect to paypal and deactivates refunding!
