import 'material-design-lite';
import 'whatwg-fetch';

import infinityScroll from './modules/infinityScroll';
import randomImage from './modules/randomImage';
import sendImage from './modules/sendImage';

document.addEventListener('DOMContentLoaded', () => {

    infinityScroll();
    randomImage();
    sendImage();

    //From http://codepen.io/kybarg/pen/PqaOOg
    //Material file input
    document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.files[0].name;
    };
});