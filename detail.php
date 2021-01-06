<?php
include('inc/functions.php');
$page_title = "Details";

if (isset($_GET['id'])) {
  list($id, $title, $date, $time_spent, $learned, $resources, $tags) = get_journal(filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT));

  $resource_links = explode(" ", $resources);
  $tag_array = explode(" ", $tags);
}

if (isset($_GET['delete'])) {
    delete_journal(filter_input(INPUT_GET, "delete", FILTER_SANITIZE_NUMBER_INT));
    header('location: index.php');
    exit;
}

include('inc/header.php');

?>
        <section>
            <div class="container">
                <div class="entry-list single">
                    <article>
                        <h1><?php echo $title; ?></h1>
                        <time datetime="2016-01-31"><?php echo date('F d, Y', strtotime($date)); ?></time>
                        <div class="entry">
                            <h3>Time Spent: </h3>
                            <p><?php echo $time_spent; ?></p>
                        </div>
                        <div class="entry">
                            <h3>What I Learned:</h3>
                            <p><?php echo $learned; ?></p>
                        </div>
                        <div class="entry">
                            <h3>Resources to Remember:</h3>
                            <ul>
                                <?php
                                foreach ($resource_links as $link) {
                                   echo "<li><a href=''>" . $link . " " . "</a></li>";
                                }
                                ?>                               
                            </ul>
                        <span id='tag_list'>
                        </div>
                        <!-- TAGS -->
                        <span id='tag_list'>
                        <?php
                        foreach ($tag_array as $tag) {
                            echo "<a href='index.php?tag=$tag'>" . $tag . " " . "</a>";
                        }
                        ?>
                        </span>
                    </article>
                </div>
            </div>
            <div class="edit">
                <p><a href="edit.php?id=<?php echo $id; ?>">Edit Entry</a></p>
                <p><a id="del-button" href="detail.php?delete=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this project?');">Delete</a></p>
            </div>
        </section>
 <?php
include('inc/footer.php');
?>