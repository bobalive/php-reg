<?php
$fileId = $_GET['id']; // ID файла, который нужно скачать

include_once 'helpers/connectDb.php';

$sql = "SELECT * from tickets WHERE id = $fileId";

if(!$result =  mysqli_query($link, $sql)){
    echo "error can not download files";
}
else{

$result  = mysqli_fetch_assoc($result);
$fileName = $result['fileName'];
$fileType = $result['file_type'];
$fileData = $result['file'];


    header("Content-Type: $fileType");
    header("Content-Disposition: attachment; filename=$fileName");
    echo $fileData;
}

mysqli_stmt_close($stmt);
mysqli_close($connection);
?>