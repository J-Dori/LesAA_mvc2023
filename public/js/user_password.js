const submitButton = document.querySelector('#submitUser')
const password = document.querySelector('#password')
const passwordRepeat = document.querySelector('#password_repeat')

const passRegex = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[!?\\#\\$%&*-+])[a-zA-Z0-9!?\\#\\$%&*-+]{8,25}$"

window.addEventListener('DOMContentLoaded', event => {
    submitButton.style.display = 'none'
});

password.addEventListener('keyup', function (evt) {
    if (this.value.length >= 8) {
        if (this.value.match(passRegex) && this.value === passwordRepeat.value) {
            verifyRegex(true)
        } else {
            verifyRegex(false)
        }
    } else {
        verifyRegex(false)
    }
});

passwordRepeat.addEventListener('keyup', function (evt) {
    if (this.value === password.value) {
        verifyRegex(true)
    } else {
        verifyRegex(false)
    }
});

function verifyRegex(state) {
    if (state) {
        submitButton.style.display = 'inline-block'
    } else {
        submitButton.style.display = 'none'
    }
}
