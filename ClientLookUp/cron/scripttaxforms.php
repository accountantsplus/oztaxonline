<?php
require_once "encdec.php";
require_once "../php/db.php";
$curref = "";
$curval = "";
try{
    $db_name     = DB_NAME;
    $db_user     = DB_USERNAME;
    $db_password = DB_PASSWORD;
    $db_host     = DB_SERVER;
    $pdo = new PDO('mysql:host=' . $db_host . '; dbname=' . $db_name, $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $file = file_get_contents('../data/UploadTaxForms.txt');
    $members = preg_split('/\r\n|\r|\n/', $file);
	$sql_update = "INSERT INTO lookup(Ref, Status, OccCode, OccDescription, Refund, Estimate, TaxIncome, LodgeDate) VALUES (:ival1, :ival2, :ival3, :ival4, :ival5, :ival6, :ival7, STR_TO_DATE(:ival8,'%d/%m/%Y' )) ON DUPLICATE KEY UPDATE Ref=:uval1, Status=:uval2, OccCode=:uval3, OccDescription=:uval4, Refund=:uval5, Estimate=:uval6, TaxIncome=:uval7, LodgeDate=STR_TO_DATE(:uval8,'%d/%m/%Y')";
	$sql_update2 = "INSERT INTO amended(Ref, Status, OccCode, OccDescription, Refund, Estimate, TaxIncome, LodgeDate) VALUES (:ival1, :ival2, :ival3, :ival4, :ival5, :ival6, :ival7, STR_TO_DATE(:ival8,'%d/%m/%Y' )) ON DUPLICATE KEY UPDATE Ref=:uval1, Status=:uval2, OccCode=:uval3, OccDescription=:uval4, Refund=:uval5, Estimate=:uval6, TaxIncome=:uval7, LodgeDate=STR_TO_DATE(:uval8,'%d/%m/%Y')";
    //$sql_update = "UPDATE lookup SET Status=:uval2,OccCode=:uval3,OccDescription=:uval4,Refund=:uval5,Estimate=:uval6,TaxIncome=:uval7,LodgeDate=STR_TO_DATE(:uval8,'%d/%m/%Y') WHERE Ref=:uval1";
    $stmt = $pdo->prepare($sql_update);
	$stmt2 = $pdo->prepare($sql_update2);
    $pdo->beginTransaction();
	$prevlen = null;
	foreach ($members as $member) {
		$arr = explode('","', $member);
		$len = count($arr);
		if( $len <= 0) break;
		if( !array_key_exists('0', $arr) ) continue;
		$ref = array_key_exists('0', $arr) ? $arr[0] : '';
		if(strlen($ref) <= 0) continue;
		if($ref == '"Ref"') continue;
		if(!is_numeric($arr[0])) continue;
		if(strlen($ref) > 0) {
		    $curref = $ref;
		    $curval = $arr[5];
			if($prevlen == $ref) {
				for($i = 0; $i < 8; $i+=1) {
					$value = array_key_exists($i, $arr) ? $arr[$i] : '';
					$value = str_replace('"', '', $value);
					if($i == 7) {
						$dt = DateTime::createFromFormat('!d/m/Y', $value);
						if($dt instanceof DateTime) $value = $dt->format('d/m/Y');
						else $value = NULL;
					}
					$stmt2->bindValue(':ival'.($i+1), $value);
					$stmt2->bindValue(':uval'.($i+1), $value);
				}
				$res2 = $stmt2->execute();
			} else {
				$prevlen = $ref;
			}
			for($i = 0; $i < 8; $i+=1) {
				$value = array_key_exists($i, $arr) ? $arr[$i] : '';
		    	$value = str_replace('"', '', $value);
				if($i == 7) {
					$dt = DateTime::createFromFormat('!d/m/Y', $value);
					if($dt instanceof DateTime) $value = $dt->format('d/m/Y');
					else $value = NULL;
				}
				$stmt->bindValue(':ival'.($i+1), $value);
		    	$stmt->bindValue(':uval'.($i+1), $value);
			}
			$res = $stmt->execute();
		}
	}
	$pdo->commit();
	$stmt3 = $pdo->query('UPDATE clientupdate SET last_taxforms = NOW()');
	$pdo = null;
} catch (PDOException $ex) {
	echo $curref.' '.$curval.' '.$ex;
}
?>