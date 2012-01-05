<div id="teamViewContainer">
    <div id="loadTeamSlider">
        <div id="ca-container" class="ca-container">
            <?php $this->load->view('teams/template/teamSlider', $users); ?>
        </div><!-- ca-container -->
    </div>

    <select id="selectTeamOption">
        <?php
        foreach ($teams as $team) {
            echo "<option value='", $team->fkTeamName, "'>", $team->fkTeamName, "</option>";
        }
        ?>
    </select>  
</div><!-- teamViewContainer END -->

