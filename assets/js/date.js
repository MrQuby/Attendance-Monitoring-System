function updateDateTime() {
    const now = new Date();

    // Update date
    const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateString = now.toLocaleDateString('en-US', dateOptions).toUpperCase();
    document.getElementById('current-date').textContent = dateString;

    // Format time with consistent spacing
    const hours = now.getHours();
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');
    const ampm = hours >= 12 ? 'PM' : 'AM';
    const displayHours = ((hours % 12) || 12).toString().padStart(2, '0');

    // Use non-breaking spaces to ensure consistent width
    const timeHTML = `<span class="time-digits">${displayHours}:${minutes}:${seconds}\u00A0</span><span class="time-ampm">${ampm}</span>`;
    document.getElementById('current-time').innerHTML = timeHTML;
}

// Initial update
updateDateTime();

// Update every second
setInterval(updateDateTime, 1000);