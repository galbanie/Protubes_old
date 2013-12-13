<?php
  $str = file_get_contents('php://input');
  echo $filename = md5(time().uniqid()).".jpg";
  file_put_contents("Uploads/".$filename,$str);
?>