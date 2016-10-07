<?php
// PHP Upload Script for CKEditor:  http://coursesweb.net/

// HERE SET THE PATH TO THE FOLDER WITH IMAGES ON YOUR SERVER (RELATIVE TO THE ROOT OF YOUR WEBSITE ON SERVER)
$upload_dir = 'uploads/';

// HERE PERMISSIONS FOR IMAGE
$imgsets = array(
 'maxsize' => 12000,          // maximum file size, in KiloBytes (2 MB)
 'maxwidth' => 4000,          // maximum allowed width, in pixels
 'maxheight' => 4000,         // maximum allowed height, in pixels
 'minwidth' => 8,           // minimum allowed width, in pixels
 'minheight' => 8,          // minimum allowed height, in pixels
 'type' => array('bmp', 'gif', 'jpg', 'jpe', 'png')        // allowed extensions
);

$re = '';

if(isset($_FILES['upload']) && strlen($_FILES['upload']['name']) > 1) {
  $upload_dir = trim($upload_dir, '/') .'/';
  $sepext = explode('.', strtolower($_FILES['upload']['name']));
  $type = end($sepext);       // gets extension
  
  $img_name = date("ymd-His-").rand(1000, 9999).'.'.$type;

  // get protocol and host name to send the absolute image path to CKEditor
  $protocol = !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
  $site = $protocol. $_SERVER['SERVER_NAME'] .'/';

  $uploadpath = '../../img/post/inside/' . $img_name;       // full file path
  list($width, $height) = getimagesize($_FILES['upload']['tmp_name']);     // gets image width and height
  $err = '';         // to store the errors

  // Checks if the file has allowed type, size, width and height (for images)
  if(!in_array($type, $imgsets['type'])) $err .= 'Файл: '. $_FILES['upload']['name']. ' файлын төрөл зөвшөөрөгдөөгүй.';
  if($_FILES['upload']['size'] > $imgsets['maxsize']*1000) $err .= '\\n Файлын дээд хэмжээ: '. $imgsets['maxsize']. ' KB.';
  if(isset($width) && isset($height)) {
    if($width > $imgsets['maxwidth'] || $height > $imgsets['maxheight']) $err .= '\\n Өргөн х өндөр = '. $width .' x '. $height .' \\n Зөвшөөрөгдөх дээд өргөн х өндөр: '. $imgsets['maxwidth']. ' x '. $imgsets['maxheight'];
    if($width < $imgsets['minwidth'] || $height < $imgsets['minheight']) $err .= '\\n Өргөн х өндөр = '. $width .' x '. $height .'\\n Зөвшөөрөгдөх доод өргөн х өндөр: '. $imgsets['minwidth']. ' x '. $imgsets['minheight'];
  }

  // If no errors, upload the image, else, output the errors
  if($err == '') {
    if(move_uploaded_file($_FILES['upload']['tmp_name'], $uploadpath)) {
      $CKEditorFuncNum = $_GET['CKEditorFuncNum'];
      $url = $site. $upload_dir . $img_name;
      $message = $img_name .' Амжилттай илгээгдлээ: \\n- Хэмжээ: '. number_format($_FILES['upload']['size']/1024, 3, '.', '') .' KB \\n- Зургийн өргөн х өндөр: '. $width. ' x '. $height;
      $re = "window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$message')";
    }
    else $re = 'alert("Илгээх боломжгүй")';
  }
  else $re = 'alert("'. $err .'")';
}
echo "<script>$re;</script>";