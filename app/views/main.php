<div class="menu">
    <ul class="main_menu">
        <li><a href="/">Main</a></li>
        <li><span>Категории</span><ul class="category_menu">
                <?php foreach ($menu_cat as $cat):?>
                <li><a href="/showcat/<?=$cat->category_url?>"><?=$cat->category_name?></a></li>
                <?php endforeach;?>
            </ul></li>
        <?php if (!empty($user_roles)):
                  foreach ($user_roles as $role):
                  if ($role==="admin"):?>
                     <li><a href="/admin">Admin</a></li>
                  <?php elseif ($role==="user")  :?>
                      <li><a href="/profile">User Profile</a></li>
                      <li><a href="/myposts">My Posts</a></li>
                  <?php endif; ?>
                  <?php endforeach;?>
                  <?php endif;?>
        <li>
            <?php if ($user_name==="non activ user"):?>
            <ul class="auth_menu">
                    <li><a href="/main/register">Регистрация</a></li>
                    <li><a href="/main/login">Вход</a></li>
                <?php else:?>
                    <li><a href="/main/logout">Выход</a></li>
                <?php endif;?>
            </ul>
        </li>
    </ul>
</div>

<!-- Errors -->

<?php
if (isset($error)):?>
<div class="error"><?=$error?></div>
<?php endif;?>

<!-- Activ user -->

<div class="activ_user"><?= "Current user: ".$user_name?></div>

<!-- All Posts -->

<div class="posts">
    <?php if (!empty($posts)):
        foreach ($posts as $post):?>
            <div class="main_post">
            <p><a href="\post\<?=$post->post_id?>"><?=$post->post_name?></a></p>
            <p><?=$post->author()->login?></p>
            <p><?=$post->data?></p>
            <p><?=$post->post_desc?></p>
            </div>
        <?php endforeach;
    endif;?>
</div>
