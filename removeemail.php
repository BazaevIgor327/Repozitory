<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Make Me Elvis - Remove Email</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
<img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
<p>Please select the email addresses to delete from the email list and click Remove.</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<?php
  $dbc = mysqli_connect('localhost', 'id_227_3', 'id_227_3', 'id_227_3')
    or die('Error connecting to MySQL server.');

  //Удаление записей покупателей(только в том случае
  // если форма была отправлена  на сервер для выполнения).
    if(isset($_POST['submit'])){
        foreach ($_POST['todelete'] as $delete_id){
        $query= "DELETE FROM email_list WHERE id =  $delete_id";
        mysqli_query($dbc,$query)
            or die('Ошибка  запроса к базе данных');
        }
        echo 'Покупатель(ли) удален(ы).<br/>';
    }

  //Ввод записей покупателей вместе с кнопками с независимой фиксацией
  //для отметки удаляемых покупателей.
  $query = "SELECT * FROM email_list";
  $result = mysqli_query($dbc, $query);
   while ($row=mysqli_fetch_array($result)){
       echo '<input type="checkbox" value="'.$row['id'].' name="todelete[]"/>';
       echo $row['first_name'];
       echo ' ' . $row['last_name'];
       echo ' ' . $row['email'];
       echo '<br />';
   }
     mysqli_close($dbc);
?>
    <input type="submit" name="submit" value="Удалить" />
</form>
</body>
</html>
