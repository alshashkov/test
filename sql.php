<!DOCTYPE html>
<html>
 <head>
  <title>sql-test</title>
  <meta charset="utf-8">
 </head>
 <body>

<form action="" method=POST accept-charset="utf-8">
 Field 1: <input type=text name=f1><br>
 Field 2: <input type=text name=f2><br>
 Field 3: <input type=text name=f3><br>
 <input type=submit name=store value="Store"><br>
</form>
<hr>

<form action="" method=POST>
 <input type=submit name=show value="Show"><br>
</form>
<hr>

<form action="" method=POST>
 <input type=radio name=mod value=create> Создать таблицу<br>
 <input type=radio name=mod value=delete> Удалить таблицу<br>
 <input type=submit name=modify value="Modify"><br>
</form>
<hr>


<?php


function correct_input($str,$cut)
{
  $str = substr($str,0,$cut);
  $str = trim($str);
  $str = stripslashes($str);
  $str = htmlentities($str, ENT_QUOTES | ENT_HTML5, "UTF-8");
  return $str;
}


$table_name="sql_test_table_tayran";

$dbconn=pg_connect("host=localhost dbname=twi3_sql user=postgres password=330117");
if ($dbconn===false)
{
 echo "Error opening DB!<br>";
 exit(0);
}


if ($_POST['modify']=="Modify")
{
  if ($_POST['mod']=="create")
  {
    if (!pg_query($dbconn,"create table ".$table_name." (id serial, field1 varchar, field2 varchar, field3 varchar );"))
    {
      echo "Таблица не может быть создана...<br>";
      echo pg_last_error($dbconn);
    }
    else
    {
      echo "Таблица создана...";
    }
  }
  
if ($_POST['mod']=="delete")
  {
    if (!pg_query($dbconn,"drop table ".$table_name.";"))
    {
      echo "Таблица не может быть удалена...<br>";
      echo pg_last_error($dbconn);
    }
    else
    {
      echo "Таблица удалена...";
    }
  }

}


if ($_POST['store']=="Store")
{
  $str="insert into ".$table_name." (field1,field2,field3) values ('".correct_input($_POST['f1'],100)."','".correct_input($_POST['f2'],100)."','".correct_input($_POST['f3'],100)."');";
  echo "Строка запроса: ".$str."<br><br>";
  if(!pg_query($dbconn,$str))
  {
    echo "Внесение данных невозможно...<br>";
    echo pg_last_error($dbconn);
  }
  else
  {
    echo "Внесено...";
  }
}

if ($_POST['show']=="Show")
{
 $str="select * from ".$table_name.";";
 $qresult=pg_query($dbconn,$str);
 if(!$qresult)
 {
   echo "Чтение данных невозможно...<br>";
   echo pg_last_error($dbconn);
 }
 $b=pg_fetch_all($qresult);
 echo "<table border=1>";
 foreach($b as $kk=>$vv)
 {
  echo "<tr><td>".$kk."</td><td>".$vv['field1']."</td><td>".$vv['field2']."</td><td>".$vv['field3']."</td></tr>";
 }
 echo "</table>";
}

pg_close($dbconn);
?>

 </body>
</html>
