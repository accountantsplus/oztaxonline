<?php
header('Content-type: application/json');

require_once "vendor/autoload.php";

use MessageMediaMessagesLib\Models;
use MessageMediaMessagesLib\Exceptions;

$authUserName = 'O1TmbOO8AZFp0aFhsPow';
$authPassword = 'wysv512P0zqqMYSizUhH3SahrVwwb0';
/* You can change this to true when the above keys are HMAC */
$useHmacAuthentication = false;

$client = new MessageMediaMessagesLib\MessageMediaMessagesClient($authUserName, $authPassword, $useHmacAuthentication);

$repliesController = $client->getReplies();

try {
    $result = $repliesController->checkReplies();
    echo json_encode($result);
} catch (MessageMediaMessagesLib\APIException $e) {
    echo 'Caught APIException: ',  $e->getMessage(), "\n";
}

?>