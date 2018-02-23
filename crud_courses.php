<?php
include("config/db.php");
include("cmd/exec.php");

$db = new Database();
$str_conn = $db->getConnection();
$str_exe = new ExecSQL($str_conn);
$action= $_GET['cmd'];
switch($action){
    case "select":
    $stmt = $str_exe->readAll("courses");
    $num_row = $str_exe->rowCount("courses");
    //echo json_encode($num_row);
    if ($num_row>0){
        $data_arr['rs'] = array();
        foreach($stmt as $row){
            $item = array(
                'code'=>$row['code'],
                'name'=>$row['name'],
                'speaker_name'=>$row['speaker_name'],
                'img_path'=>$row['img_path'],
                'detail'=> $row['detail'],
                'course_outline'=>$row['course_outline'],
                'date_open'=>$row['date_open'],
                'date_end'=>$row['date_end'],
                'place'=>$row['place'],
                'seat_num'=>$row['seat_num'],
                'cost'=>$row['cost'],
                'comment'=>$row['comment'],
                'count_view_page'=>$row['count_view_page'],
                'status'=>$row['status'],
            );
            array_push($data_arr['rs'],$item);
        }
            echo json_encode($data_arr);
    }else{
        echo json_encode(array('msg'=>'result not format'));
    }
    break;

    case 'insert' :
    $name = $_GET['name'];
    $speaker_name = $_GET['speaker_name'];
    $detail = $_GET['detail'];
    $img_path = $_GET['img_path'];
    $course_outline = $_GET['course_outline'];
    $date_open = $_GET['date_open'];
    $date_end = $_GET['date_end'];
    $place = $_GET['place'];
    $seat_num = $_GET['seat_num'];
    $cost = $_GET['cost'];
    $comment = $_GET['comment'];
    $count_view_page = $_GET['count_view_page'];
    $status = $_GET['status'];

    $strSQL = $str_exe->insert("courses",
    "name,speaker_name,img_path,detail,course_outline,date_open,date_end,place,seat_num,cost,comment,count_view_page,status",
    "'$name','$speaker_name','$img_path','$detail','$course_outline','$date_open','$date_end','$place','$seat_num','$cost','$comment','$count_view_page','$status'");
    if($strSQL)echo json_encode(array('msg'=>'Insert OK'));
    else echo json_encode(array('msg'=>'Can not Insert'));


    case 'update' : 
    $name = $_GET['name'];
    $speaker_name = $_GET['speaker_name'];
    $detail = $_GET['detail'];
    $img_path = $_GET['img_path'];
    $course_outline = $_GET['course_outline'];
    $date_open = $_GET['date_open'];
    $date_end = $_GET['date_end'];
    $place = $_GET['place'];
    $seat_num = $_GET['seat_num'];
    $cost = $_GET['cost'];
    $comment = $_GET['comment'];
    $count_view_page = $_GET['count_view_page'];
    $status = $_GET['status'];
    $code = $_GET['code'];
    $stmt = $str_exe->update("courses"
    ," name = '$name', speaker_name = '$speaker_name', detail = '$detail', img_path = '$img_path', course_outline = '$course_outline', date_open = '$date_open', date_end = '$date_end', place = '$place', seat_num = '$seat_num', cost = '$cost', comment = '$comment', count_view_page = '$count_view_page', status = '$status' "
    ,"where code = ".$code);
    if($stmt)echo json_encode(array('msg'=>'Update OK'));
    else echo json_encode(array('msg'=>'Can not Update'));     
    break;


    case 'delete' :
    $code = $_GET['code'];
    $stmt = $str_exe->readOne("DELETE FROM","courses","WHERE code = ".$code);
    if($stmt)echo json_encode(array('msg'=>'Delete OK'));
    else echo json_encode(array('msg'=>'Can not Delete'));
    break;
    break;
}


?>