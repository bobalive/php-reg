<?
ini_set('session.cookie_lifetime', 0);
session_start();

include_once ("helpers/connectDb.php");
include_once ("helpers/config.php");



if( $_SERVER["REQUEST_METHOD"] === 'POST'){
    $_SESSION['is_authorized'] = false;

    $user_email = $_REQUEST['email'];
    $user_password = $_REQUEST['password'];

    if($user_email  === $admin_email && $user_password === $admin_password){
        $_SESSION['is_authorized'] = true;
    }else{
        include_once "auth.html";
    }
    

}
    
if($_SESSION['is_authorized']){
    $limit = 5;
    $page = $_REQUEST['page'];
    $offcet = ($page - 1)* $limit;

    $get_tickets_count =  'SELECT COUNT(*) as tickets_count FROM tickets';
    $rows = mysqli_query($link ,  $get_tickets_count);
    if(!$rows ){
        echo 'failed to get count of tickets '. mysqli_error($link);
    }
    $rows = mysqli_fetch_assoc($rows);
    $tickets_count  = $rows['tickets_count'];


    $page_count = ceil((int)$tickets_count/$limit);
    $next_page = $page+1<=$page_count ? $page+1:$page ;
    $previous_page = $page-1>0?$page-1:$page;

    // echo $page_count;
    // echo '<pre>';
    // print_r($_REQUEST);
    // echo '</pre>';
    $get_users = "SELECT * from tickets LIMIT $limit OFFSET $offcet";
    if (!$tickets =  mysqli_query($link , $get_users)){
        echo 'failed to get tickets '. mysqli_error($link);    
    }
    include 'users.html';
}else{
    include_once "auth.html";
}

