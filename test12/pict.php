<?php

 header("Content-Type: image/jpg");

 $im=imagecreatefromjpeg("1.jpg");
 $txt_color=imagecolorallocate($im,255,0,255);
 $shadow_color=imagecolorallocate($im,255,255,255);

 imagettftext($im,24,0,52,52,$shadow_color,"./arial.ttf",$_GET['text1']);
 imagettftext($im,24,0,50,50,$txt_color,"./arial.ttf",$_GET['text1']);

 imagettftext($im,24,0,52,152,$shadow_color,"./arial.ttf",$_GET['text2']);
 imagettftext($im,24,0,50,150,$txt_color,"./arial.ttf",$_GET['text2']);

 imagejpeg($im,NULL,100);

?>
