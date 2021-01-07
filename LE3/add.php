<?php session_start(); 
    if($_SESSION['user']){}  
    else
    { 
        header("location:index.php");
    }  
    if($_SERVER['REQUEST_METHOD'] = "POST") //Added an if to keep the page secured
    {  
        $details = ($_POST['details']); 
        $time = strftime("%X");//time 
        $date = strftime("%B %d, %Y");//date 
        $decision ="no"; 
        $con = mysqli_connect("localhost", "root", "", "deliverydb") or die(mysqli_error()); //Connect to server 
        foreach($_POST['c'] as $each_check) //gets the data from the checkbox
        {  
            if($each_check !=null )
            { //checks if the checkbox is checked
                $decision = "yes"; //sets the value 
            } 
        } 
        mysqli_query($con, "INSERT INTO list (details, date_posted, time_posted, public) VALUES ('$details','$date','$time','$decision')"); //SQL query 
        header("location: home.php");
    }  
    else
    {  
        header("location:home.php"); //redirects back to home
    } 
?>