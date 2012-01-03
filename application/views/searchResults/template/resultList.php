<article class='listView'>
    <h2><?php echo $title; ?></h2>
    <ol class="taskList">

        <?php
        foreach ($results as $result) {
            $this->load->view('searchResults/template/result', $result);
        }
        ?>
    </ol>
</article>