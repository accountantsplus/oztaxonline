<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-05-09 01:52:16 --> Could not find the language line "zip_code"
ERROR - 2019-05-09 02:17:02 --> Email could not been sent. Mailer Error (Line 179): Could not instantiate mail function.
ERROR - 2019-05-09 02:17:02 --> #0 C:\xampp\htdocs\appo\application\controllers\Appointments.php(575): EA\Engine\Notifications\Email->sendAppointmentDetails(Array, Array, Array, Array, Array, Object(EA\Engine\Types\Text), Object(EA\Engine\Types\Text), Object(EA\Engine\Types\Url), Object(EA\Engine\Types\Email), Object(EA\Engine\Types\Text))
#1 C:\xampp\htdocs\appo\system\core\CodeIgniter.php(532): Appointments->ajax_register_appointment()
#2 C:\xampp\htdocs\appo\index.php(353): require_once('C:\\xampp\\htdocs...')
#3 {main}
