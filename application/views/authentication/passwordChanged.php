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
            <h2>Congratulations!</h2>
            <?php echo $message; ?>
        </div><!-- end of content -->
        <?php
        $this->load->view('default/footer');
        ?>
    </body>
</html>