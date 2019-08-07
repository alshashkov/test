<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
 <meta charset = "utf-8">
</head>

<body>

<?php

if(isset($_POST['inpt1']))
{
  $_SESSION['str1']=$_POST['inpt1'];  // Данные из первой формы сохраняем в массив $_SESSION
}

if(isset($_POST['inpt2']))  // Только если отправлялась вторая форма - выводим картинку со всеми надписями
{
   $str1=$_SESSION['str1'];
   $str2=$_POST['inpt2'];
   echo $str1." ".$str2." ";
   echo "<img src='pict.php?text1=".$str1."&text2=".$str2."'>";
}
else  // Если вторая форма не отправлялась - выводим ее компоненты
{
   echo '<b>Вторая форма</b><br>
         <form action="test.php" method="post" accept-charset="utf-8">
         <input type="text" name="inpt2"><br>
         <input type="submit" value="Отправить вторую форму">
         </form>';
}

?>

</body>
</html>
