<php
    require "db.php";
?>
<?php if( isset($_SESSION['logged_user'])) :?>
    Вы авторизованы!
    Добро пожаловать, <?php echo $_SESSION['logged_user']->login; ?>!
    <hr>
    <a href="/logout.php">Выйти</a>
<?php else : ?>
Вы не зарегистрированы!<br>
<a href="/login.php">Авторизация</a><br>
<a href="/signup.php">Регистрация</a>
<?php endif; ?>