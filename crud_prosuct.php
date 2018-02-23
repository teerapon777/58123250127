<?php
    include("config/db.php");
    include("cmd/exec.php");
    $db = new Database();
    $str_conn = $db->getConnection();
    $str_exe = new ExecSQL($str_conn);
    $action= $_GET['cmd'];
    switch($action){
        case 'select' : 
        $stmt = $str_exe->readAll("Product");
        $data_arr['rs'] = array();
        foreach($stmt as $row ){
            $item = array(
                'Product_id'=>$row['Product_id'],
                'Product_name'=>$row['Product_name'],
                'Product_detill'=>$row['Product_detill'],
                'Product_img'=>$row['Product_img']
            );
            array_push($data_arr['rs'],$item);
            echo json_encode($data_arr)."<br>";
        }
    }
?>