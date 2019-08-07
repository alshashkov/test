<?php

$str1=urlencode($_POST['inpt1']);
$str2=$_POST['inpt2'];
echo $str1." ".$str2." ";

$urladr="pict.php?text1=".$str1."&text2=".$str2;

echo "<br>";
echo $urladr;

echo "<img src='pict.php?text1=".$str1."&text2=".$str2."'>";

?>
