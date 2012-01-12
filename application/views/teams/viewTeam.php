<div id="teamViewContainer" class="container_20">
    <div id="loadTeamSlider" class="alpha grid_20">
        <div id="ca-container" class="ca-container">
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

