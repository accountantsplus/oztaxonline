<?php

         $dbhost = 'localhost';

         $dbuser = 'root';

         $dbpass = 'Abcd@1234';

         $dbname = 'accoun40_accounta_police';

         $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

   

         if(! $conn ){

            die('Could not connect: ' . mysqli_error($conn));

         }

         echo 'Connected successfully';

?>