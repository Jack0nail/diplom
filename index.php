<?php
// Страница регистрации нового пользователя

// Соединямся с БД
$link=mysqli_connect("localhost", "root", "", "testdip");

// if (isset($_POST['sign in'])) {
// }


  if(isset($_POST['submit']))
  {
      $err = [];

      // проверям логин
      if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
      {
          $err[] = "Логин может состоять только из букв английского алфавита и цифр";
      }

      if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
      {
          $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
      }

      // проверяем, не сущестует ли пользователя с таким именем
      $query = mysqli_query($link, "SELECT `user_id` FROM `user` WHERE `user_login`='".mysqli_real_escape_string($link, $_POST['login'])."'");
      if(mysqli_num_rows($query) > 0)
      {
          $err[] = "Пользователь с таким логином уже существует в базе данных";
      }



      // Если нет ошибок, то добавляем в БД нового пользователя
      if(count($err) == 0)
      {

          $login = $_POST['login'];

          // Убераем лишние пробелы и делаем двойное хеширование
          $password = md5(md5(trim($_POST['password'])));

          mysqli_query($link,"INSERT INTO `user` SET `user_login`='".$login."', `user_password`='".$password."'");
          header("Location: http://test-diplom/login.php"); exit();
      }
      else
      {
          print "<b>При регистрации произошли следующие ошибки:</b><br>";
          foreach($err AS $error)
          {
              print $error."<br>";
          }
      }
  }

  header("Location: http://test-diplom/login.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Document</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <a class="navbar-brand" href="#">DT-college</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row">

      <div class="col align-self-start">

      </div>
      <div class="col align-self-center">
        <form method="post">
          <div class="form-group">
              <h1 class="mb-5 text-center"> Registration </h1>
            <label for="exampleInputEmail1">login</label>
            <input name="login" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">Enter your login.</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" aria-describedby="passHelp">
            <small id="passHelp" class="form-text text-muted">Enter your password.</small>
          </div>
          <div class="row">
            <div class="col-6">
              <button name="submit" type="submit" class="btn btn-success">sign up</button>
            </div>
            <div class="col-6">
              <button name="sign in" type="submit" class="btn btn-success">sign in</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col align-self-end">
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
