<?php

include '../../../class/include.php';

$IMG = new Upload($_FILES['photo']);
$imgName = Helper::randamId();

if ($IMG->uploaded) {

    $IMG->image_resize = true;
    $IMG->file_new_name_ext = 'jpg';
    $IMG->image_ratio_crop = '500';
    $IMG->file_new_name_body = $imgName;
    $IMG->image_x = 500;
    $IMG->image_y = 500;

    $IMG->Process('uploads/');

    if ($IMG->processed) {

        $IMG->Clean();
        header('Content-Type: application/json');
        $result = [
            "filename" => $IMG->file_dst_name,
            "message" => 'success'
        ];
        echo json_encode($result);
        exit();
    } else {

        header('Content-Type: application/json');
        $result = [
            "message" => 'error'
        ];
        echo json_encode($result);
        exit();
    }
}
var_dump($handle->uploaded);
