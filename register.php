<?php 
include 'db.php';
include './partials/header.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $email =mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $confirm_password =mysqli_real_escape_string($conn,$_POST['confirm_password']);

    if ($password !== $confirm_password) {
        echo "<p >Passwords do not match!</p>";
    } else {
      $check_username_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
      $sresult = mysqli_query($conn, $check_username_query);
      if (mysqli_num_rows($sresult) === 1) {
          echo "<p>Username already exists!</p>";
      } else {
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          $insert_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
          if (mysqli_query($conn, $insert_query)) {
              echo "<p>Registration successful!</p>";
          } else {
              echo "<p>Error: " . mysqli_error($conn) . "</p>";
          }
      }
    }
}

?>
    <h2>Register</h2>
   
<form method="POST" action="">
     <label for="username">Username:</label><br>
    <input type="text" name="username" id="username" required><br><br>
    
    <label for="email">Email:</label><br>
    <input type="email" name="email" id="email" required><br><br>
    
    <label for="password">Password:</label><br>
    <input type="password" name="password" id="password" required><br><br>
    
    <label for="confirm_password">Confirm Password:</label><br>
    <input type="password" name="confirm_password" id="confirm_password" required><br><br>
    
    <button type="submit" value="Sign up">Register</button>

<?php
include "./partials/footer.php";
?>