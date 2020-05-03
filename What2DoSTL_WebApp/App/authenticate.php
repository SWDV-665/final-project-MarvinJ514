<?php
    session_start();
    // Connection Info
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'what2dostl';
    $DATABASE_PASS = '1q2w#E$R1q2w#E$R';
    $DATABASE_NAME = 'phplogin';
    // Try and connect using the info above.
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ( mysqli_connect_errno() ) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    // Now we check if the data from the login form was submitted, isset() will check if the data exists.
    if ( !isset($_POST['email'], $_POST['password']) ) {
        // Could not get the data that should have been sent.
        exit('Please fill both the username and password fields!');
    }
    // Prepare SQL to prevent SQL injection.
    if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE email = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password);
            $stmt->fetch();
            // Account exists, now we verify the password.
            // Note: remember to use password_hash in your registration file to store the hashed passwords.
            //if (password_verify($_POST['password'], $password)) {
            if (password_verify($_POST['password'], $password)){
                // Verification success! User has loggedin!
                // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['email'];
                $_SESSION['id'] = $id;
                //echo 'Welcome ' . $_SESSION['name'] . '!';
                header('Location: ../Pages/UserAccount/UserAccountLogin.php');
            } else {
                //echo 'Incorrect password!';
                header('Location: ../homeFailedLogin.html');
            }
        } else {
            //echo 'Incorrect username!';
            header('Location: ../homeFailedLogin.html');
            
        } 
        $stmt->close();
    }
?>


