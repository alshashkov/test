<?php
 session_start();

foreach ($_SESSION as $kkk=>$vvv)
   echo "<br>".$kkk." - ".$vvv;
echo "<br>";


?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Lesson 15</title>
  <!-- Создание Back-End функций -->
  <?php
    


function sesss($pos)
{
echo "<br> ".$pos;
foreach ($_SESSION as $kkk=>$vvv)
   echo "<br>".$kkk." - ".$vvv;
echo "<br>";
}


    //Проверка файла на совпадение для регистрации
    function check_signin($log) {
      $file_name="data.txt";
      //$file=fopen($file_name, "r+");
      $array_file=file($file_name);
      //$unic = true;
      foreach ($array_file as $key => $value) {
        $exploded_file=explode(";", $value);
        if($exploded_file[3]==$log)
           {$unic=false; break;}
        else
          $unic=true;        
        }
      
      //fclose($file);
      return $unic;
    }

    //Состояние: Пользователь в системе
    function logged($log, $pass, $f_name, $s_name, $birth) {
      $_SESSION['log']=$log;
      $_SESSION['pass']=$pass;
      $_SESSION['f_name']=$f_name;
      $_SESSION['s_name']=$s_name;
      $_SESSION['birth']=$birth;
      echo 'Привет, '.$_SESSION['f_name'].' '.$_SESSION['s_name']."!<br>Логин: ".$_SESSION['log']."<br>Возраст: ".$_SESSION['birth']."<br>";
      echo "<form action='' methowd='POST'>
              <input type='submit' name='btn' value='ВЫХОД'>
              <input type='hidden' name='type' value='logout'>
            </form>";
      if($birth < 18) echo 'Специальная акция на книги для учащихся';
      else if($birth > 60) echo 'Специальный подбор литературы для опытного читателя';
      if($_POST['type']=='logout') {
        unset($_SESSION['log']);
    //    session_abort();

      }
    }

    //Объявление запроса на регистрацию
    function signin($log, $pass, $f_name, $s_name, $birth) {
      //Проверяем на совпадение
      $sign_unic=check_signin($log);
      if($sign_unic==true)
      {
        //Если данные уникальны, то вписываем их в базу
        $file_name="data.txt";
        $file=fopen($file_name, "a+");
        $user_data=$f_name.';'.$s_name.';'.$pass.';'.$log.';'.$birth.';'."\r\n";
        fwrite($file, $user_data);
        fclose($file);
        logged($log, $pass, $f_name, $s_name, $birth);
      }
      else
        //Если данные не уникальны, то выводим сообщение
        echo 'Логин не уникален!';
      
    } 

    //Объявление запроса на вход
    function login($log, $pass) {
      $file_name="data.txt";
      $file=fopen($file_name, "a+");
      $array_file=file($file_name);
      foreach ($array_file as $key => $value) {
        $exploded_file=explode(';', $value);
        if(($exploded_file[2]==$pass)&&($exploded_file[3]==$log))
          {
            $user['f_name']=$exploded_file[0];
            $user['s_name']=$exploded_file[1];
            $user['birth']=$exploded_file[4];
            logged($log, $pass, $user['f_name'], $user['s_name'], $user['birth']); 
            $success = true;
            break;
          }
        else $success = false;               
      }
      if (!$success) echo "Неверные данные";
     //fclose($file);
    } 
  ?>
</head>
<body>

  <?php

    //Проверка сессии
    if(isset($_SESSION['log'])) {
      echo 'Привет, '.$_SESSION['f_name'].' '.$_SESSION['s_name']."!<br>Логин: ".$_SESSION['log']."<br>Возраст: ".$_SESSION['birth']."<br>";
      echo "<form action='' methowd='POST'>
              <input type='submit' name='btn' value='ВЫХОД'>
              <input type='hidden' name='type' value='logout'>
            </form>";
      if($birth < 18) echo 'Специальная акция на книги для учащихся';
      else if($birth > 60) echo 'Специальный подбор литературы для опытного читателя';
      if($_POST['type']=='logout'){
        unset($_SESSION['log']);
//    session_abort();

      }

    }

    //Запрос на регистрацию
    if($_POST['type']=='signin')
    { 
      signin($_POST['r_log'], $_POST['r_pass'], $_POST['f_name'], $_POST['s_name'], $_POST['birth']);
      //logged($_POST['r_log'], $_POST['r_pass'], $_POST['f_name'], $_POST['s_name']);
    }

     //Запрос на вход
    if($_POST['type']=='login') 
    {
      login($_POST['l_log'], $_POST['l_pass']);

    }
sesss('After login:');
  ?>

  <!-- Форма регистрации -->
  <form action='' method='POST' style="<?php if($_SESSION['log'] != '') echo 'display: none'; /*if(session_abort()) echo 'display: block;'*/ ?>">
    <h3>Р Е Г И С Т Р А Ц И Я</h3>
    <input type='text' name='f_name' placeholder='Имя'><br>
    <input type='text' name='s_name' placeholder='Фамилия'><br>
    <input type='text' name='r_log' placeholder='Логин'><br>
    <input type='password' name='r_pass' placeholder='Пароль'><br>
    <input type='text' name='birth' placeholder="Возраст"><br>
    <input type='submit' name='btn' value='РЕГИСТРАЦИЯ'><br>
    
    <input type="hidden" name='type' value='signin'>
    <hr>
  </form>
  

  <!-- Форма входа -->
  <form action='' method='POST' style="<?php if($_SESSION['log'] != '') echo 'display: none;'; /*if(session_abort()) echo 'display: block;'*/ ?>">
    <h3>В Х О Д</h3>
    <input type='text' name='l_log' placeholder='Логин'><br>
    <input type='text' name='l_pass' placeholder='Пароль'><br>
    <input type='submit' name='btn' value='ВХОД'><br>
    <input type="hidden" name='type' value='login'>
    <hr>
  </form>



  
</body>
</html>
