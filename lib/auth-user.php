<?php 

    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user_mgmt WHERE name = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            // session_start();
            // $_SESSION['logged_in'] = true;
            header('Location: dashboard.php');
            exit;
            
        } else {
            echo "Invalid username or password.";
        }
    }
?>  