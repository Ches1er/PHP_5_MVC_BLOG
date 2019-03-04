
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

        <?php if (is_null($user)):?>
            <li><a href="/main/register">Sign Up</a></li>
            <li><a href="/main/login">Sign In</a></li>
        <?php else:?>
            <li><a href="/main/logout">Logout</a></li>
        <?php endif;?>

    </ul>

    <!-- Activ user -->

</nav>

<!-- Error -->

<article class="adminka">
<h1>Админка</h1>
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

</article>