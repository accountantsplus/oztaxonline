<?php
header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');

require_once "vendor/autoload.php";

use MessageMediaMessagesLib\Models;
use MessageMediaMessagesLib\Exceptions;

$authUserName = 'O1TmbOO8AZFp0aFhsPow';
$authPassword = 'wysv512P0zqqMYSizUhH3SahrVwwb0';
/* You can change this to true when the above keys are HMAC */
$useHmacAuthentication = false;


$content = $_POST['content'];
$phoneNumber = $_POST['number'];

$client = new MessageMediaMessagesLib\MessageMediaMessagesClient($authUserName, $authPassword, $useHmacAuthentication);

$messagesController = $client->getMessages();

$body = new Models\SendMessagesRequest;
$body->messages = array();

$body->messages[0] = new Models\Message;
$body->messages[0]->callbackUrl = 'https://www.policetax.com.au/backend/update_sms';
$body->messages[0]->content = $content;
$body->messages[0]->destinationNumber = $phoneNumber;
$body->messages[0]->deliveryReport = true;
$body->messages[0]->format = Models\FormatEnum::SMS;

try { 
    $result = $messagesController->sendMessages($body); 
    echo json_encode($result); 
} catch (Exceptions\SendMessages400Response $e) { 
    echo 'Caught SendMessages400Response: ', $e->getMessage(), "\n"; 
} catch (MessageMediaMessagesLib\APIException $e) { 
    echo 'Caught APIException: ', $e->getMessage(), "\n"; } 
?>