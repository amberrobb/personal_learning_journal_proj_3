<?php
include('inc/functions.php');

$page_title = "New";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title =    trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $date =    trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
    $time_spent =    trim(filter_input(INPUT_POST, 'time_spent', FILTER_SANITIZE_STRING));
    $learned =    trim(filter_input(INPUT_POST, 'learned', FILTER_SANITIZE_STRING));
    $resources =    trim(filter_input(INPUT_POST, 'resources', FILTER_SANITIZE_STRING));
    $tags =    trim(filter_input(INPUT_POST, 'tags', FILTER_SANITIZE_STRING));

    $validate_date = explode("-", $date);


    if(empty($title) || empty($date) || empty($time_spent) || empty($learned)) {
        $error_message = "Please fill in all required fields!";
    } elseif(!checkdate($validate_date[1], $validate_date[2], $validate_date[0])) {
        $error_message = "Please enter a valid date";
    } else {
        if(new_journal($title, $date, $time_spent, $learned, $resources, $tags)) {
            header("location: index.php");
            exit;
        } else {
            $error_message = "Could not create journal";
        }
    }
}

include('inc/header.php');
?>
        <section>
            <div class="container">
                <div class="new-entry">
                    <h2>New Entry</h2>
                    <?php
                    if(isset($error_message)) {
                        echo "<p>" . $error_message . "</p>";
                    }
                    ?>
                    <form method="post" action="new.php">
                        <label for="title"> Title*</label>
                        <input id="title" type="text" name="title"><br>

                        <label for="date">Date*</label>
                        <input id="date" type="date" name="date"><br>

                        <label for="time-spent"> Time Spent*</label>
                        <input id="time-spent" type="text" name="time_spent"><br>

                        <label for="what-i-learned">What I Learned*</label>
                        <textarea id="what-i-learned" rows="5" name="learned"></textarea>

                        <label for="resources-to-remember">Resources to Remember</label>
                        <textarea id="resources-to-remember" rows="5" name="resources"></textarea>

                        <label for="tags-that-fit">Tags</label>
                        <textarea id="tags-that-fit" rows="1" name="tags"></textarea>

                        <p id="required">* required</p>
                        <input type="submit" value="Publish Entry" class="button">
                        <a href="index.php" class="button button-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </section>
<?php
include('inc/footer.php');
?>
