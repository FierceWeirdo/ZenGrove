<?php

$conn = mysqli_connect('localhost', 'w3rrhythm', 'w3rrhythm136', 'C354_w3rrhythm');
function areCredentialsValid($username, $password) { 
    global $conn;
    $sql = "SELECT * FROM ZenGroveUsers WHERE Username = '$username' AND Password = '$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1)
        return true;
    else
        return false;
}

function insertUserIntoTable($user,$pass, $email){
    global $conn;
    $current_date = date("Ymd"); 
    $sql = "INSERT INTO ZenGroveUsers(Username, Email, Password, Date)  VALUES ('$user', '$email', '$pass', '$current_date')";
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

    $existingFriends = listExistingFriends($id);

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

function listExistingFriends($id){
    global $conn;
    $sql1 = "SELECT Id2 FROM ZenGroveFriends WHERE Id1=$id";
    $result1 = mysqli_query($conn, $sql1);
    
    $sql2 = "SELECT Id1 FROM ZenGroveFriends WHERE Id2=$id";
    $result2 = mysqli_query($conn, $sql2);

    $friends = array();
    
    while ($row = mysqli_fetch_assoc($result1)) {
        $friends[] = $row['Id2'];
    }

    while ($row = mysqli_fetch_assoc($result2)) {
        $friends[] = $row['Id1'];
    }

    return $friends;
}

function getUserProfile($id){
    global $conn;
    $sql = "SELECT * FROM ZenGroveUsers WHERE Id=$id";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function updateDailyProgress($id, $value){
    global $conn;
    $sql = "UPDATE ZenGroveUsers SET DailyProgress = $value WHERE Id=$id";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function getUserId($username){
    global $conn;
    $sql = "SELECT Id FROM ZenGroveUsers WHERE Username='$username'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

?>
