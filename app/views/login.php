<!-- Navigation -->

<nav>
    <ul class="main_menu">
        <li><a href="/">Main</a></li>
        <?php if (!empty($user_roles)):
            if (in_array("admin", $user_roles)):?>
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
        <?php else: ?>
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
<div class="login_register">
<form action="/main/loginhandle" method="post">
    Введите логин:<input type="text" name="login">
    Введите пароль:<input type="password" name="pass">
    <input type="submit" value="Войти">
</form>
</div>