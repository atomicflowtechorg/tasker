<div id="ca-container" class="ca-container">
        <div class="ca-nav">
            <span class="ca-nav-prev">Previous</span>
            <span class="ca-nav-next">Next</span>
        </div>
            <div class="ca-wrapper">
                <?php
                foreach($users as $teamMember)
                {
                        $this->load->view('teams/template/teamMemberItem', $teamMember);
                }
                ?>	
            </div><!-- ca-wrapper -->
    </div><!-- ca-container -->