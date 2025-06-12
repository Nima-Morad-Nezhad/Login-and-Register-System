<?php
include 'db.php';
include './partials/header.php';
session_start();
if(isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE username='$username'   LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            echo "<p>Invalid password!</p>";
        }
    } else {
        echo "<p>Username not found!</p>";
    }
}
?>

 <h2>Login</h2>
   
<form method="POST" action="">
     <label for="username">Username:</label><br>
    <input type="text" name="username" id="username" required><br><br>
    
    <label for="password">Password:</label><br>
    <input type="password" name="password" id="password" required><br><br>
    
    
    <button type="submit" value="Sign in">Sign in</button>

<?php
include "./partials/footer.php";
?>
