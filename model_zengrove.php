<?php

$conn = mysqli_connect('localhost', 'w3rrhythm', 'w3rrhythm136', 'C354_w3rrhythm');
function areCredentialsValid($username, $password) { 
    global $conn;
    $sql = "SELECT * FROM ZenGroveUsers WHERE Username = '$username' AND Password = '$password'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) == 1)
        return true;
    else
        return false;
}

function insertUserIntoTable($user,$pass, $email){
    global $conn;
    $current_date = date("Ymd"); 
    $yesterday_date = date("Ymd", strtotime("-1 days"));
    $sql = "INSERT INTO ZenGroveUsers(Username, Email, Password, Date, DateofLastMeditation)  VALUES ('$user', '$email', '$pass', '$current_date', '$yesterday_date')";
    $result = mysqli_query($conn, $sql);
    return $result;
};
    
function doesUserAlreadyExist($username){
    global $conn;
    $sql = "SELECT * FROM ZenGroveUsers WHERE Username = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) >= 1)
        return true;
    else
        return false;
}

function searchNewFriends($term, $id) {
    global $conn;
    $sql = "SELECT Username FROM ZenGroveUsers WHERE Username LIKE '%$term%' AND id != $id";
    $result = mysqli_query($conn, $sql);
    $list = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row['Username'];
    }

    $existingFriends = listExistingFriendsId($id);

    $list = array_diff($list, $existingFriends);

    return $list;
}

function addZenMedal($id){
    global $conn;
    $sql = "UPDATE ZenGroveUsers SET ZenMedals = ZenMedals + 1 WHERE Id=$id";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function updateUsername($id, $newUsername){
    global $conn;
    $sql = "UPDATE ZenGroveUsers SET Username = '$newUsername' WHERE Id=$id";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function updateDailyGoal($id, $newDailyGoal){
    global $conn;
    $sql = "UPDATE ZenGroveUsers SET DailyGoal = $newDailyGoal WHERE Id=$id";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function deleteAccount($id){
    global $conn;
    $sql = "DELETE FROM ZenGroveUsers WHERE Id=$id";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function listExistingFriendsId($id){
    global $conn;
    $sql1 = "SELECT UserId2 FROM ZenGroveFriends WHERE UserId1=$id";
    $result1 = mysqli_query($conn, $sql1);
    
    $sql2 = "SELECT UserId1 FROM ZenGroveFriends WHERE UserId2=$id";
    $result2 = mysqli_query($conn, $sql2);

    $friends = array();
    if ($result1 && $result2){
        while ($row = mysqli_fetch_assoc($result1)) {
            $friends[] = $row['UserId2'];
        }

        while ($row = mysqli_fetch_assoc($result2)) {
            $friends[] = $row['UserId1'];
        }
        return $friends;
    }

    else return [];
    
}

function getAllZenMatesUsernames($id){
    $friendsIdArray = listExistingFriendsId($id);
    $listOfUsernames = [];

    foreach ($friendsIdArray as $friendId){
        $listOfUsernames[] = getUserProfile($friendId)['Username'];
    }

    return $listOfUsernames;
}

function getUserProfile($id){
    global $conn;
    $sql = "SELECT * FROM ZenGroveUsers WHERE Id=$id";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function updateDailyProgress($id, $timeSpentMeditating){
    global $conn;
    $dailyProgress = getUserProfile($id)['DailyProgress'];
    if ($timeSpentMeditating == 0){
        $sql = "UPDATE ZenGroveUsers SET DailyProgress = 0 WHERE Id=$id";
        $result = mysqli_query($conn, $sql);
        return $result;
    }
    else {
        $current_date = date("Ymd");
        $sql = "UPDATE ZenGroveUsers SET DateOfLastMeditation = $current_date WHERE Id=$id";
        $result = mysqli_query($conn, $sql);
        if ($dailyProgress !=100) {
            $dailyGoal = getUserProfile($id)['DailyGoal'];
            $value = ($timeSpentMeditating / $dailyGoal) * 100;
            $value += $dailyProgress;
            if ($value>=100){
                $sql = "UPDATE ZenGroveUsers SET DailyProgress = 100 WHERE Id=$id";
                $result = mysqli_query($conn, $sql);
                updateZenMedals($id);
                return $result;
            }
            else{
                $sql = "UPDATE ZenGroveUsers SET DailyProgress= $value WHERE Id=$id";
                $result = mysqli_query($conn, $sql);
                return $result;
            }
        }
        else {
            return true;
        }
    }
}

function getUserId($username){
    global $conn;
    $sql = "SELECT Id FROM ZenGroveUsers WHERE Username='$username'";
    $result = mysqli_query($conn, $sql);
    if ($result){
        return mysqli_fetch_assoc($result)['Id'];
    }
    else{
        return false;
    }
}

function updateZenMedals($id){
    global $conn;
    $sql = "UPDATE ZenGroveUsers SET ZenMedals= ZenMedals + 1 WHERE Id=$id";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function checkUserActivityDate($id){
    global $conn;
    $sql = "SELECT DateOfLastMeditation FROM ZenGroveUsers WHERE Id=$id";
    $result = mysqli_query($conn, $sql);
    $dateOfLastMeditation = mysqli_fetch_assoc($result)['DateOfLastMeditation'];
    $current_date = date("Ymd"); 
    if ($current_date == $dateOfLastMeditation){
        return true;
    }
    else {
        return false;
    }
}

function deleteUserProfile($id){
    global $conn;
    $sql = "DELETE FROM ZenGroveUsers WHERE Id=$id";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function getMessagesBetweenUsers($id1, $id2){
    global $conn;
    $sql = "SELECT * FROM ZenGroveMessages WHERE (SenderId = $id1 AND ReceiverId = $id2) OR (SenderId = $id2 AND ReceiverId = $id1)  ORDER BY Timestamp";
    $result = mysqli_query($conn, $sql);
    $list = [];
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $list[] = $row;
        }
        return $list;
    }
    else{
        return [];
    }
    
}

function getMessagesTable($id1, $id2) {
    $messages = getMessagesBetweenUsers($id1, $id2);
    $table = '';
    foreach ($messages as $message) {
        $table .= '<tr>';
        $table .= '<td><b>' . getUserProfile($message['SenderId'])['Username'] . ': </b> ' . $message['Message'] . '</td>';
        $table .= '<td>' . $message['Timestamp'] . '</td>';
        $table .= '</tr>';
    }
    return $table;
}

function insertMessageIntoTable($senderId, $receiverId, $message){
    global $conn;
    $timestamp = date("Y-m-d H:i:s");
    $sql = "INSERT INTO ZenGroveMessages(SenderId, ReceiverId, Message, Timestamp) VALUES ($senderId, $receiverId, '$message', '$timestamp')";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function updatePassword($id, $password){
    global $conn;
    $sql = "UPDATE ZenGroveUsers SET Password= '$password' WHERE Id=$id";
    $result = mysqli_query($conn, $sql);
    return $result;
}


function searchZenUsers($id, $username) {
    global $conn;
    $sql = "SELECT Username FROM ZenGroveUsers WHERE Username LIKE '%$username%'";
    $existingFriends = getAllZenMatesUsernames($id);
    $result = mysqli_query($conn, $sql);
    $list = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row['Username'];
    }

    $list = array_diff($list, $existingFriends);
    $currentUser[0] = getUserProfile($id)['Username'];
    $list = array_diff($list, $currentUser);

    return $list;
}

function addZenMate($id1, $id2) {
    global $conn;
    $sql = "INSERT INTO ZenGroveFriends(UserId1, UserId2) VALUES ($id1, $id2)";
    $result = mysqli_query($conn, $sql);
    return $result;
}
?>