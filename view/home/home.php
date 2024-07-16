<?php
    $headers = $response["data"]["headers"]; //Blocks headers Title and Subtitles
    $blockContact = $response["data"]["blockContact"]; //Active Contact - keep on top to get OnlineBooking in blockHighlight
    $blockHighlight = $response["data"]["blockHighlight"]; //Highlighted Play (active)
    $blockAbout = $response["data"]["blockAbout"]; //About Timeline - order by 'timeOrder'
    $teamMembers = $response["data"]["teamMembers"]; //findAll
    $partners = $response["data"]["partners"]; //All partners

    include VIEW_PATH . "home/play/highlighted.php";
    include VIEW_PATH . "home/about.php";
    include VIEW_PATH . "home/team.php";
    include VIEW_PATH . "home/contact.php";
    include VIEW_PATH . "home/partners.php";
?>
