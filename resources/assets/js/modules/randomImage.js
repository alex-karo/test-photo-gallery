import Mustache from 'mustache';
import dialogPolyfill from 'dialog-polyfill';
import showAlert from './showAlert';
import handleErrors from './handleErrors';

export default function () {
    const dialog = document.querySelector('#dialog');
    if (! dialog.showModal) {
        dialogPolyfill.registerDialog(dialog);
    }
    dialog.querySelector('button.close')
        .addEventListener('click', function() {
            dialog.close();
        });

    document.querySelector('.js-show-random-image').addEventListener('click', function (e) {
        e.preventDefault();
        fetch('/photo/rand')
            .catch(handleErrors)
            .then(response =>  response.json())
            .then(json => {
                if (json.success !== true) {
                    throw Error(JSON.stringify(json.data));
                }
                const htmlString = Mustache.render('<img src="{{ file }}"><div>{{ title }}</div>', json.data);
                dialog.querySelector('.js-dialog-content').innerHTML = htmlString;
                dialog.showModal();
            })
            .catch(err => showAlert("Ошибка загрузки: " + err.message));
    });
}