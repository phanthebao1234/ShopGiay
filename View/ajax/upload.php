<?php
$valid_extensions = array('jpeg', 'jpg','png'); 

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
       
        $code=basename($_FILES['file']['name']);/* rename the file name*/
        $size= $_FILES['file']['size'];
        $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        if($size > 2097152) /*2 mb 1024*1024 bytes*/
        {
            echo json_encode(array("statusCode"=>400,'msg'=>"Image allowd less than 2 mb"));
        }
        else if(!in_array($ext, $valid_extensions)) {
            echo json_encode(array("statusCode"=>400,'msg'=>$ext.' not allowed'));
        }
        else{
           
            $result = move_uploaded_file($_FILES['file']['tmp_name'], '../../Content/images/' . $code);
            echo json_encode(array("statusCode"=>200 ,'code'=>$code));
        }
        
    }
?>
    