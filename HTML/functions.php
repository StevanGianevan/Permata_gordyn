<?php 

function check_login($con)
{

    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $conn->query("SELECT * FROM users WHERE user_id=$id") or die($conn->error());

        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    //redirect to login
    header("Location: login.php");

}

function random_num()
{
    $text = "";
    
    $len = rand(4, 5);
    for ($i=0; $i < $len; $i++)
    {
        $text .= rand(0,9);
    }
    
    return $text;
}