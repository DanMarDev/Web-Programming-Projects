<?php

function generateLink($url, $label, $class) {
    return '<a href="' . $url . '" class="' . $class . '">' . $label . '</a>';
}

function outputStars($count) {
    for ($i = 0; $i < $count; $i++) {
        echo '<img src="images/star-gold.svg" alt="Star" class="star">';
    }

    for ($i; $i < 5; $i++) {
        echo '<img src="images/star-white.svg" alt="Star" class="star">';
    }
}

function outputPostRow($number) {
    $postId = ${"postId$number"};
    $userId = ${"userId$number"};
    $userName = ${"userName$number"};
    $date = ${"date$number"};
    $thumb = ${"thumb$number"};
    $title = ${"title$number"};
    $excerpt = ${"excerpt$number"};
    $reviewsNum = ${"reviewsNum$number"};
    $reviewsRating = ${"reviewsRating$number"};

    echo "<div class='row'>";
    echo "<div class='col-md-4'>";
    echo "<a href='post.php?postId=$postId'>";
    echo "<img src='images/$thumb' class='img-responsive'>";
    echo "</a>";
    echo "</div>";
    echo "<div class='col-md-8'>";
    echo "<h2>$title</h2>";
    echo "<div class='details'>";
    echo "Posted by " . generateLink("user.php?id=$userId", $userName, "user") . " on $date";

}

?>