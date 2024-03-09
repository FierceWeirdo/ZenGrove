<?php
if (empty($_POST['page'])) {  
    $display_modal_window = 'none'; 
    include("view_startpage_rhythm.php");
    exit();
} 

include_once("model_rhythm.php");

$page = $_POST['page'];
if ($page == 'start_page') {
    $command = $_POST['command'];
    switch($command) {
        case 'signUp':
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            if(doesUserAlreadyExist($username)) {
                $error_msg_existing_username = '* Username already exists';
                $display_modal_window = 'signUp'; 
                include("view_startpage_rhythm.php");
            }
            else {
                $result = insertUserIntoTable($username, $email, $password);
                if($result){
                    $display_modal_window = 'login'; 
                    include("view_startpage_rhythm.php");
                }
                else{
                    echo"<script> window.alert('Failed'); </script>";
                }
            }
            exit(); 
        case 'login':
            $username = $_POST['username'];
            $password =  $_POST['password'];
            if (areCredentialsValid($username, $password)) {
                session_start();
                $_SESSION['logged_in'] = true;
                include("view_mainpage_rhythm.php");
                exit();
            } else {
                $error_msg_username = '* Wrong username, or';
                $error_msg_password = '* Wrong password'; 
                $display_modal_window = 'login'; 
                include("view_startpage_rhythm.php");
                exit();
            }
        default:
            exit();
    }
    
}
else if ($page == 'main_page') {
    $command = $_POST['command']; 
    switch($command) {
        case 'searchFriends':
            session_unset();
            session_start();
            $_SESSION['logged_in'] = true;
            $term = $_POST['searchTerm'];
            $list_of_friends = search_friends($term);
            $str = "<table class='table-striped'>";
            foreach($list_of_friends as $friend) {
                $str .= '<tr>';
                foreach($friend as $x => $y){
                    $str .= "<td>$y</td>";
                }
                $str .= '</tr>';
            }
            $str .= "</table>";
            echo $str;
            exit();
        case 'logOut':
            session_unset();
            session_destroy();
            $display_modal_window = 'none';
            include('view_startpage_rhythm.php');
            exit();
        default:
            include("view_startpage_rhythm.php");
            exit();
    }
}

else {
    include("view_startpage_rhythm.php"); 
    exit();
}
?>