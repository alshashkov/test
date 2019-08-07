<?php

echo "<form action='' method=post>";
echo "<input type=text name=login><br>";
echo "<input type=text name=password><br>";
echo "<input type=submit>";
echo "</form>";

$db_name="db.txt";

$f=file($db_name);

foreach ($f as $kk=>$vv)
{
  $aa=explode(';',$vv); // Разбиваем строку по разделителям ( ; )
  if(($_POST[login]==$aa[0])&&($_POST[password]==$aa[1]))
  {
     echo "OK<br>";
     $_SESSION[f]=$aa[2];
     $_SESSION[i]=$aa[3];
     break;   // Прерывание цикла, если цикл находится в функции и вам нужно сразу выйти из нее ставьте return
  }
}

echo $_SESSION[f]."<br>".$_SESSION[i];

?>
