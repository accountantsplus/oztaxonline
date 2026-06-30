<?php

         $dbhost = 'localhost';

         $dbuser = 'accoun40_root';

         $dbpass = 'Dusty@0007';

         $dbname = 'accoun40_accounta_police';

         $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

   

         if(! $conn ){

            die('Could not connect: ' . mysqli_error($conn));

         }

         echo 'Connected successfully';

?>