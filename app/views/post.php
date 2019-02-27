<h1>post</h1>
<div class="post">
    <div class="post_name"><?=$post->post_name?></div>
    <div class="post_author"><?=$post->author()->login?></div>
    <div class="post_date"><?=$post->data?></div>
    <div class="post_full"><?=$post->post_full?></div>
</div>
<div class="comments">
    <?php foreach ($comments as $comment):?>
    <p><?=$comment->comment_desc?></p>
    <p><?=$comment->author()->login?></p>
    <?php endforeach;?>
</div>
<form action="/comment/new" method="post">
    <textarea name="comment" id="" cols="30" rows="5"></textarea>
    <input type="hidden" name="post_id" value="<?=$post_id?>">
    <input type="submit">
</form>