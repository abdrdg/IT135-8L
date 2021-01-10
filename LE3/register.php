<html>      
    <head>
    <title>My Online Store</title>  
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/css/foundation.min.css" integrity="sha256-ogmFxjqiTMnZhxCqVmcqTvjfe1Y/ec4WaRj/aQPvn+I=" crossorigin="anonymous">
    <link rel="stylesheet" href="css/register.css?v=<?php echo time(); ?>">
    </head>      
    <body>
        <form action="register.php" method="POST">
        <h2>Registration Page</h2>
        <table>
            <tr>
                <td>Enter Username:
                <td><input type="text" name="username" required="required" />
            </tr>
            <tr>
                <td>Enter Password:
                <td><input type="password" name="password" required="required" />
            </tr>
        </table><br>
        <input type="submit" value="Register"/><br/><br/>
        <a href="login.php">Have an Account? Login Here!</a>
    </body>
</html>

<?php
    // if($_SERVER["REQUEST_METHOD"] == "POST")
    // { 
    //     $username = ($_POST['username']); 
    //     $password = ($_POST['password']); 
    //     echo "Username entered is: " . $username. "<br/>"; 
    //     echo "Password entered is: " . $password;  
    // } 

    if($_SERVER["REQUEST_METHOD"] == "POST") 
    { 
        $username = ($_POST['username']);
        $password = ($_POST['password']);
        $bool = true;$db_name = "deliverydb";  
        $db_username = "root";
        $db_pass = "";  
        $db_host = "localhost";  
        $con = mysqli_connect("$db_host","$db_username","$db_pass", "$db_name") or die(mysqli_error()); //Connect to server
        $query = "SELECT * from users";
        $results = mysqli_query($con, $query); //Query the users table
        
        while($row = mysqli_fetch_array($results)) //display all rows from query
        { 
            $table_users = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished 
            if($username == $table_users) // checks if there are any matching fields
            { 
                $bool = false; // sets bool to false
                Print '<script>alert("Username has been taken!");</script>'; //Prompts the user
                Print '<script>window.location.assign("register.php");</script>'; // redirects to register.php
            } 
        } 
        
        if($bool) // checks if bool is true
        { 
            mysqli_query($con, "INSERT INTO users (username, password) VALUES ('$username','$password')"); //Inserts the value to table users
            Print '<script>alert("Successfully Registered!");</script>'; // Prompts the user
            Print '<script>window.location.assign("register.php");</script>'; // redirects to register.php
        }  
    } 
?>