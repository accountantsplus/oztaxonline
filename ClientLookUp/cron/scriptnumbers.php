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
    
    $file = file_get_contents('../data/UploadNumbers.txt');
    $members = preg_split('/\r\n|\r|\n/', $file);
    $sql_update = "UPDATE lookup SET MobileNo=:uval2 WHERE Ref=:uval1";
    $stmt = $pdo->prepare($sql_update);
    $pdo->beginTransaction();
	foreach ($members as $member) {
		$arr = explode('","', $member);
		$len = count($arr);
		if( $len <= 0) break;
		if( !array_key_exists('0', $arr) ) break;
		$ref = array_key_exists('0', $arr) ? $arr[0] : '';
		if(strlen($ref) <= 0) break;
		if(strlen($ref) > 0) {
			for($i = 0; $i < $len; $i+=1) {
				$value = array_key_exists($i, $arr) ? $arr[$i] : '';
		    	$arr[$i] = str_replace('"', '', $value);
			}
			$stmt->bindValue(':uval1', $arr[0]);
			$stmt->bindValue(':uval2', $arr[1]);
			$res = $stmt->execute();
		}
	}
	$pdo->commit();
	$stmt2 = $pdo->query('UPDATE clientupdate SET last_numbers = NOW()');
	$pdo = null;
} catch (PDOException $ex) {
	echo $ex;
}
?>