<?php
include("config/db.php");
include("cmd/exec.php");

$db = new Database();
$str_conn = $db->getConnection();
$str_exe = new ExecSQL($str_conn);
$action= $_GET['cmd'];
switch($action){
    case "select":
    $stmt = $str_exe->readAll("user");
    $num_row = $str_exe->rowCount("user");
    //echo json_encode($num_row);
    if ($num_row>0){
        $data_arr['rs'] = array();
        foreach($stmt as $row){
            $item = array(
                'รหัส'=>$row['UserId'],
                'ชื่อผู้ใช้'=>$row['UserName'],
                'รหัสผ่าน'=>$row['Password'],
                'ชื่อ'=>$row['FirstName'],
                'นามสกุล'=> $row['LastName'] 
            );
            array_push($data_arr['rs'],$item);
        }
            echo json_encode($data_arr);
    }else{
        echo json_encode(array('msg'=>'result not format'));
    }
    break;


    case 'insert' :
    $str_UserName = $_GET['UserName'];
    $str_Password = $_GET['Password'];
    $str_FirstName = $_GET['FirstName'];
    $str_LastName = $_GET['LastName'];
    echo $strSQL = $str_exe->insert("user","UserName,Password,FirstName,LastName","'$str_UserName' , '$str_Password','$str_FirstName','$str_LastName' ");
    if($strSQL)echo json_encode(array('msg'=>'Insert OK'));
    else echo json_encode(array('msg'=>'Can not Insert'));
    break;

    case 'update' :      
    $str_UserName = $_GET['UserName'];
    $str_Password = $_GET['Password'];
    $str_FirstName = $_GET['FirstName'];
    $str_LastName = $_GET['LastName'];
    $str_userid = $_GET['id'];
    $stmt = $str_exe->update("user"
    ," UserName = '$str_UserName', Password = '$str_Password', FirstName = '$str_FirstName', LastName = '$str_LastName' "
    ,"where UserId = ".$str_userid);
    if($stmt)echo json_encode(array('msg'=>'Update OK'));
    else echo json_encode(array('msg'=>'Can not Update'));
    break;

    case 'serch' :
    $str_userid = $_GET['id'];
    $stmt = $str_exe->readOne("SELECT * FROM","user","where UserId = ".$str_userid);
    $data_arr['rs'] = array();
    foreach($stmt as $row ){
        $item = array(
            'รหัส'=>$row['UserId'],
            'ชื่อผู้ใช้'=>$row['UserName'],
            'รหัสผ่าน'=>$row['Password'],
            'ชื่อ'=>$row['FirstName'],
            'นามสกุล'=> $row['LastName'] 
        );
        array_push($data_arr['rs'],$item);
        echo json_encode($data_arr)."<br>";
    }      
break;

    case 'delete' :
    $str_userid = $_GET['id'];
    $stmt = $str_exe->readOne("DELETE FROM","user","WHERE UserId = ".$str_userid);
    if($stmt)echo json_encode(array('msg'=>'Delete OK'));
    else echo json_encode(array('msg'=>'Can not Delete'));
    break;
}


?>