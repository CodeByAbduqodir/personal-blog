<?php
$servername = "localhost";
$username = "root";
$password = "root1911";

try {
  $conn = new PDO("mysql:host=$servername;dbname=blog", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
}
$title = isset($_POST['title']) ? $_POST['title'] : null;
$text = isset($_POST['text']) ? $_POST['text'] : null;
if($text != null) {
    $conn->query("INSERT INTO blogs( title, text ) VALUES ('$title','$text')");
}
$data = $conn->query("SELECT * FROM blogs")->fetchAll(PDO::FETCH_ASSOC);
if (isset($_GET['id'])){
    $id = $_GET['id'];
    var_dump($id);
}
if (isset($_POST['newTitle']) && isset($_POST['newText']) && isset($_POST['newId'])){
    $newTitle = $_POST['newTitle'];
    $newText = $_POST['newText'];
    $id = $_POST['newId'];
    $stmt = $conn->prepare("UPDATE blogs SET title = :title, text = :text WHERE id = :id");
    $stmt->bindParam(':title', $newTitle);
    $stmt->bindParam(':text', $newText);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}
    if (isset($_POST['deleteId'])) {
        $id = $_POST['deleteId'];
        $stmt = $conn->prepare("DELETE FROM blogs WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
   <div class="container">
    <form class="form" action="admin.php" method="post">
        <input type="text" name="title" id="" placeholder="Post name">
        <input type="text" name="text" id="" placeholder="Post text">
        <button class="" type="submit">Add post</button>
    </form>
    <ul>
        <?php
            $data = $conn->query("SELECT * FROM blogs")->fetchAll(PDO::FETCH_ASSOC);
            if(count($data) > 0) {
                foreach($data as $item) {
                    echo "
                    <li class='item'>
                    <h2>{$item['postname']}</h2>
                    <p>{$item['posttext']}</p>
                    <p>{$item['date']}</p>
                    <form action='blog.php' method='post'>
                    <input type='hidden' name='id' value='{$item['id']}'>
                    <button class='edit'>Edit</button>
                    </form>
                    <form action='admin.php' method='post'>
                    <input type='hidden' name='deleteId' value='{$item['id']}'>
                    <button class='delete'>Delete</button>
                    </form>
                    </li>";
                }
            } else {
                echo "<h1>Please add a Blog.</h1>";
            }
            ?>
    </ul>
   </div>
</body>
</html>