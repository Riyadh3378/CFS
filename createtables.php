<?php
include ('connectdb.php');
// sql to create admins table
$sql = "CREATE TABLE IF NOT EXISTS admins (
  id INT(6) NOT NULL AUTO_INCREMENT,
  admin VARCHAR(12) COLLATE utf32_unicode_ci NOT NULL,
  pass VARCHAR(32) COLLATE utf32_unicode_ci NOT NULL,
  privilege INT(11) NOT NULL,
  addedby VARCHAR(12) COLLATE utf32_unicode_ci NOT NULL,
  addedon DATE NOT NULL,
  temporary DATETIME DEFAULT NULL,
  PRIMARY KEY (id))";

  if ($con->query($sql) === TRUE) {
      echo "Table admins created successfully";
  } else {
      echo "Error creating table: " . $con->error;
  }

// sql to create members table
$sql = "CREATE TABLE IF NOT EXISTS members (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
no INT(6) UNSIGNED,
name VARCHAR(50) NOT NULL,
father VARCHAR(40) NOT NULL,
mother VARCHAR(40) NOT NULL,
sex VARCHAR(6) NOT NULL,
religion VARCHAR(10) NOT NULL,
dob DATE NOT NULL,
blood VARCHAR(6) NOT NULL,
address VARCHAR(80) NOT NULL,
school VARCHAR(40) DEFAULT NULL,
college VARCHAR(40) DEFAULT NULL,
varsity VARCHAR(40) DEFAULT NULL,
job VARCHAR(20) DEFAULT NULL,
mobile VARCHAR(16) NOT NULL,
email VARCHAR(50),
joined DATE NOT NULL
)";

if ($con->query($sql) === TRUE) {
    echo "Table members created successfully";
} else {
    echo "Error creating table: " . $con->error;
}

$con->close();

 ?>
