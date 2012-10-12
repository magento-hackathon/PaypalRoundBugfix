#Hackathon_PaypalRoundBugfix

This module rewrites a block of Mage_Paypal to change the rounded values of the order to prevent the paypal cent bug.

And it removes the functionality to refund orders with paypal, because there are bugs in it.

##For Developers

We rewrite

    Mage_Paypal_Model_Ipn with Hackathon_PaypalRoundBugfix_Model_Paypal_Ipn
and

    Mage_Paypal_Block_Standard_Redirect with Hackathon_PaypalRoundBugfix_Block_Paypal_Standard_Redirect

## Tested
I added two Unittests to be sure that the files are rewritten

For found bugs, I use TDD, so first write a test which fails and is ok after the fix.

##Thanks

Thanks to Andreas Vogt <andreas.vogt@webvisum.de> for the files. He made the work, I (Fabian Blechschmidt <blechschmidt@fabian-blechschmidt.de>) just made a magento module out of it.

##Attention!
This module changes the redirect to paypal and deactivates refunding!