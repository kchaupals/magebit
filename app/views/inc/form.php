<form method='POST' action='<?php echo URLROOT; ?>/index' class='box <?php if ($_SESSION['valid'] == true) echo 'success-f' ?>' id='sub-form' onsubmit='return validateSub()'>
    <div class='input'>
        <input type='email' class='i-box' name='email' id='email' placeholder='Type your email address here…' oninput='return validateUserInput()' required='true' />
        <button type='submit' class='sub-btn enabled-btn' name='submit' id='submit'>
            <img class='pine-arrow' src='<?php echo URLROOT; ?>/img/arrow_active.svg' />
        </button>
    </div>
    <div class='error-msg'>
        <span class='err' id='err-msg'>
            <?php if (!empty($_SESSION['error'])) {
                print_r($_SESSION['error']);
            }
            ?>
        </span>
    </div>
    <div class='terms'>
        <input type='checkbox' id='checkbox' name='checkbox' onclick='return chBoxCheck(this)' />
        <label for='checkbox' class='ch-box-label'>
            I agree to <a href='#'>terms of service</a></label>
    </div>
</form>