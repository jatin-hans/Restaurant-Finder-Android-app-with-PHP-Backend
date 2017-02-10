<?php
$con=mysqli_connect(

/* Host Name */               "localhost",

/* Data Base User Name */     "root",

/* Data Base Password */      "",

/* Data Base Name  */         "db_restaurant"

);
if($con){ }  else { ?> <script>alert("Connection Error try again !!");</script> <?php } ?>