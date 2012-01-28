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
                    if (isset($message)) {
                        echo $message;
                    }
                    echo validation_errors();
                    $attributes = array('class' => 'clearfix', 'id' => 'loginForm', 'name' => 'loginForm', 'class' => 'unAuthenticatedForm');
                    echo form_open('authentication', $attributes);
                    // echo form_fieldset(lang('login_form_title'));
                    // echo form_label(lang('login_username_label_text'), 'fldUsername');
                    $username = array(
                        'name' => 'fldUsername',
                        'type' => 'text',
                        'id' => 'fldUsername',
                        'class' => 'field',
                        'value' => set_value('fldUsername'),
                        'maxlength' => '60',
                        'size' => '23',
                        'placeholder' => 'USERNAME',
                        'required' => '',
                    );
                    echo form_input($username);

                    // echo form_label(lang('login_password_label_text'), 'fldPassword');
                    $password = array(
                        'name' => 'fldPassword',
                        'type' => 'password',
                        'id' => 'fldPassword',
                        'class' => 'field',
                        'value' => set_value('fldPassword'),
                        'maxlength' => '60',
                        'size' => '25',
                        'placeholder' => 'PASSWORD',
                        'required' => '',
                    );
                    echo form_password($password);

                    // echo form_label(lang('login_remember_label_text'), 'fldPassword');
                    $rememberMe = array(
                        'name' => 'rememberme',
                        'id' => 'rememberme',
                        'value' => 'forever',
                        'checked' => TRUE,
                    );
                    // echo form_checkbox($rememberMe);


                    $submit = array(
                        'name' => 'submit',
                        'id' => 'submitBtn',
                        'class' => 'bt_login',
                        'value' => lang('login_submit_text'),
                    );
                    // echo "<div class='clear'></div>";
                    echo form_submit($submit);

                    echo form_fieldset_close();
                    // echo anchor('authentication/signUp', lang('login_new_member_link'), '');
                    echo "<br />";
                    // echo anchor('authentication/forgot', lang('login_forgot_password_link'), 'class="lost-pwd"');
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