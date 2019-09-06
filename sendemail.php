<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Make Me Elvis - Send Email</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
<img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
<p><strong>Private:</strong> For Elmer's use ONLY<br />
    Write and send an email to mailing list members.</p>

<?php
  if (isset($_POST['submit'])) {
  $from = 'elmer@makemeelvis.com';
  $subject = $_POST['subject'];
  $text = $_POST['elvismail'];
  $output_form = false;
       if (empty($subject)&&empty($text)){
            //Мы знаем, что и переменная $subject, и переменная $text пусты
           echo 'Вы забыли ввести тему и содержание электронного письма.<br/>';
            $output_form= true;
      }

       if (empty($subject)&&(!empty($text))){
           echo'Вы забыли ввести тему электронного письма .<br/>';
           $output_form =true;
       }

       if((!empty($subject))&& empty($text)){
           echo 'Вы забыли ввести содержание электронного письма .<br/>';
           $output_form= true;
       }
  }  else {
      $output_form = true;
  }

       if ((!empty($subject)) && (!empty($text))){
          $dbc = mysqli_connect('localhost', 'id_227_3', 'id_227_3', 'id_227_3')
          or die('Error connecting to MySQL server.');

          $query = "SELECT * FROM email_list";
          $result = mysqli_query($dbc, $query)
          or die('Error querying database.');

          while ($row = mysqli_fetch_array($result)) {
              $to = $row['email'];
              $first_name = $row['first_name'];
              $last_name = $row['last_name'];
              $msg = "Dear $first_name $last_name,\n$text";
              mail($to, $subject, $msg, 'From:' . $from);
              echo 'Электронное письмо отправлено: ' . $to . '<br />';
          }
              mysqli_close($dbc);
              }
if ($output_form) {
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="subject">Subject of email:</label><br />
        <input id="subject" name="subject" type="text" value="<?php echo $subject; ?>" size="30" /><br />
        <label for="elvismail">Body of email:</label><br />
        <textarea id="elvismail" name="elvismail" rows="8" cols="40"><?php echo $text; ?></textarea><br />
        <input type="submit" name="submit" value="Submit" />
    </form>

    <?php
}
?>

</body>
</html>
