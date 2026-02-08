// test-connection.php (in root folder)
   <?php
   require_once 'config/database.php';
   
   $db = new Database();
   echo "Database connected successfully!";
   ?>