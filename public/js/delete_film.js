let buttons = document.querySelectorAll(".delete-button")

for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', deleteFilm);
}


function deleteFilm() {
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
            console.log(data)
            window.location.href = '/';
        })
        .catch(error => {
            alert('Wrong delete, please try again')
        });
}
