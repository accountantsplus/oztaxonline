<?php
$merchantId="AV00010";
$dateFormat="YmdHis"; //set the date format
  $timeNdate=gmdate($dateFormat, time()); //get GMT date - 4
//echo $timeNdate;
$str = "AV00010|w1VKorgi|0|Test Reference|1.00|" . $timeNdate;
$timeStampValue= sha1($str);
?>
<form method="post" action="https://transact.nab.com.au/live/directpostv2/authorise">
<input type="hidden" name="EPS_MERCHANT" value="<?php echo($merchantId);?>">
<input type="hidden" name="EPS_TXNTYPE" value="0">
<input type="hidden" name="EPS_REFERENCEID" value="Test Reference">
<input type="hidden" name="EPS_AMOUNT" value="1.00">
<input type="hidden" name="EPS_TIMESTAMP" value="<?php echo($timeNdate);?>">
<input type="hidden" name="EPS_FINGERPRINT" value="<?php echo($timeStampValue);?>">
<input type="hidden" name="EPS_EMAILADDRESS" value="creditcard@policetax.com.au">
<input type="hidden" name="EPS_REDIRECT" value="TRUE">
<input type="hidden" name="EPS_RESULTURL" value="https://www.policetax.com.au/new-standard-tax.html?returnval=5b64216325774">
<input type="text" name="EPS_CARDNUMBER" value="4444333322221111">
<input type="text" name="EPS_EXPIRYMONTH" value="10">
<input type="text" name="EPS_EXPIRYYEAR" value="2018">
<input type="text" name="EPS_CCV" value="123">

<input type="submit" value="Submit">
</form>