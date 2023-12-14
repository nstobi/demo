<?php
$conn = new PDO("mysql:host=localhost;dbname=demo", 'root', '');

// try{
//     $pdo = new PDO("mysql:host=localhost;dbname=demo", 'root', '');
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Connect successfully!";
// } catch (PDOException $e) {
//     echo "Error: " . $e->getMessage();
// }