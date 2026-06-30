<?php
require_once "encdec.php";
require_once "../php/db.php";
try{
    $db_name     = DB_NAME;
    $db_user     = DB_USERNAME;
    $db_password = DB_PASSWORD;
    $db_host     = DB_SERVER;	

    $pdo = new PDO('mysql:host=' . $db_host . '; dbname=' . $db_name, $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    $file = file_get_contents('../data/UploadSQL.txt');
    $members = preg_split('/\r\n|\r|\n/', $file);
    //$sql_update = "INSERT INTO lookup(Ref, FirstName, LastName, Prefix, DOB, TFN, EMail, DateAdded, Status, Refund, Estimate, TaxIncome, LodgeDate, OccDescription, MobileNo, PhoneNo, Street, Suburb, PostCode, State) VALUES (:ival1,:ival2,:ival3,:ival4,STR_TO_DATE(:ival5,'%d/%m/%Y'),:ival6,:ival7,STR_TO_DATE(:ival8,'%d/%m/%Y' ),:ival9,:ival10,:ival11,:ival12,STR_TO_DATE(:ival13,'%d/%m/%Y' ),:ival14,:ival15,:ival16,:ival17,:ival18,:ival19,:ival20) ON DUPLICATE KEY UPDATE Ref=:uval1,FirstName=:uval2,LastName=:uval3,Prefix=:uval4,DOB=STR_TO_DATE(:uval5,'%d/%m/%Y'),TFN=:uval6,EMail=:uval7,DateAdded=STR_TO_DATE(:uval8,'%d/%m/%Y'),Status=:uval9,Refund=:uval10,Estimate=:uval11,TaxIncome=:uval12,LodgeDate=STR_TO_DATE(:uval13,'%d/%m/%Y' ),OccDescription=:uval14,MobileNo=:uval15,PhoneNo=:uval16,Street=:uval17,Suburb=:uval18,PostCode=:uval19,State=:uval20";
	$sql_update = "INSERT INTO lookup(Ref, FirstName, LastName, Prefix, DOB, TFN, EMail, DateAdded, Status, Refund, Estimate, TaxIncome, LodgeDate, OccDescription, MobileNo, PhoneNo, Street, Suburb, PostCode, State) VALUES (:ival1,:ival2,:ival3,:ival4,STR_TO_DATE(:ival5,'%d/%m/%Y'),:ival6,:ival7,STR_TO_DATE(:ival8,'%d/%m/%Y' ),:ival9,:ival10,:ival11,:ival12,STR_TO_DATE(:ival13,'%d/%m/%Y' ),:ival14,:ival15,:ival16,:ival17,:ival18,:ival19,:ival20) ON DUPLICATE KEY UPDATE Ref=:uval1,FirstName=:uval2,LastName=:uval3,Prefix=:uval4,DOB=STR_TO_DATE(:uval5,'%d/%m/%Y'),TFN=:uval6,EMail=:uval7,DateAdded=STR_TO_DATE(:uval8,'%d/%m/%Y'),Status=:uval9,Refund=:uval10,Estimate=:uval11,TaxIncome=:uval12,LodgeDate=STR_TO_DATE(:uval13,'%d/%m/%Y' ),OccDescription=:uval14,MobileNo=:uval15,PhoneNo=:uval16,Street=:uval17,Suburb=:uval18,PostCode=:uval19,State=:uval20";
    $stmt = $pdo->prepare($sql_update);
    $pdo->beginTransaction();
	foreach ($members as $member) {
		$arr = explode(',', $member);
		$len = count($arr);
		if( $len <= 0) break;
		if( !array_key_exists('0', $arr) ) break;
		$ref = array_key_exists('0', $arr) ? $arr[0] : '';
		if(strlen($ref) <= 0) break;
		if(strlen($ref) > 0) {
			for($i = 0; $i < 15; $i+=1) {
				$value = array_key_exists($i, $arr) ? $arr[$i] : '';
		    	$value = str_replace('"', '', $value);
				if($i == 4 || $i == 7 || $i == 12) {
					$dt = DateTime::createFromFormat('!d/m/Y', $value);
					if($dt instanceof DateTime) $value = $dt->format('d/m/Y');
					else $value = NULL;
				}
		    	if($i == 5) $value = encrypt_decrypt('encrypt', $value);
		    	$stmt->bindValue(':ival'.($i+1), $value);
		    	$stmt->bindValue(':uval'.($i+1), $value);
			}
			if($len <= 19) {
				$stmt->bindValue(':ival16', '');
				$stmt->bindValue(':uval16', '');
				for($i = 15; $i < 19; $i+=1) {
					$value = array_key_exists($i, $arr) ? $arr[$i] : '';
					$value = str_replace('"', '', $value);
					$stmt->bindValue(':ival'.($i+2), $value);
					$stmt->bindValue(':uval'.($i+2), $value);
				}
			} else {
				$value16 = array_key_exists(15, $arr) ? $arr[15] : '';
				$value16 = str_replace('"', '', $value16);
				$stmt->bindValue(':ival16', $value16);
				$stmt->bindValue(':uval16', $value16);
				$value20 = array_key_exists($len - 1, $arr) ? $arr[$len - 1] : '';
				$value20 = str_replace('"', '', $value20);
				$stmt->bindValue(':ival20', $value20);
				$stmt->bindValue(':uval20', $value20);
				$value19 = array_key_exists($len - 2, $arr) ? $arr[$len - 2] : '';
				$value19 = str_replace('"', '', $value19);
				$stmt->bindValue(':ival19', $value19);
				$stmt->bindValue(':uval19', $value19);
				$value18 = array_key_exists($len - 3, $arr) ? $arr[$len - 3] : '';
				$value18 = str_replace('"', '', $value18);
				$stmt->bindValue(':ival18', $value18);
				$stmt->bindValue(':uval18', $value18);
				$value17 = array_key_exists($len - 4, $arr) ? $arr[$len - 4] : '';
				$value17 = str_replace('"', '', $value17);
				$stmt->bindValue(':ival17', $value17);
				$stmt->bindValue(':uval17', $value17);
			}
			$res = $stmt->execute();
		}
	}
	$pdo->commit();
	$stmt2 = $pdo->query('UPDATE clientupdate SET last_update = NOW()');
	$pdo = null;
} catch (PDOException $ex) {
}
?>