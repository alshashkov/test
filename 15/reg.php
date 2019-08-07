<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
</head>

<body>

<?php
if (!isset($_SESSION['login'])&&!isset($_SESSION['password']))  // Если икто не залогинен - выводим форму для ввода данных
{
  ?>
  <form action='' method=post>
  <input type=text name="username"> Логин<br><br>
  <input type=password name="password"> Пароль<br><br>
  <input type=text name="f"> Фамилия<br><br>
  <input type=text name="i"> Имя<br><br>
  <input type=text name="o"> Отчество<br><br>
  <input type=text name="bd"> Дата рождения (в формате ГГГГ-ММ-ДД)<br><br>
  <input type=submit name=reg value="Зарегистрироваться"><br>
  </form>
  <?php
}
else     // Если кто-то залогинен - предупреждаем об этом
{
  echo "Сначала нужно <a href='login.php'>выйти из системы</a>";
}
?>


<?php


if(isset($_POST['reg'])&&($_POST['username'])!="")
{
  $filename='db.txt';
  $f=file($filename);  // Открываем файл
  if ($f===false)  
  {
    echo 'Ошибка при открытии файла!!!';      // Если не получилось открыть - сообщаем и выходим
    exit(0);
  }
  foreach($f as $str)  // разбиваем файл по строчкам
  {
    $a=explode(";",$str);  // Разбиваем каждую строку по разделителям (;)
    if ($a[0]==$_POST['username'])   // Проверяем, совпадает ли логин в очередной строке с введенным в форму
    {
      echo "<br>Логин не уникален... Попробуйте еще раз.";
      exit(0);
    }
  }

  $ff=fopen("db.txt","a+");
  if ($ff===false)  
  {
    echo 'Ошибка при открытии файла!!!';      // Если не получилось открыть - сообщаем и выходим
    exit(0);
  }
  $str=$_POST['username'].";".$_POST['password'].";".$_POST['f'].";".$_POST['i'].";".$_POST['o'].";".$_POST['bd'].";\n";
  fwrite($ff,$str);
  echo "Вы успешно зарегистрированы! <a href='login.php'>Войти в систему</a>";
}
?>

</body>
</html>


