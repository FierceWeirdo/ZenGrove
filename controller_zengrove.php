<?php
include('model_zengrove.php');

if(!isset($_POST['Page'])){
    include("welcome_page_zengrove.php");
}
else{
    $page = $_POST['Page'];
    $command = $_POST['Command'];
    
    switch ($command){
        case 'ShowHomePage':
            include("home_page_zengrove.php");
            break;
        case 'ShowMyZenMates':
            include("my_zenmates_zengrove.php");
            break;
        case 'ShowMyProfile':
            include("my_profile_zengrove.php");
            break;
    }

    if($page == 'WelcomePage'){
        switch($command){
            case 'LogIn':
                $username = $_POST['username'];
                $password = $_POST['password'];
                if(areCredentialsValid($username, $password)){
                    session_start();
                    include("main_page_zengrove.php");
                }
                else{
                    include("welcome_page_zengrove.php");
                }
                break;
            case 'SignUp':
                $username = $_POST['username'];
                $password = $_POST['password'];
                $email = $_POST['email'];
                if(insertUserIntoTable($username, $password, $email)){
                    session_start();
                    include("main_page_zengrove.php");
                }
                else{
                    include("welcome_page_zengrove.php");
                    echo "<script>alert('Failed');</script>";
                }
                break;
        }
    
    }    
}

?>