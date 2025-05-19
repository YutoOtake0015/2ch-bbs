<form class="formWrapper" method="POST">
    <div>
        <input type="submit" value="書き込む" name="submitButton" />
        <label>名前:</label>
        <input type="text" name='username' />
        <input type="hidden" name="thread_id" value="<?php echo $thread["id"]; ?>">
    </div>
    <div>
        <textarea class="commentsTextArea" name="body"></textarea>
    </div>
</form>