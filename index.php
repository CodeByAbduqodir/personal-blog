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
    $title = "Home";
    require_once "base/base_header.php";
?>

        <div class="wrapper">
            <div class="container">
            <ul class="list">
            <?php
                $data = $conn->query("SELECT * FROM blogs")->fetchAll(PDO::FETCH_ASSOC);
                if(count($data) > 0) {
                    foreach($data as $item) {
                        echo "
                        <li class='item list-group-item d-flex justify-content-between align-items-center'>
                        <div>
                        <h2>{$item['postname']}</h2>
                        <p class='mb-0'>{$item['posttext']}</p>
                        </div>
                        <div class='wrap'>
                        <p class='mb-0'>{$item['date']}</p>
                        <form action='single.php' method='post'>
                            <input type='hidden' name='id' value='{$item['id']}'>
                            <button class='btn btn-primary info'>Batafsil</button>
                        </form>
                        </div>
                        </li>";
                    }
                } else {
                    echo "<h1 class='text-center'>Please add a task.</h1>";
                }
            ?>
            </ul>
            </div>
    </div>

<?php 
    require_once "base/base_footer.php";
} ?>

