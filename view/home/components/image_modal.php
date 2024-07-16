<div id="imageModal" class="modal">
    <span class="close cursor" onclick="closeModal()">&times;</span>
    <div class="modal-content">

        <div id="addSlides">
            <?php
            //<div class="mySlides">
            //  <img src="" style="width:100%" alt="Image">
            //</div>
            ?>
        </div>

        <!-- Next/previous controls -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

        <!-- Caption text -->
        <div class="caption-container">
            <p id="caption"></p>
        </div>

        <!-- Thumbnail image controls -->
        <div class="column" id="addThumbnail">
            <?php //<img class="demo" src="" onclick="currentSlide(1)" alt="Nature"> ?>
        </div>
    </div>
</div>