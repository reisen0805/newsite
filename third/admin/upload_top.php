<?php
header('Content-Type: text/html; charset=shift_jis');
$msg = null;
// もし$_FILES['upfile']があって、一時的なファイル名の$_FILES['upfile']が
// POSTでアップロードされたファイルだったら
if(isset($_FILES['upfile']) && is_uploaded_file($_FILES['upfile']['tmp_name'])){
    $old_name = $_FILES['upfile']['tmp_name'];
    //  もしuploadというフォルダーがなければ
    if(!file_exists('upload')){
        mkdir('upload');
    }
    switch (exif_imagetype($_FILES['upfile']['tmp_name'])){
        case IMAGETYPE_JPEG:
            $new_name .= 'third.jpg';
            break;
        case IMAGETYPE_GIF:
            $new_name .= '.gif';
            break;
        case IMAGETYPE_PNG:
            $new_name .= '.png';
            break;
        default:
            header('Location: upload.php');
            exit();
    }
    //  もし一時的なファイル名の$_FILES['upfile']ファイルを
    //  upload/basename($_FILES['upfile']['name'])ファイルに移動したら
    $gazou = basename($_FILES['upfile']['name']);
    if(move_uploaded_file($old_name, 'upload/'.$new_name)){
        $msg = $gazou. 'のアップロードに成功しました';
    }else {
        $msg = 'アップロードに失敗しました';
    }
}
?>
<head>
<meta charset="shift_jis">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
   <link href="../../CSS/imgpc.css" rel="stylesheet" type="text/css" media="(min-width: 640px)">
   <link href="../../CSS/imgsmart.css" rel="stylesheet" type="text/css" media="(max-width: 640px)">
   <link href="../../CSS/menu.css" rel="stylesheet" type="text/css">
</head>
<h3>管理画面 ～三年生～</h3>
<p><form action="upload_top.php" method="post" enctype="multipart/form-data">
<input type="file" name="upfile">
<input type="submit" value="アップロード" name="yomikomi">
</form>
</p>
<?php
if(isset($msg) && $msg == true){
    echo '<p>'. $msg . '</p>';
}
?>
<a href="../third.html">戻る</a>