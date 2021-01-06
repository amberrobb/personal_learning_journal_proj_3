<?php 

include('inc/functions.php');

$page_title = "Home";

include('inc/header.php');
?>

        <section>
            <div class="container">
                <div class="entry-list">
                    <?php 
                    if (isset($_GET['tag'])) {

                        $tag = trim(filter_input(INPUT_GET, 'tag', FILTER_SANITIZE_STRING));

                        foreach (get_journal_list_via_tag($tag) as $item) {
                            echo "<article>";
                            echo "<h2><a href='detail.php?id=" . $item['id'] . "'>" . $item['title'] . "</a></h2>";
                            echo "<p><time datetime='2016-01-31'>" . date('F d, Y', strtotime($item['date'])) . "</time></p>";                   
                            echo "<span id='tag_list'>";                
                            $tag_arr = explode(" ", $item['tags']);
                            foreach ($tag_arr as $tag) {
                                echo "<a href='index.php?tag=$tag'>" . $tag . " " . "</a>";
                            }
                            echo "</span>";
                            echo "</article>";
                        }
                    } else {
                        foreach(get_journal_list() as $item) {

                            echo "<article>";
                            echo "<h2><a href='detail.php?id=" . $item['id'] . "'>" . $item['title'] . "</a></h2>";
                            echo "<p><time datetime='2016-01-31'>" . date('F d, Y', strtotime($item['date'])) . "</time></p>";                   
                            echo "<span id='tag_list'>";                
                            $tag_arr = explode(" ", $item['tags']);
                            foreach ($tag_arr as $tag) {
                               echo "<a href='index.php?tag=$tag'>" . $tag . " " . "</a>";
                            }
                            echo "</span>";
                            echo "</article>";
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

<?php
include('inc/footer.php');
?>