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
                    <?php
                    $repoIssuesURL = "https://api.github.com/repos/:atomicflowtech/:tasker/issues";
                    $ch = curl_init($repoIssuesURL);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_HTTPGET, 1);
                    curl_setopt($ch, CURLOPT_HTTPAUTH, 1);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($ch);       
                    curl_close($ch);
                    echo $output;
                    ?>
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