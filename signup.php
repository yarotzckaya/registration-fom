<?php
require "db.php";

$data = $_POST;
if(isset($data['do_signup']) ){

    $errors = array();
    if(trim($data['login']) == ''){
        $errors[] = 'Введите ваше ФИО!';
    }
    if(trim($data['password']) == ''){
        $errors[] = 'Введите пароль!';
    }
    if(trim($data['year']) == ''){
        $errors[] = 'Введите ваш год рождения!';
    }
    if(trim($data['city']) == ''){
        $errors[] = 'Введите ваше место проживания!';
    }
    if(trim($data['status']) == '') {
        $errors[] = 'Введите информацию о вашем семейном положении!';
    }
    if(trim($data['education']) == ''){
        $errors[] = 'Вы не заполнили поле об образовании!';
    }
    if(trim($data['experience']) == ''){
        $errors[] = 'Вы не указали выш опыт работы!';
    }
    if(trim($data['contact']) == ''){
        $errors[] = 'Введите ваши контактные данные!';
    }
    if(trim($data['add_info']) == ''){
        $errors[] = 'Введите дополнительную информацию о себе!';
    }
    if(R::count('users', "login = ?", array($data['login'])) > 0) {
        $errors = 'Пользователь с таким именем уже существует!';
    }

    if(empty($errors)) {
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->year = $data['year'];
        $user->city = $data['city'];
        $user->status = $data['status'];
        $user->education = $data['education'];
        $user->experience = $data['experience'];
        $user->contact = $data['contact'];
        $user->add_info = $data['add_info'];
        R::store($user);
        echo '<div style="color: green;">Вы успено зарегистрированы!</div><hr>';
    } else {
        echo '<div style="color: red;">' .array_shift($errors).'</div><hr>';
    }
}
?>

<form action="/signup.php" method="POST">
    <body>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <p>
        <label>ФИО:<br></label>
        <input name="login" type="text" value="<?php echo @$data['login']; ?>" size="15" maxlength="15">
    </p>
    <p>
        <label>Пароль:<br></label>
        <input name="password" type="password" value="<?php echo @$data['password']; ?>"size="15" maxlength="10">
    </p>

    <p>
        <label>Год рождения:<br></label>
        <input name="year" type="text" value="<?php echo @$data['year']; ?>" size="15" maxlength="4">
    </p>
    <p>
        <label>Место проживания:<br></label>
        <input name="city" type="text" value="<?php echo @$data['city']; ?>" size="15" maxlength="15">
    </p>

    <p>
    <label>Семейное положение:<br></label>
    <input name="status" type="text" value="<?php echo @$data['status']; ?>" size="15" maxlength="10">
    </p>

    <p>
        <label>Образование:<br></label>
        <input name="education" type="text" value="<?php echo @$data['education']; ?>" size="20" maxlength="20">
    </p>
    <p>
        <label>Опыт работы:<br></label>
        <input name="experience" type="text" value="<?php echo @$data['experience']; ?>" size="50" maxlength="30">
    </p>
    <p>
        <label>Контактная информация (телефон, e-mail):<br></label>
        <input name="contact" type="text" value="<?php echo @$data['contact']; ?>" size="25" maxlength="30">
    </p>
    <p>
        <label>Дополнительные сведения о себе:<br></label>
        <input name="add_info" type="text" value="<?php echo @$data['add_info']; ?>" size="50" maxlength="50">
    </p>
    <p>
        <input type="submit" name="do_signup" value="Зарегистрироваться"/>
    </p>
    </body>
</form>


