<!DOCTYPE html>
<html lang="en">
    <?php
    $this->load->view('default/head');
    ?>
    <body>
        <?php
        $this->load->view('default/header');
        ?>
        <div id="content" class="container_20">
            <div id="login">
                <div id="errorConsole">
                </div>
                <?php
                echo validation_errors();
                $attributes = array('class' => 'clearfix', 'id' => 'passwordResetForm', 'name' => 'passwordResetForm', 'class' => 'unAuthenticatedForm');
                echo form_open('authentication/resetPassword/' . $username . '/' . $resetKey, $attributes);
                echo form_fieldset("<h1>Reset Your Password</h1>");

                $usernameField = array('fldUsername' => $username);
                echo form_hidden($usernameField);

                echo form_label('Password:', 'fldPassword1');
                $pass1 = array(
                    'name' => 'fldPassword1',
                    'type' => 'password',
                    'id' => 'fldPassword1',
                    'class' => 'field',
                    'maxlength' => '60',
                    'size' => '23',
                    'required' => '',
                );
                echo form_input($pass1);

                echo form_label('Confirm Password:', 'fldPassword2');
                $pass2 = array(
                    'name' => 'fldPassword2',
                    'type' => 'password',
                    'id' => 'fldPassword2',
                    'class' => 'field',
                    'maxlength' => '60',
                    'size' => '23',
                    'required' => '',
                );
                echo form_input($pass2);

                $submit = array(
                    'name' => 'submit',
                    'id' => 'submitBtn',
                    'class' => 'bt_login',
                    'value' => 'Change Password',
                );
                echo "<div class='clear'></div>";
                echo form_submit($submit);

                echo form_fieldset_close();
                echo form_close();
                ?>
            </div><!-- LoginForm End -->
        </div><!-- end of content -->
        <?php
        $this->load->view('default/footer');
        ?>
    </body>
</html>