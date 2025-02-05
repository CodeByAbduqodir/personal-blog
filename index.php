<?php
$servername = "localhost";
$username = "root";
$password = "root1911";

try {
  $conn = new PDO("mysql:host=$servername;dbname=blog", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
}

if (isset($conn)) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style.css">
        <title>Document</title>
    </head>
    <body>
    <header>
        <div class="container">
        <ul>
            <li>
                <a href="/">Home</a>
                <a href="/admin.php">Admin</a>
            </li>
        </ul>
        </div>
    </header>
        <div class="wrapper">
            <div class="container">
            <ul class="list">
            <?php
                $data = $conn->query("SELECT * FROM blogs")->fetchAll(PDO::FETCH_ASSOC);
                if(count($data) > 0) {
                    foreach($data as $item) {
                        echo "
                        <li class='item'>
                        <h2>{$item['postname']}</h2>
                        <p>{$item['posttext']}</p>
                        <div class='wrap'>
                        <p>{$item['date']}</p>
                        <form action='single.php' method='post'>
                            <input type='hidden' name='id' value='{$item['id']}'>
                            <button class='info'>Batafsil</button>
                        </form>
                        </div>
                        </li>";
                    }
                } else {
                    echo "<h1>Please add a task.</h1>";
                }
            ?>
            </ul>
            </div>
    </div>
</body>
</html>
<?php } ?>

