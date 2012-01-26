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
            ?>
            <div class="clearfix"></div>
            <div id="content" class="container_20">
                <article class='grid_4 listView'>
                    <?php
                    $this->load->view('taskListMasterView', $data);
                    ?>
                </article>
                <?php
                $this->load->view('widgets/chat');
                ?>
                <article class="grid_4 gitHubIssues">
 
                </article>

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