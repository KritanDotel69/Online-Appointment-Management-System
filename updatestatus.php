<?php
include "DBconnect.php";

if(isset($_POST['id']) && isset($_POST['action'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $action = $_POST['action'] === 'approve' ? 'Approved by Admin' : 'Rejected by Admin';

    $sql = "UPDATE booking SET Status='$action' WHERE Timestamp='$id'";
    if(mysqli_query($conn, $sql)){
        echo "Success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>