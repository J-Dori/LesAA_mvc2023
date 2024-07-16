// Get the modal for $_SESSION[MESSAGES]
let modalFlashMessage = document.getElementById('modalFlashMessage')
let modalFlashMessageCloseBtn = document.querySelector("#modalFlashMessageCloseBtn")

let deleteButtons = document.querySelectorAll('.btn--delete')
let formDeleteConfirmationModal = document.querySelector('#formDeleteConfirmationModal')

let textarea = document.querySelectorAll('textarea')

document.addEventListener("DOMContentLoaded", function () {
    // Modal FlashMessage
    if (modalFlashMessage) {
        modalFlashMessage.classList.toggle('modal-flash-message-open')
    }
    if (modalFlashMessageCloseBtn) {
        modalFlashMessageCloseBtn.addEventListener("click", function () {
            modalFlashMessage.style.display = "none"
        });
    }

    if (deleteButtons) {
        // Modal Delete confirmation
        deleteButtons.forEach(btn => {
            btn.addEventListener("click", (e) => {
                let ctrl = e.currentTarget.name
                let id = e.currentTarget.id.replace('del_', '')
                formDeleteConfirmationModal.action = '?ctrl='+ctrl+'&action=delete&id='+id
            });
        });
    }

    // dispatch click on textareaEditor to show nº of chars instead of words on its footer
    if (textarea) {
        setTimeout(function(){
            let toxStatusbarWordCount = document.querySelectorAll('.tox.tox-tinymce .tox-editor-container .tox-statusbar .tox-statusbar__right-container button.tox-statusbar__wordcount')
            let event = new MouseEvent("click", {
                view: window,
                bubbles: true,
                cancelable: true,
            });
            toxStatusbarWordCount.forEach(btn => {
                btn.dispatchEvent(event)
            });
        }, 500)
    }

});

//Navbar
document.addEventListener('click',function(e){
    // Hamburger menu
    if(e.target.classList.contains('hamburger-toggle')){
        e.target.children[0].classList.toggle('active');
    }
})

