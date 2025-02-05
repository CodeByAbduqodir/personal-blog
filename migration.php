<?php
$servername = "localhost";
$username = "root";
$password = "root1911";

try {
    $conn = new PDO("mysql:host=$servername;dbname=blog", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("CREATE TABLE IF NOT EXISTS blog(
  id SERIAL PRIMARY KEY,
  title VARCHAR(128) NOT NULL ,
  text TEXT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
  )");

  $stmt->execute();
  
  echo "Jadval muvaffaqiyatli yaratildi!";
} catch(PDOException $e) {
    echo "Ulanishda xatolik yuz berdi: " . $e->getMessage();
}
?>