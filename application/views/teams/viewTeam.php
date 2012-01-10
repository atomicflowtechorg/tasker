<div id="teamViewContainer">
    <div id="loadTeamSlider">
        <div id="ca-container" class="grid_20 ca-container">
            <?php $this->load->view('teams/template/teamSlider', $users); ?>
        </div><!-- ca-container -->
    </div>
<?php   if(count($teams) > 1){ ?>
    <select id="selectTeamOption">
        <?php
             foreach ($teams as $team) {
                echo "<option value='", $team->fkTeamName, "'>", $team->fkTeamName, "</option>";
            }
        ?>
    </select>  
    <?php }   ?>
</div><!-- teamViewContainer END -->

