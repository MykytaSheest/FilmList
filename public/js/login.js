
let form = document.querySelector('.login_form')
let button = document.querySelector('.login_button')

form.onsubmit = function (event) {
    event.preventDefault()
}

button.onclick = function (event) {
    let data = {
        email: document.querySelector('#email').value,
        password: document.querySelector('#password').value
    }

    let myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

    let urlencoded = new URLSearchParams();
    urlencoded.append("email", data.email);
    urlencoded.append("password", data.password);

    let requestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: urlencoded,
        redirect: 'follow'
    };

    fetch("http://localhost:8080/login", requestOptions)
        .then(response => response.text())
        .then(result => {
            let data = JSON.parse(result)
            localStorage.setItem('id', data.id)
            localStorage.setItem('token', data.token)
            window.location.href = '/';
        })
        .catch(error => {
            alert('Wrong login or password, please try again')
            document.querySelector('#email').value = ''
            document.querySelector('#password').value = ''
        });
}


