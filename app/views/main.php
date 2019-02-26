<div class="menu">
    <ul class="main_menu">
        <li><a href="/">Main</a></li>
        <li><ul class="category_menu"></ul>Категории</li>
        <?php if (!empty($user_roles)):
                  foreach ($user_roles as $role):
                  if ($role==="admin"):?>
                     <li><a href="/admin">Admin</a></li>
                  <?php elseif ($role==="user")  :?>
                      <li><a href="/profile">User Profile</a></li>
                      <li><a href="/myposts">My Posts</a></li>
                    <?php endif;
                    endforeach;
                    endif;?>
        <li>
            <ul class="auth_menu">
                <li><a href="/main/register">Регистрация</a></li>
                <?php if ($user_name!="non activ user"):?>
                    <li><a href="/main/logout">Выход</a></li>
                <?php else:?>
                    <li><a href="/main/login">Вход</a></li>
                <?php endif;?>
            </ul>
        </li>
    </ul>
</div>
<?php if (isset($error)):?>
<div class="error"><?=$error?></div>
<?php endif;?>
<div class="activ_user"><?= $user_name?></div>
<div class="posts">
    <?php if (!empty($posts)):
        foreach ($posts as $post):?>
    <p><?=$post->post_name?></p>
    <p><?=$post->author()->login?></p>
    <p><?=$post->data?></p>
    <p><?=$post->post_desc?></p>
    <?php endforeach;
    endif;?>
</div>
