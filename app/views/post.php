
<div class="post_post">
    <div class="post_name"><?=$post->post_name?></div>
    <div class="post_author"><?=$post->author()->login?></div>
    <div class="post_date"><?=$post->data?></div>
    <div class="post_full"><?=$post->post_full?></div>
</div>
<div class="comments">
    <?php foreach ($comments as $comment):?>
        <div class="comment">
            <div class="comment_desc"><?=$comment->comment_desc?></div>
            <div class="comment_author"><?=$comment->author()->login?></div>
        </div>
    <?php endforeach;?>
</div>
<form action="/comment/new" method="post">
    <textarea name="comment" id="" cols="30" rows="5"></textarea>
    <input type="hidden" name="post_id" value="<?=$post_id?>">
    <input type="submit">
</form>