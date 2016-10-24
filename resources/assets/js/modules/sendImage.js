import showAlert from './showAlert';
import handleErrors from './handleErrors';

export default function () {
    document.querySelector('.js-add-image').addEventListener('submit', function (e) {
        e.preventDefault();
        const dataToServer = new FormData(this);

        fetch('/photo', {
            method: 'POST',
            body: dataToServer,
            credentials: "same-origin",
            headers: {
                'Accept': 'application/json'
            }
        })
            .then(handleErrors)
            .then(response =>  response.json())
            .then(json => {
                if (json.success !== true) {
                    throw Error(JSON.stringify(json.data));
                }
                showAlert("Изображение добавлено");
            })
            .catch(err => showAlert("Ошибка загрузки на сервер: " + err.message));
    });
}