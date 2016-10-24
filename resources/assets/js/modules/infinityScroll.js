import Mustache from 'mustache';
import handleErrors from './handleErrors';

function createPhotoHtml(data) {
    const template = document.getElementById('new-image-item').innerHTML;
    return Mustache.render(template, data);
}

export default function () {
    window.addEventListener('scroll', function () {
        const distanceToBottom = document.body.offsetHeight - (window.scrollY + window.innerHeight);
        const photosContainer = document.querySelector('.js-photos-container');

        if (distanceToBottom > 300 || photosContainer.dataset.stopLoading === "true") {
            return;
        }

        photosContainer.dataset.stopLoading = "true";

        fetch('/photo?offset=' + photosContainer.children.length)
            .catch(handleErrors)
            .then(response =>  response.json())
            .then(json => {
                if (json.success !== true) {
                    throw Error(JSON.stringify(json.data));
                }
                if (json.data.length === 0) {
                    return;
                }
                const htmlString = json.data.map(createPhotoHtml).join('');
                const html = document.createRange().createContextualFragment(htmlString);
                photosContainer.appendChild(html);
                photosContainer.dataset.stopLoading = "false";
            })
            .catch(err => showAlert("Ошибка загрузки: " + err.message));

    });
}