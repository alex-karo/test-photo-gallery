import Mustache from 'mustache';
import dialogPolyfill from 'dialog-polyfill';

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
        fetch('/photo/rand/')
            .then(response =>  response.json())
            .then(json => {
                const htmlString = Mustache.render('<img src="{{ file }}"><div>{{ title }}</div>', json);
                dialog.querySelector('.js-dialog-content').innerHTML = htmlString;
                dialog.showModal();
            })
            .catch(err => console.error(err.message));
    });
}