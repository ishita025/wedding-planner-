<!-- register.php -->
include 'connect.php';
<?php

if(isset($_POST['signUp'])){
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // You should consider using a more secure hashing algorithm

    try {
        // Prepare SQL statement to insert data without specifying the 'id' column
        $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (:firstName, :lastName, :email, :password)");
        // Bind parameters
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        // Execute the query
        $stmt->execute();
        
        header("location: index.php"); // Redirect to index.php after successful signup
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}



if(isset($_POST['signIn'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    try {
        // Prepare SQL statement to fetch user data
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        // Bind parameters
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        // Execute the query
        $stmt->execute();
        
        // Check if user exists
        if($stmt->rowCount() > 0){
             session_start();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             $_SESSION['email'] = $row['email'];
             header("Location: index.html"); // Redirect to index.php after successful login
             exit();
        } else {
             echo "Not Found, Incorrect Email or Password";
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
 }
 
?>
