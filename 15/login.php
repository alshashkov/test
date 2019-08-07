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
if (isset($_POST['logout']))  // Если нажата кнопка Выйти, обнуляем $_SESSION
{
  unset ($_SESSION['login']);
  unset ($_SESSION['password']);
}
?>

<?php
if (isset($_POST['login']))  // Если нажата кнопка Войти
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
    if ($a[0]==$_POST['username']&&$a[1]==$_POST['password'])   // Проверяем, совпадают ли логин и пароль в очередной строке с введенным в форму
    {
      $_SESSION['login']=$_POST['username'];  // Заполняем массив $_SESSION
      $_SESSION['password']=$_POST['password'];
    }
  }
  if (!isset($_SESSION['login'])&&!isset($_SESSION['password']))  // Сюда мы попадаем если была нажата кнопка Войти, но массив $_SESSION не заполнен, то есть логин/пароль неверные
    echo "Неправильные имя пользователя или пароль...<br>Попробуйте еще раз:<br><br>";  // Сообщаем об этом
}
?>

<form action='' method=post>
  <?php
  if (!isset($_SESSION['login'])&&!isset($_SESSION['password']))  // Если массив $_SESSION не заполнен
  {
    echo "Логин <input type=text name='username'><br>";     // Выводим форму для ввода логина/пароля
    echo "Пароль <input type=password name='password'><br>";
    echo "<input type=submit value='Войти' name=login>";
  }
  else        // Если массив $_SESSION заполнен (пользователь зашел в систему)
  {
    echo "Пользователь ".$_SESSION['login']." залогинен в системе...<br>";  // Сообщаем о залогиненом пользователе
    echo "<input type=submit value='Выйти' name=logout><br>";  // Выводим кнопку Выход
  }
  ?>
</form>

</body>
</html>


