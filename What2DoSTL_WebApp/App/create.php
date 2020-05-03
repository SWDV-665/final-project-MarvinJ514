<?php
    
    // Connection Info
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'what2dostl_create';
    $DATABASE_PASS = '1q2w#E$R1q2w#E$R';
    $DATABASE_NAME = 'phplogin';
    // Try and connect using the info above.
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno()) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    // Now we check if the data was submitted, isset() function will check if the data exists.
    if (!isset($_POST['email'], $_POST['password'], $_POST['confirm_password'])) {
        // Could not get the data that should have been sent.
        header('Location: ../Pages/UserCreation/UserCreationEmpty.html');
        //exit('Please complete the registration form!');
    }
    // Make sure the submitted registration values are not empty.
    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
        // One or more values are empty.
        header('Location: ../Pages/UserCreation/UserCreationEmpty.html');
        //exit('Please complete the registration form');
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        header('Location: ../Pages/UserCreation/UserCreationInvalidEmail.html');
        //exit('Email is not valid!');
    }
    // We need to check if the account with that username exists.
    if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE email = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        $stmt->store_result();
        // Store the result so we can check if the account exists in the database.
        if ($stmt->num_rows > 0) {
            // Username already exists
            header('Location: ../Pages/UserCreation/UserCreationUnameExists.html');
            //echo 'Username exists, please choose another!';
        } else {
            // Username doesnt exists, insert new account
            if ($stmt = $con->prepare('INSERT INTO accounts (email, password) VALUES (?, ?)')) {
                // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->bind_param('ss', $_POST['email'], $password);
                $stmt->execute();
                $username = $_POST['email'];
                header('Location: ../Pages/UserAccount/UserAccountcreated.php');
                //echo 'You have successfully registered, you can now login!';
            } else {
                // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
                echo 'Could not prepare statement!';
            }
        }
        $stmt->close();
    } else {
        // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
        echo 'Could not prepare statement!';
    }
    $con->close();
?>