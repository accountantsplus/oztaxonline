<?php
$obj_amount = (object) [
    'currency_code' => "AUD",
    'amount' => "15",
];
$array_items = array();
$unit_amount = (object) [
    'currency_code' => "AUD",
    'value' => "5",
];
$item = (object) [
    'name' => "my special item",
    'unit_amount' => $unit_amount,
    'quantity' => 3
];
array_push($array_items, $item);
$array_units = array();
$unit = (object) [
    'description' => "my desc",
    'amount' => $obj_amount,
    'items' => $array_items,
];
array_push($array_units, $unit);
$result = (object) [
    'id' => "8LW77109NG614602T",
    'intent' => "CAPTURE",
    'status' => "COMPLETED",
    'purchase_units' => $array_units
];

$json = json_encode($result);
echo $result;
?>