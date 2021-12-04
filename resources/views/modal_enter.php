<form  name='enter' onSubmit="return form_validation();" class="modal_win_content enter">
    <input name="login" class="modal_win_input" type="text" placeholder="Enter login" required pattern="^[А-Яа-яЁё\s\-]+$">
    <input name="password" class="modal_win_input" type="text" placeholder="Enter password" required minlength="6">
    <button class="submit modal_win_submit_btn">Submit</button>
    <?php
        // if ($_SESSION['message']) {
        //     echo '<p class="msg"> ' . $_SESSsION[ 'message'] . ' </p>';
        // }
        // unset ($_SESSION[ 'message']);
    ?>
</form>