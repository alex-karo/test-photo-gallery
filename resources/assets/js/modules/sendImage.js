function showAlert(text) {
    document.getElementById('notification').MaterialSnackbar.showSnackbar({'message': text});
}

export default function () {
    document.querySelector('.js-add-image').addEventListener('submit', function (e) {
        e.preventDefault();
        const dataToServer = new FormData(this);

        fetch('/photo/', {
            method: 'POST',
            body: dataToServer,
            credentials: "same-origin",
            headers: {
                'Accept': 'application/json'
            }
        })
            .then(response =>  response.json())
            .then(json => showAlert("Изображение добавлено"))
            .catch(err => showAlert("Ошибка загрузки на сервер: " + err.message));
    });
}