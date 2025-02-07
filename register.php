<?php 
$title = "Register";
require_once "base/base_header.php";

require_once "db.php";

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmpassword'])) {
    if($_POST['password'] == $_POST['confirmpassword']) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);

        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        if($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: Could not add user to the database";
        }
    } else {
        echo "Passwords do not match";
    }
}
?>

<div class="container mt-5">
    <form action="register.php" method="post" class="w-50 mx-auto">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="example@mail.ru" required>
        </div>
        <div class="mb-3">
            <label for="inputpassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="inputpassword" placeholder="password" required>
        </div>
        <div class="mb-3">
            <label for="inputpasswordconfirmation" class="form-label">Confirm Password</label>
            <input type="password" name="confirmpassword" class="form-control" id="inputpasswordconfirmation" placeholder="confirm password" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div class="mt-3 text-center">
        <h6 class="text-muted">Already have an account?</h6>
        <a href="login.php" class="btn btn-outline-primary">Login</a><br><br>
    </div>
</div>
<?php
require_once "base/base_footer.php";
?>

