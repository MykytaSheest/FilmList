let yearField = document.querySelector('.year');

yearField.onchange = function () {
    if (yearField.value < 1850) yearField.value = 1850;
    if (yearField.value > 2022) yearField.value = 2022;
}

let titleField = document.querySelector('.title');
let actorField = document.querySelector('.field-actor');

titleField.onchange = function() {
    titleField.value.replace(/ /g, '');
}

titleField.addEventListener('keyup', function() {
    removeSpace(titleField)
})
titleField.addEventListener('keydown', function() {
    removeSpace(titleField)
})

actorField.addEventListener('keyup', function(e) {
    removeSpace(actorField)
    removeNumber(actorField, e)
})
actorField.addEventListener('keydown', function(e) {
    removeSpace(actorField)
    removeNumber(actorField, e)
})

function removeSpace(input) {
    if (input.value === ' ') {
        input.value = input.value.replace(' ', '');
    }
}

function removeNumber(input, event){
    if (
        (event.keyCode >= 33 && event.keyCode <= 43) ||
        (event.keyCode >= 46 && event.keyCode <= 64) ||
        (event.keyCode >= 91 && event.keyCode <= 96) ||
        (event.keyCode >= 123 && event.keyCode <= 127) ||
        (event.keyCode >= 186 && event.keyCode <= 187) ||
        (event.keyCode >= 190 && event.keyCode <= 225)
    ) {
        event.preventDefault();
    }
}
