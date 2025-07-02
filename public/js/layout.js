
document.addEventListener('DOMContentLoaded', () => {
    const message = document.getElementsByClassName('message')[0];

    if (message) {
        setTimeout(() => {
            message.style.display = 'none';
        }, 7000);
        message.style.display = 'block';
    }
})
