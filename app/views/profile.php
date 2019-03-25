<!-- Navigation -->

<nav>
    <ul class="main_menu">
        <li><a href="/">Main</a></li>
        <?php if (!empty($user_roles)):?>
            <?php if (in_array("admin", $user_roles)):?>
                <li><a href="/admin">Admin</a></li>
                <li><a href="/profile">User Profile</a></li>
                <li><a href="/myposts">My Posts</a></li>
            <?php elseif (in_array("user", $user_roles))  : ?>
                <li><a href="/profile">User Profile</a></li>
                <li><a href="/myposts">My Posts</a></li>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (is_null($user)): ?>
            <li><a href="/main/register">Sign Up</a></li>
            <li><a href="/main/login">Sign In</a></li>
        <?php endif; ?>
        <?php if (!is_null($user)&& empty($user_roles)): ?>
            <li><a href="/profile">User Profile</a></li>
        <?php endif; ?>
        <?php if (!is_null($user)): ?>
            <li><a href="/main/logout">Logout</a></li>
        <?php endif; ?>

    </ul>

    <!-- Activ user -->

    <div class="activ_user">
        <?php if (!is_null($user)): ?>
            <div class="cur_user_name"><?= "Current user: " . $user->login ?></div>
            <div class="cur_user_img">
                <img class="small_avatar" src="<?= "/" . $user->getPicture()->path ?>" alt="">
            </div>
        <?php else: ?>
            <div class="cur_user_name"><?= "Current user: none" ?></div>
            <div class="cur_user_img">
                <img class="small_avatar" src="/img/inactive.png" alt="">
            </div>
        <?php endif; ?>
    </div>

</nav>

<!-- Error -->

<div class="error">
    <?php if (isset($error)):?>
        <p class="error_message"></p><?= $error ?>
    <?php endif; ?>
</div>

    <!-- Profile info -->

<div class="profile_container">
    <div class="user_info">
        <?php if (empty($user_roles)):?>
            <div class="error">Вы не подтвердили свою почту</div>
        <?php endif;?>
        <div class="user_name">Ваш текущий логин: <?= $user->login?></div>
        <div class="user_sign">Ваша текущая подпись: <?=$user->sign?></div>
        <img class="large_avatar" src="<?=$user->getPicture()->path?>" alt="">
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
            Введите подпись: <textarea name="sign" cols="30" rows="3"></textarea>
            <input type="submit" value="Сменить подпись">
        </form>
    </div>
</div>