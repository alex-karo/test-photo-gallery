import Mustache from 'mustache';

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

        fetch('/photo/?offset=' + photosContainer.children.length)
            .then(response =>  response.json())
            .then(json => {
                if (json.length === 0) {
                    return;
                }
                const htmlString = json.map(createPhotoHtml).join('');
                const html = document.createRange().createContextualFragment(htmlString);
                photosContainer.appendChild(html);
                photosContainer.dataset.stopLoading = "false";
            })
            .catch(err => console.error(err.message));

    });
}