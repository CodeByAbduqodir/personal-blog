<?php 
$title = "Login";
session_start();
require_once "base/base_header.php";
require_once "db.php";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);
    $data = $conn->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'")->fetchAll(PDO::FETCH_ASSOC);
    if(count($data) > 0) {
        $_SESSION['email'] = $email;
        header("Location: personal.php");
    }
}
?>

    <div class="container mt-5">
        <form action="login.php" method="post" class="w-50 mx-auto">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="example@mail.ru">
            </div>
            <div class="mb-3">
                <label for="inputpassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="inputpassword" placeholder="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div class="mt-3 text-center">
            <h6 class="text-muted">Don't have an account yet?</h6>
            <a href="register.php" class="btn btn-outline-primary">Register</a><br><br>
        </div>
    </div>
<?php
require_once "base/base_footer.php";
?>