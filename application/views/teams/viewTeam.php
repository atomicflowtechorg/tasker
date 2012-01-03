<div id="teamViewContainer">
    <div id="loadTeamSlider">
        <?php $this->load->view('teams/template/teamSlider',$users); ?>
    </div>
    
    <select id="selectTeamOption">
        <?php
        foreach($teams as $team){
            echo "<option value='", $team->fkTeamName ,"'>",$team->fkTeamName,"</option>";
        }
        ?>
    </select>  
</div><!-- teamViewContainer END -->

