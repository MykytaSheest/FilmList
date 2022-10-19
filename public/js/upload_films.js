let saveButton = document.querySelector('.save-form')

let actors = []

let form = document.querySelector('.form-upload-film')

form.onsubmit = function (event) {
    event.preventDefault()
}

saveButton.onclick = function () {
    let file = document.querySelector('.file-input').files[0]
    const formData = new FormData();
    formData.append('file', file);
    console.log(file)
    fetch('http://localhost:8080/film/file', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(result => {
            let data = JSON.parse(result)
            alert('Adder films: ' + data.added + "\n" + 'Updated films: ' + data.updated)
            window.location.href = '/';
        })
        .catch(() => { console.log('Ошибка');})
}
