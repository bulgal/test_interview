<!DOCTYPE HTML>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <title>Тестовое</title>
    <style type="text/css">
   .desc {
    width: 200px;
    padding: 5px;
    padding-right: 20px;
    border: solid 1px black;
    float: left;
    display: none;
   }
  </style>
  </head>
  <body>
    <form action="user" method="GET">
        <p><b>Ведите username пользователя:</b></p>
        <p><input type="text" name="username" value="" placeholder="username">
        <p><input type="submit" value="Получить данные пользователя"></p>
    </form>
    <div class="desc" visibility="<?=$visibility?>"><?=$desc?></div>
    <br>
    <div visibility="<?=$visibility?>">
    <form action="user" method="POST">
        <p><b>Данные пользователя</b></p>
        Name:
        <input type="text" name="name" value="<?=$user['name']?>">
        Id:
        <input type="text" name="id" value="<?=$user['id']?>">
        Blocked:
        <input type="text" name="username" value="<?=$user['blocked']?>">
        Permissions:
        <input visibility="hidden" type="text" name="permissions" value="<?=$user['blocked']?>">
        <p><input type="submit" value="Обновить данные"></p>
    </form>
    </div>
  </body>
</html>