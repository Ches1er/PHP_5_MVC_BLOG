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

</nav>

<!-- Error -->

<div class="error">
    <?php if (!is_null($error)): ?>
        <p class="error_message"></p><?= $error ?>
    <?php endif; ?>
</div>

<!-- Aticle-->

<article class="adminka">
<h1>Админка</h1>
    <div class="admin_content">
    <div class="admin_categories">
    <div class="admin_unit">
        <h2>Все категории</h2>
        <?php foreach ($categories as $category):?>
        <p><?php echo $category->category_name?></p>
        <?php endforeach;?>
    </div>
        <div class="admin_unit">
            <h2>Добавить новую категорию</h2>
    <form action="/admin/addcategory" method="post">
        Имя категории:<input type="text" name="category_name">
        <input type="submit" name="Add category" value="Добавить">
    </form>
        </div>
    </div>
    <div class="admin_find_users">
        <div class="admin_unit">
            <form action="/admin" method="get">
                <input type="text" name="login">
                <input type="submit" value="Найти пользователя">
            </form>
        </div>
        <?php if (!is_null($finduser)):?>
        <div class="admin_unit">
            <h2>Изменить данные</h2>
            <form action="/admin/changeuser" method="post">
                <input type="hidden" name="old_login" value="<?php echo $finduser->login?>">
                Логин: <input type="text" name="new_login" value="<?php echo $finduser->login?>">
                Подпись: <input type="text" name="new_sign" value="<?=$finduser->sign?>">
                <input type="submit" value="Поменять данные">
            </form>
        </div>
        <?php endif;?>
    </div>
    </div>
</article>