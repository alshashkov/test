<?php

$f=file("test.txt");
if (!$f) // Сработает, если функция file вернет false, то есть не получилось считать файл
{
   echo "<br>File read error!!!<br>";
   exit;  // Выходим из программы
}

foreach($f as $kk=>$vv)
{
   echo "<br>".($kk+1)." - ".$vv;
}

?>