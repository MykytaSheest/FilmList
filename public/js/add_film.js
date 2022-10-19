let addActorButton = document.querySelector('.add-actor-button')
let fieldActor = document.querySelector('.field-actor')
let actorsBlock = document.querySelector('.actors')
let saveButton = document.querySelector('.save-form')

let actors = []

let form = document.querySelector('.form-add-film')

form.onsubmit = function (event) {
    event.preventDefault()
}

addActorButton.onclick = function () {
    if (fieldActor.value !== '') {
        actors.push(fieldActor.value)
        actorsBlock.innerHTML += '<div><input ' +
            'type="text" ' +
            'class="actor-item" ' +
            'value="' + fieldActor.value +'" ' +
            'width="100px" ' +
            'disabled></div>' + "\n";
        fieldActor.value = ''
    }
}

saveButton.onclick = function () {
    if (validate()) {
        let data = {
            title: document.querySelector('.title').value,
            year: document.querySelector('.year').value,
            format_id: document.querySelector('.format').value,
            actors: actors
        }
        sendData(data)
    }
}

function sendData(data) {
    let myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

    let urlencoded = new URLSearchParams();
    urlencoded.append("title", data.title);
    urlencoded.append("year", data.year);
    urlencoded.append("format", data.format_id);
    urlencoded.append("actors", data.actors);

    let requestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: urlencoded,
        redirect: 'follow'
    };

    fetch("http://localhost:8080/film/create", requestOptions)
        .then(response => response.text())
        .then(result => {
            let data = JSON.parse(result)
            if (data.code === 400) {
                alert(data.message)
            } else {
                alert(data.title + ' added')
                window.location.href = '/';
            }
        })
        .catch(error => {
            alert('Wrong data, please try again')
        });
}

function validate() {
    let error = 0
    if (document.querySelector('.title').value === '') {
        error++
    }
    if (document.querySelector('.year').value === '') {
        error++
    }
    if (document.querySelector('.format').value === '') {
        error++
    }
    if (actors.length === 0) {
        error++
    }

    if (error !== 0) {
        alert('Fill in all the fields')
        return false;
    }

    return true;
}
