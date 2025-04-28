<?php

function generateLink($url, $label, $class) {
    return '<a href="' . $url . '" class="' . $class . '">' . $label . '</a>';
}

function outputStars($count) {
    for ($i = 0; $i < $count; $i++) {
        echo '<img src="images/star-gold.svg" alt="Star" class="star" width="20" height="20">';
    }

    for ($i; $i < 5; $i++) {
        echo '<img src="images/star-white.svg" alt="Star" class="star" width="20" height="20">';
    }
}

function outputPostRow($number) {
    $postId        = $GLOBALS["postId$number"];
    $userId        = $GLOBALS["userId$number"];
    $userName      = $GLOBALS["userName$number"];
    $date          = $GLOBALS["date$number"];
    $thumb         = $GLOBALS["thumb$number"];
    $title         = $GLOBALS["title$number"];
    $excerpt       = $GLOBALS["excerpt$number"];
    $reviewsNum    = $GLOBALS["reviewsNum$number"];
    $reviewsRating = $GLOBALS["reviewsRating$number"];

    echo '<div class="row">';
    echo '   <div class="col-md-4">';
    echo '      <a href="post.php?id=' . $postId . '" class=""><img src="images/' . $thumb . '" alt="' . $title . '" class="img-responsive"/></a>';
    echo '   </div>';
    echo '   <div class="col-md-8">';
    echo '      <h2>' . $title . '</h2>';
    echo '      <div class="details">';
    echo '         Posted by ' . generateLink('user.php?id=' . $userId, $userName, '');
    echo '         <span class="pull-right">' . $date . '</span>';
    echo '         <p class="ratings">';
    outputStars($reviewsRating);
    echo ' ' . $reviewsNum . ' Reviews</p>';
    echo '      </div>';
    echo '      <p class="excerpt">' . $excerpt . '</p>';
    echo '      <p class="pull-right"><a href="post.php?id=' . $postId . '" class="btn btn-primary btn-sm">Read more</a></p>';
    echo '   </div>';
    echo '</div>   <!-- /.row -->';
    echo '<hr>';
}

?>