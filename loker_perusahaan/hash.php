<?php
$password = '123'; // Ganti ini dengan password yang mau di-hash
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Password asli: " . $password . "<br>";
echo "Password hash: " . $hash;
?>
