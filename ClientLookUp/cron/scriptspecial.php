<?php
require_once "encdec.php";
require_once "../php/db.php";
try{
    $file = file_get_contents('../data/UploadClients.txt');
    $file = str_replace('"', '', $file);
    $clients = array();
    $members = preg_split('/\r\n|\r|\n/', $file);
	foreach ($members as $member) {
		$arr = explode(',', $member);
		$len = count($arr);
		if( $len <= 0) break;
		if( !array_key_exists('0', $arr) ) break;
		$ref = array_key_exists('0', $arr) ? $arr[0] : '';
		if(strlen($ref) <= 0) break;
		if(strlen($ref) > 0) {
			array_push($clients, $arr);
		}
	}


    $file2 = file_get_contents('../data/UploadTaxForms.txt');
    $file2 = str_replace('"', '', $file2);
    $clients2 = array();
    $members2 = preg_split('/\r\n|\r|\n/', $file2);
	foreach ($members2 as $member2) {
		$arr = explode(',', $member2);
		$len = count($arr);
		if( $len <= 0) break;
		if( !array_key_exists('0', $arr) ) break;
		$ref = array_key_exists('0', $arr) ? $arr[0] : '';
		if(strlen($ref) <= 0) break;
		if(strlen($ref) > 0) {
			array_push($clients2, $arr);
		}
	}
	$clientrefs = array();
	$taxformrefs = array();
	foreach ($clients as $client) {
		array_push($clientrefs, $client[0]);
	}
	foreach ($clients2 as $client2) {
		array_push($taxformrefs, $client2[0]);
	}
	//print_r(array_count_values($taxformrefs));
	$result = array_diff($clientrefs, $taxformrefs);
	print_r($result);
	$result2 = array_diff($taxformrefs, $clientrefs);
	print_r($result2);


	/*
	echo "clientrefs<br>";
	foreach ($clientrefs as $ref) {
		if (!in_array($ref, $taxformrefs)) {
		    echo $ref."<br>";
		}
	}
	echo "taxformrefs<br>";
	foreach ($taxformrefs as $ref) {
		if (!in_array($ref, $clientrefs)) {
		    echo $ref."<br>";
		}
	}
	echo count($clients)." ".count($clients2);
	echo count($clientrefs)." ".count($taxformrefs);*/
} catch (PDOException $ex) {
	echo $ex;
}
?>