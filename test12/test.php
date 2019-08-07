<!DOCTYPE html>
<html>
<head>
 <meta charset = "utf-8">
</head>

<body>


<?php

$str1=$_POST['inpt1'];
$str2=$_POST['inpt2'];
echo $str1." ".$str2." ";

echo "<img src='pict.php?text1=".$str1."&text2=".$str2."'>";

?>

</body>
</html>
