<?php
include ('model_zengrove.php');
session_start();

if (!isset ($_POST['Page'])) {
    include ("welcome_page_zengrove.php");
} else {
    $page = $_POST['Page'];
    $command = $_POST['Command'];
    switch ($command) {
        case 'ShowHomePage':
            include ("home_page_zengrove.php");
            break;
        case 'ShowMyZenMates':
            include ("my_zenmates_zengrove.php");
            break;
        case 'ShowMyProfile':
            include ("my_profile_zengrove.php");
            break;
    }

    if ($page == 'WelcomePage') {
        switch ($command) {
            case 'LogIn':
                $username = $_POST['username'];
                $password = $_POST['password'];
                if (areCredentialsValid($username, $password)) {
                    $id = getUserId($username);
                    $_SESSION['UserId'] = $id;
                    include ("main_page_zengrove.php");
                } else {
                    $_SESSION['LoginError'] = true;
                    include ("welcome_page_zengrove.php");
                }
                break;
            case 'SignUp':
                $username = $_POST['username'];
                $password = $_POST['password'];
                $email = $_POST['email'];
                if (preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
                    if (!doesUserAlreadyExist($username)) {
                        if (insertUserIntoTable($username, $password, $email)) {
                            $id = getUserId($username);
                            $_SESSION['UserId'] = $id;
                            include ("main_page_zengrove.php");
                        } else {
                            include ("welcome_page_zengrove.php");
                        }
                    } else {
                        $_SESSION['SignUpError'] = true;
                        include ("welcome_page_zengrove.php");
                    }
                } else {
                    $_SESSION['SignUpUsernameError'] = true;
                    include ("welcome_page_zengrove.php");
                }
                break;
        }
    } else if ($page == 'MyProfile') {
        switch ($command) {
            case 'GetUserProfile':
                $id = $_SESSION['UserId'];
                $profileArr = getUserProfile($id);
                if ($profileArr) {
                    $profileUsername = $profileArr['Username'];
                    $profileDailyGoal = $profileArr['DailyGoal'];
                    $profileZenMedals = $profileArr['ZenMedals'];

                    $response = array(
                        'username' => $profileUsername,
                        'daily_goal' => $profileDailyGoal,
                        'zen_medals' => $profileZenMedals
                    );

                    $jsonResponse = json_encode($response);

                    echo $jsonResponse;
                }
                break;
            case 'ChangeUsername':
                $id = $_SESSION['UserId'];
                $newUsername = $_POST['NewUsername'];
                if (!doesUserAlreadyExist($newUsername)) {
                    if (preg_match('/^[a-zA-Z0-9_]{3,20}$/', $newUsername)) {
                        updateUsername($id, $newUsername);
                        echo 1;
                    } else {
                        echo 2;
                    }
                } else {
                    echo 3;
                }
                break;
            case 'ChangeDailyGoal':
                $id = $_SESSION['UserId'];
                $newDailyGoal = $_POST['NewDailyGoal'];
                updateDailyGoal($id, $newDailyGoal);
                echo "$newDailyGoal minutes";
                break;
            case 'LogOut':
                session_unset();
                session_destroy();
                include ('welcome_page_zengrove.php');
                break;
            case 'DeleteProfile':
                $id = $_SESSION['UserId'];
                //Get rid of all friends rows
                deleteFriendRelationshipsByUserId($id);
                //Get rid of all messages with friends
                deleteMessagesByUserId($id);
                deleteUserProfile($id);
                session_unset();
                session_destroy();
                include ('welcome_page_zengrove.php');
                break;
            case 'ChangePassword':
                $id = $_SESSION['UserId'];
                $oldPassword = $_POST['OldPassword'];
                $newPassword = $_POST['NewPassword'];
                $userPassword = getUserProfile($id)['Password'];
                $hashedOldPassword = hash('sha1', $oldPassword);
                $hashedNewPassword = hash('sha1', $newPassword);
                if ($userPassword == $hashedOldPassword) {
                    updatePassword($id, $hashedNewPassword);
                    echo 'Password has been changed!';
                } else {
                    echo 'Incorrect Old Password';
                }
                break;
        }
    } else if ($page == 'MainPage') {
        switch ($command) {
            case 'GetDailyProgress':
                $id = $_SESSION['UserId'];
                $lastMeditatedTodayBool = checkUserActivityDate($id);
                if ($lastMeditatedTodayBool) {
                    $progress = getUserProfile($id)['DailyProgress'];
                } else {
                    $progress = 0;
                    updateDailyProgress($id, 0);
                }
                echo $progress;
                break;
            case 'UpdateDailyProgress':
                $id = $_SESSION['UserId'];
                $time = $_POST['TimeSpentMeditating'];
                updateDailyProgress($id, $time);
                $progress = getUserProfile($id)['DailyProgress'];
                echo $progress;
                break;
            case 'LogOut':
                session_unset();
                session_destroy();
                include ('welcome_page_zengrove.php');
                break;
        }
    } else if ($page == 'MyZenMates') {
        switch ($command) {
            case 'GetAllZenMates':
                $id = $_SESSION['UserId'];
                $arrayOfZenMates = getAllZenMatesUsernames($id);
                if (!empty ($arrayOfZenMates)) {
                    $str = '';
                    foreach ($arrayOfZenMates as $zenMate) {
                        $str .= "<tr><td>$zenMate</td></tr>";
                    }
                    echo $str;
                } else {
                    echo "No Zen Mates found";
                }
                break;
            case 'GetUserProfile':
                $username = $_POST['Username'];
                $id = getUserId($username);
                $profileArr = getUserProfile($id);
                if ($profileArr) {
                    $enterDate = $profileArr['Date'];
                    $dailyGoal = $profileArr['DailyGoal'];
                    $zenMedals = $profileArr['ZenMedals'];

                    $response = array(
                        'enterDate' => $enterDate,
                        'dailyGoal' => $dailyGoal,
                        'zenMedals' => $zenMedals
                    );

                    $jsonResponse = json_encode($response);

                    echo $jsonResponse;
                }else{
                    $response = array(
                        'enterDate' => 'No Data',
                        'dailyGoal' => 'No Data',
                        'zenMedals' => 'No Data'
                    );

                    $jsonResponse = json_encode($response);

                    echo $jsonResponse;
                }
                break;
            case 'GetMessagesWithUser':
                $username = $_POST['Username'];
                $id = $_SESSION['UserId'];
                $id2 = getUserId($username);
                if($id2){
                    $tableString = getMessagesTable($id, $id2);
                    echo $tableString;
                }
                else{
                    echo 'No Messages Found';
                }
                break;
            case 'SendMessage':
                $username = $_POST['Username'];
                $message = $_POST['Message'];
                $id = $_SESSION['UserId'];
                $id2 = getUserId($username);
                insertMessageIntoTable($id, $id2, $message);
                $tableString = getMessagesTable($id, $id2);
                echo $tableString;
                break;
            case 'SearchUsers':
                $searchTerm = $_POST['Term'];
                $id = $_SESSION['UserId'];
                $arrayOfSearchUsers = searchZenUsers($id, $searchTerm);
                if (!empty ($arrayOfSearchUsers)) {
                    $str = '';
                    foreach ($arrayOfSearchUsers as $zenUser) {
                        $str .= "<tr><td>$zenUser</td><td><button data-username=$zenUser class='addZenMate'>Add ZenMate</button></td></tr>";
                    }
                    echo $str;
                } else {
                    echo "No Zen Mates found";
                }
                break;
            case 'AddZenMate':
                $id = $_SESSION['UserId'];
                $searchUsername = $_POST['SearchTerm'];
                $searchUsernameId = getUserId($searchUsername);
                $result = addZenMate($id, $searchUsernameId);
                break;
        }
    }
}

?>