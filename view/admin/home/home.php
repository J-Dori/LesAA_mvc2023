<?php
    $blockContact = $response["data"]["blockContact"]; //Active Contact - keep on top to get OnlineBooking in blockHighlight
    $blockHighlight = $response["data"]["blockHighlight"]; //Highlighted Play (active)
?>

<div class="container" id="admin-homepage">
    <div class="row my-5">
        <?php
            include VIEW_ADMIN_PATH . "play/highlighted.php";
        ?>
    </div>
</div>
