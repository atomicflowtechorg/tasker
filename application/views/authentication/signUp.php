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
            <!-- Login Form -->
            <div id="login">
                <div id="errorConsole">
                </div>

                <?php
                $session = $this->session->all_userdata();
                if (!isset($session['logged_in']) || $session['logged_in'] == FALSE) {
                    echo validation_errors();
                    $attributes = array('class' => 'clearfix', 'id' => 'signUpForm', 'name' => 'signUpForm', 'class' => 'unAuthenticatedForm');
                    echo form_open('authentication/signUp', $attributes);
                    echo form_fieldset(lang('new_user_form_title'));

                    echo form_label(lang('new_user_first'), 'fldFirstname');
                    $firstName = array(
                        'name' => 'fldFirstname',
                        'type' => 'text',
                        'id' => 'fldFirstname',
                        'class' => 'field',
                        'value' => set_value('fldFirstname'),
                        'maxlength' => '60',
                        'size' => '23',
                        'required' => '',
                    );
                    echo form_input($firstName);

                    echo form_label(lang('new_user_last'), 'fldLastname');
                    $lastName = array(
                        'name' => 'fldLastname',
                        'type' => 'text',
                        'id' => 'fldLastname',
                        'class' => 'field',
                        'value' => set_value('fldLastname'),
                        'maxlength' => '60',
                        'size' => '23',
                        'required' => '',
                    );
                    echo form_input($lastName);

                    echo form_label(lang('new_user_email'), 'fldEmail');
                    $email = array(
                        'name' => 'fldEmail',
                        'type' => 'email',
                        'id' => 'fldEmail',
                        'class' => 'field',
                        'value' => set_value('fldEmail'),
                        'maxlength' => '120',
                        'size' => '23',
                        'required' => '',
                    );
                    echo form_input($email);

                    echo form_label(lang('new_user_username'), 'fldUsername');
                    $username = array(
                        'name' => 'fldUsername',
                        'type' => 'text',
                        'id' => 'fldUsername',
                        'class' => 'field',
                        'value' => set_value('fldUsername'),
                        'maxlength' => '60',
                        'size' => '23',
                        'required' => '',
                    );
                    echo form_input($username);

                    echo form_label(lang('new_user_password'), 'fldPassword1');
                    $password = array(
                        'name' => 'fldPassword1',
                        'type' => 'password',
                        'id' => 'fldPassword1',
                        'class' => 'field',
                        'value' => set_value('fldPassword1'),
                        'maxlength' => '60',
                        'size' => '25',
                        'required' => '',
                    );
                    echo form_password($password);

                    echo form_label(lang('new_user_confirm_password'), 'fldPassword2');
                    $passwordConfirm = array(
                        'name' => 'fldPassword2',
                        'type' => 'password',
                        'id' => 'fldPassword2',
                        'class' => 'field',
                        'value' => set_value('fldPassword2'),
                        'maxlength' => '60',
                        'size' => '25',
                        'required' => '',
                    );
                    echo form_password($passwordConfirm);

                    $submit = array(
                        'name' => 'submit',
                        'id' => 'submitBtn',
                        'class' => 'bt_createUser',
                        'value' => lang('new_user_submit_text'),
                    );
                    echo "<div class='clear'></div>";
                    echo form_submit($submit);

                    echo form_fieldset_close();
                    echo form_close();
                }
                ?>
            </div><!-- LoginForm End -->
        </div><!-- end of content -->
<?php
$this->load->view('default/footer');
?>
    </body>
</html>