<?php
include('inc/functions.php');

$page_title = "Edit";
$tags_as_string = "";

include('inc/header.php');

# get journal entry with appropriate id
if (isset($_GET['id'])) {
  list($id, $title, $date, $time_spent, $learned, $resources, $tags) = get_journal(filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT)); 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $update_id = htmlspecialchars(trim($_POST['update']));
    $update_title = htmlspecialchars(trim($_POST['title']));
    $update_date = htmlspecialchars(trim($_POST['date']));
    $update_time_spent = htmlspecialchars(trim($_POST['time_spent']));
    $update_learned = htmlspecialchars(trim($_POST['learned']));
    $update_resources = htmlspecialchars(trim($_POST['resources']));
    $update_tags = htmlspecialchars(trim($_POST['tags']));

    $validate_date = explode("-", $update_date);

    if(empty($update_title) || empty($update_date) || empty($update_time_spent) || empty($update_learned)) {
        $error_message = "Please fill in all required fields!";
    } elseif(!checkdate($validate_date[1], $validate_date[2], $validate_date[0])) {
        $error_message = "Please enter a valid date";
    } else {
        if (update_journal($update_id, $update_title, $update_date, $update_time_spent, $update_learned, $update_resources, $update_tags)) {
            header('location: detail.php?id=' . $update_id);
            exit;
        } else {
            echo "<p>Could not update journal</p>";
            exit;
        }
    }
}
?>
        <section>
            <div class="container">
                <div class="edit-entry">
                    <h2>Edit Entry</h2>
                    <?php
                    if(isset($error_message)) {
                        echo "<p>" . $error_message . "</p>";
                    }
                    ?>
                    <form method="post" action="edit.php">

                        <input type='hidden' value='<?php echo $id; ?>' name='update'/>

                        <label for="title"> Title</label>
                        <input id="title" type="text" name="title" value="<?php echo $title; ?>"><br>
                        <label for="date">Date</label>
                        <input id="date" type="date" name="date" value="<?php echo $date; ?>"><br>

                        <label for="time-spent"> Time Spent</label>
                        <input id="time-spent" type="text" name="time_spent" value="<?php echo $time_spent; ?>"><br>

                        <label for="what-i-learned">What I Learned</label>
                        <textarea id="what-i-learned" rows="5" name="learned"><?php echo $learned; ?></textarea>

                        <label for="resources-to-remember">Resources to Remember</label>
                        <textarea id="resources-to-remember" rows="5" name="resources"><?php echo $resources; ?></textarea>

                        <label for="tags-that-fit">Tags</label>
                        <textarea id="tags-that-fit" rows="1" name="tags"><?php echo $tags; ?></textarea>

                        <input type="submit" value="Publish Entry" class="button">
                        <a href="detail.php?id=<?php echo $id; ?>" class="button button-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </section>
 <?php
include('inc/footer.php');
?>