<?php
session_start(); 
if (!isset($_SESSION['email'])) {
    die("Ошибка: пользователь не авторизован.");
}

require_once "base/base_header.php";
require_once "db.php";

$stmt = $conn->prepare("
    SELECT * FROM blogs 
    WHERE user_id = (SELECT id FROM users WHERE email = :email)
");
$stmt->execute(['email' => $_SESSION['email']]);
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['postname']) && isset($_POST['posttext'])) {
    $postname = $_POST['postname'];
    $posttext = $_POST['posttext'];

    $stmtInsert = $conn->prepare("
        INSERT INTO blogs (postname, posttext, user_id) 
        VALUES (:postname, :posttext, (SELECT id FROM users WHERE email = :email))
    ");
    $stmtInsert->execute([
        'postname' => $postname, 
        'posttext' => $posttext, 
        'email' => $_SESSION['email']
    ]);

    header("Location: personal.php");
    exit;
}
?>

<div class="container">
    <form action="personal.php" method="post">
        <div class="mb-3">
            <label for="postname" class="form-label">Post name</label>
            <input type="text" name="postname" class="form-control" id="postname" placeholder="Enter post name">
        </div>
        <div class="mb-3">
            <label for="posttext" class="form-label">Post text</label>
            <textarea name="posttext" class="form-control" id="posttext" placeholder="Enter post text"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <h1 class="mt-3">Your posts</h1>
    <table class="table">
        <tr>
            <th>№</th>
            <th>Title</th>
            <th>Text</th>
            <th>Actions</th>
        </tr>
        <?php if (count($blogs) > 0): ?>
            <?php foreach($blogs as $item): ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td><?= htmlspecialchars($item['postname']) ?></td>
                    <td><?= htmlspecialchars($item['posttext']) ?></td>
                    <td>
                        <a href='single.php?id=<?= $item['id'] ?>' class='btn btn-primary'>Batafsil</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan='4' class='text-center'>Please add a task.</td></tr>
        <?php endif; ?>
    </table>
</div>

<?php require_once "base/base_footer.php"; ?>
