<!DOCTYPE html>
<html lang="en">
    <?php
    $this->load->view('default/head');
    ?>
    <body>
        <?php
        $this->load->view('default/toolbar', $session);
        ?>
        <?php
        if ($hasTeam) {
            $this->load->view('teams/viewTeam', $data);
            $this->load->view('default/searchBox');
            ?>
            <div class="clearfix"></div>
            <div id="content" class="container_20">
                <?php
                $this->load->view('taskListMasterView', $data);
                ?>
            </div><!-- end of content -->
            <?php
        } else {
            $this->load->view('teams/none', $data);
        }
        ?>
        <?php
        $this->load->view('default/footer');
        ?>
    </body>
</html>