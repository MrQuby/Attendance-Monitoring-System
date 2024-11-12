function updateTime() {
    const now = new Date();

    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateString = now.toLocaleDateString('en-US', options).toUpperCase();
    const timeString = now.toLocaleTimeString();

    document.getElementById('current-time').textContent = `${dateString}, ${timeString}`;
}

updateTime();

setInterval(updateTime, 1000);