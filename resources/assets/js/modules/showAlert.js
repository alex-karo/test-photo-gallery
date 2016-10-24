export default function(text) {
    document.getElementById('notification')
        .MaterialSnackbar
        .showSnackbar({'message': text});
}