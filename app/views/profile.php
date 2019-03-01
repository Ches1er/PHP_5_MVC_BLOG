
<!-- Navigation -->

<nav>
    <ul class="main_menu">
        <li><a href="/">Main</a></li>
        <?php if (!empty($user_roles)):
            foreach ($user_roles as $role):
                if ($role==="admin"):?>
                    <li><a href="/admin">Admin</a></li>
                    <li><a href="/profile">User Profile</a></li>
                    <li><a href="/myposts">My Posts</a></li>
                <?php elseif ($role==="user")  :?>
                    <li><a href="/profile">User Profile</a></li>
                    <li><a href="/myposts">My Posts</a></li>
                <?php endif; ?>
            <?php endforeach;?>
        <?php endif;?>

        <!-- Activ user -->

        <li><div class="activ_user">
                <?php if (!is_null($user)):?>
                    <div class="cur_user_name"><?= "Current user: ".$user->login?></div>
                    <div class="cur_user_img">
                        <img class="small_avatar" src="<?=$user->getPicture()->path?>" alt="">
                    </div>
                <?php else:?>
                    <div class="cur_user_name"><?="Current user: non activ user"?></div>
                    <div class="cur_user_img">
                        <img class="small_avatar" src="/public/img/inactive.png" alt="">
                    </div>
                <?php endif;?>
            </div>
        </li>

        <li>
            <ul class="auth_menu">
                <?php if (is_null($user)):?>
                    <li><a href="/main/register">Регистрация</a></li>
                    <li><a href="/main/login">Вход</a></li>
                <?php else:?>
                    <li><a href="/main/logout">Выход</a></li>
                <?php endif;?>
            </ul>
        </li>

    </ul>
</nav>

<!-- Error -->

<div class="error">
    <?php if (isset($error)):?>
        <p class="error_message"></p><?= $error ?>
    <?php endif; ?>
</div>

<div class="container">
<h1>Profile <?= $user->login?></h1>
<div class="main_data">
    <div class="pic">
        <img class="large_avatar" src="<?=$user->getPicture()->path?>" alt="">
    </div>
    <div class="sign"><?=$user->sign?></div>
</div>
<div class="changepic">
<h2>Поменять картинку</h2>
<form enctype="multipart/form-data" action="/addpic" method="POST">
    <!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
    <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
    <!-- Название элемента input определяет имя в массиве $_FILES -->
    <input name="userfile" type="file" />
    <input type="submit" value="Добавить картинку" />
</form>
</div>
<div class="changesign">
<h2>Смените подпись</h2>
<form action="\changesign" method="post">
    Введите подпись: <input type="text" name="sign">
    <input type="submit" value="Сменить подпись">
</form>
</div>
</div>