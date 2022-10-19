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

actorField.addEventListener('keyup', function() {
    removeSpace(actorField)
})
actorField.addEventListener('keydown', function() {
    removeSpace(actorField)
})

function removeSpace(input) {
    if (input.value === ' ') {
        input.value = input.value.replace(' ', '');
    }
}
