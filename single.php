<?php
require_once "base/base_header.php";
require_once "db.php";

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    die("Ошибка: некорректный ID поста.");
}

if (isset($_POST['like'])) {
    $stmt = $conn->prepare("UPDATE blogs SET likes = likes + 1 WHERE id = :id");
    $stmt->execute(['id' => $id]);
    header("Location: single.php?id=" . $id);
    exit;
}

if (isset($_POST['add_comment'])) {
    $commentText = trim($_POST['comment']);
    $userId = $_SESSION['user_id'] ?? null;

    if ($commentText && $userId) {
        $stmt = $conn->prepare("INSERT INTO comments (blog_id, user_id, comment_text) VALUES (:blog_id, :user_id, :comment_text)");
        $stmt->execute([
            'blog_id' => $id,
            'user_id' => $userId,
            'comment_text' => $commentText
        ]);
        header("Location: single.php?id=" . $id);
        exit;
    }
}

$stmt = $conn->prepare("SELECT comments.*, users.email FROM comments 
JOIN users ON comments.user_id = users.id 
WHERE comments.blog_id = :blog_id ORDER BY created_at DESC");
$stmt->execute(['blog_id' => $id]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <?php
            $stmt = $conn->prepare("SELECT * FROM blogs WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC); 

            if ($data): ?>
                <div class='card'>
                    <div class='card-header'>
                        <h2 class='card-title'><?= htmlspecialchars($data['postname']) ?></h2>
                    </div>
                    <div class='card-body'>
                        <p class='card-text'><?= htmlspecialchars($data['posttext']) ?></p>
                        <div class='wrap'>
                            <p class='card-text'><small class='text-muted'><?= $data['date'] ?></small></p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p>No blog post found.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form action="" method="post">
                <button type="submit" name="like" class="btn btn-success">👍 Like (<?= $data['likes'] ?>)</button>
            </form>
            <h3 class="mt-3">Комментарии:</h3>
            <?php if ($comments): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <strong><?= htmlspecialchars($comment['email']) ?>:</strong>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= htmlspecialchars($comment['comment_text']) ?></p>
                            <div class="wrap">
                                <p class="card-text"><small class="text-muted"><?= $comment['created_at'] ?></small></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Комментариев пока нет.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form action="" method="post">
                <div class="form-group">
                    <label for="comment">Комментарий:</label>
                    <textarea name="comment" class="form-control" id="comment" placeholder="Напишите комментарий..." required></textarea>
                </div>
                <button type="submit" name="add_comment" class="btn btn-primary">Добавить</button>
            </form>
        </div>
    </div>
</div>

<?php require_once "base/base_footer.php"; ?>

