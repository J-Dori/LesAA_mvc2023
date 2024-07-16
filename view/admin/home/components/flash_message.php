<?php
$type = ""; $msg = ""; $title = "";
$modalTitle = "";
$modalDisplay = "display:none;";

if (isset($_SESSION["messages"])) {
    $type = $_SESSION["messages"]["type"];
    $msg = $_SESSION["messages"]["msg"];
    $title = $_SESSION["messages"]["title"];
}
unset($_SESSION["messages"]);
?>

<?php if ($type == 'success' || $type == 'info' || $type == 'danger') {
    $modalTitle = !empty($title) ? $title : 'Message';
?>
    <div id="modalFlashMessage" class="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-<?= $type ?>">
                    <h5 class="modal-title text-white"><?= $modalTitle ?></h5>
                </div>
                <div class="modal-body">
                    <p><?= $msg ?></p>
                </div>
                <div class="modal-footer">
                    <button id="modalFlashMessageCloseBtn" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
