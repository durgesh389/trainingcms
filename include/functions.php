<?php

function confirm_query($result_set) {
    if (!$result_set) {
        die("Database query failed.");
    }
}

function find_subjects() {
    global $connect;

    $query  = "SELECT * FROM subjects WHERE visible = 1 ORDER BY position ASC";
    $subject_set = mysqli_query($connect, $query);
    confirm_query($subject_set);
    return $subject_set;
}

function pages_for_subject($subject_id) {
    global $connect;

    $query  = "SELECT * FROM pages WHERE visible = 1 AND subject_id = {$subject_id} ORDER BY position ASC";
    $page_set = mysqli_query($connect, $query);
    confirm_query($page_set);
    return $page_set;
}

function navigation($subject_id, $page_id) {
    $output = "<ul class=\"subjects\">";
    $subject_set = find_subjects();
    while($subject = mysqli_fetch_assoc($subject_set)) {
        $output .= "<li";
        if ($subject["id"] == $subject_id) {
            $output .= " class=\"selected\"";
        }
        $output .= ">";
        $output .= "<a href=\"manage_content.php?subject=";
        $output .= urlencode($subject["id"]);
        $output .= "\">";
        $output .= $subject["menu_name"];
        $output .= "</a>";

        $page_set = pages_for_subject($subject["id"]);
        $output .= "<ul class=\"pages\">";
        while($page = mysqli_fetch_assoc($page_set)) {
            $output .= "<li";
            if ($page["id"] == $page_id) {
                $output .= " class=\"selected\"";
            }
            $output .= ">";
            $output .= "<a href=\"manage_content.php?page=";
            $output .= urlencode($page["id"]);
            $output .= "\">";
            $output .= $page["menu_name"];
            $output .= "</a></li>";
        }
        mysqli_free_result($page_set);
        $output .= "</ul></li>";
    }
    mysqli_free_result($subject_set);
    $output .= "</ul>";
    return $output;
}

?>
