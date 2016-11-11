<?php
require "db.php";

$data = $_POST;
if( isset($data['do_login'])){
    $errors = array();
    $user = R::findOne('users', 'login = ?', array($data['login']));
    if( $user) {
        if( password_verify($data['password'], $user->password)) {
        $_SESSION['logged_user'] = $user;
            echo '<div style="color^ green;">Авторизация успешно завершена. Добро пожаловать!</div><hr>';
        } else {
            $errors[] = 'Ошибка! Неверный пароль!';
        }

    } else {
        $errors[] = 'Ошибка! Пользователь с таким именем не найден';
    }

    if( !empty($errors)) {
        echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
    }
}
?>

<form action="login.php" method="POST">
    <p>
        <label>ФИО:<br></label>
        <input name="login" type="text" value="<?php echo @$data['login']; ?>" size="15" maxlength="15">
    </p>

    <p>
        <label>Пароль:<br></label>
        <input name="password" type="password" value="<?php echo @$data['password'];?>" size="15" maxlength="10">
    </p>

    <p>
        <input type="submit" name="do_login" value="Войти"/>
    </p>


</form>
