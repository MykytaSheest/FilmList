let buttons = document.querySelectorAll(".delete-button")

for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', deleteFilm);
}


function deleteFilm() {
    let result = confirm('Do you want to delete the movie?');
    if (result === false) {
        return;
    }
    let myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

    let urlencoded = new URLSearchParams();
    urlencoded.append("id", this.value);

    let requestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: urlencoded,
        redirect: 'follow'
    };

    fetch("http://localhost:8080/film/delete", requestOptions)
        .then(response => response.text())
        .then(result => {
            let data = JSON.parse(result)
            alert('Film ' + '"' + data[0]['title'].trim() + '"' + ' was deleted!')
            window.location.href = '/';
        })
        .catch(error => {
            alert('Wrong delete, please try again')
        });
}
