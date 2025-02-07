<?php
$servername = "localhost";
$username = "root";
$password = "root1911";

try {
    $conn = new PDO("mysql:host=$servername;dbname=blog", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

$title = isset($_POST['title']) ? $_POST['title'] : null;
$text = isset($_POST['text']) ? $_POST['text'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;

$data = $conn->query("SELECT * FROM blogs")->fetchAll(PDO::FETCH_ASSOC);

$byIdTitle = '';
$byIdText = '';
foreach ($data as $item) {
    if ($item['id'] == $id) {
        $byIdTitle = $item['title'];
        $byIdText = $item['text'];
        break;
    }
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
    <form class="form" action="admin.php" method="POST">
        <input type="hidden" value='<?php echo htmlspecialchars($id); ?>' name="newId">
        <input value="<?php echo htmlspecialchars($byIdTitle); ?>" type="text" name="newTitle" placeholder="Sarlavhani yozing">
        <input value="<?php echo htmlspecialchars($byIdText); ?>" type="text" name="newText" placeholder="Text qo'shing">
        <button type="submit">Update task</button>
    </form>
</div>
</body>
</html>
