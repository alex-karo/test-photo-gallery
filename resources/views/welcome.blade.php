<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Photo gallery</title>

        <link rel="stylesheet" href="/css/app.css">
        <script defer src="/js/app.js"></script>
    </head>
    <body>
        <div class="content">

            <div class="mdl-grid operatons">
                <div class="mdl-cell mdl-cell--5-col mdl-cell--12-col-tablet upload-image">
                    <form class="js-add-image upload-image__form" method="POST" action="/photo/" enctype="multipart/form-data">
                        <div class="upload-image__input mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" name="title"/>
                            <label class="mdl-textfield__label">Наименование</label>
                        </div>
                        <div class="upload-image__input mdl-textfield mdl-js-textfield mdl-textfield--file">
                            <input class="mdl-textfield__input" placeholder="File" type="text" id="uploadFile" readonly/>
                            <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                                <i class="material-icons">attach_file</i>
                                <input required type="file" name="file" id="uploadBtn">
                            </div>
                        </div>
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent upload-image__send">
                            Загрузить
                        </button>
                        {{ csrf_field() }}
                    </form>
                </div>
                <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet mdl-cell--1-offset-desktop show-random">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent js-show-random-image show-random__button">
                        Случайное изображение
                    </button>
                </div>
            </div>
            <ul class="photo-list js-photos-container">
                @foreach($photos as $photo)
                    <li class="photo-list__item">
                        <div class="mdl-card mdl-shadow--2dp">
                            <div class="mdl-card__title mdl-card--expand">
                                <img src="{{ $photo->file }}" alt="{{ $photo->title }}">
                            </div>
                            <div class="mdl-card__actions">
                                <span class="demo-card-image__filename">{{ $photo->title }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <script id="new-image-item" type="text/template">
                <div class="photo-list__item">
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title mdl-card--expand">
                            <img src="@{{ file }}" alt="@{{ title }}">
                        </div>
                        <div class="mdl-card__actions">
                            <span class="demo-card-image__filename">@{{ title }}</span>
                        </div>
                    </div>
                </div>
            </script>
        </div>
        <div class="mdl-js-snackbar mdl-snackbar" id="notification">
            <div class="mdl-snackbar__text"></div>
            <button class="mdl-snackbar__action" type="button"></button>
        </div>
        <dialog class="mdl-dialog" id="dialog">
            <div class="mdl-dialog__content js-dialog-content">

            </div>
            <div class="mdl-dialog__actions">
                <button type="button" class="mdl-button close">Закрыть</button>
            </div>
        </dialog>
    </body>
</html>
