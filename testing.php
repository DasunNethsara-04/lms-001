<?php

$pwd = "amal";
$pwd = password_hash($pwd, PASSWORD_DEFAULT);
echo $pwd;

?>