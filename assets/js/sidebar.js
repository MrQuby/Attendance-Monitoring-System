document.addEventListener("DOMContentLoaded", function () {
    const sidebarLinks = document.querySelectorAll(".sidebar-link");
    sidebarLinks.forEach(link => {
        link.addEventListener("click", function () {
            sidebarLinks.forEach(link => link.classList.remove("active"));
            this.classList.add("active");

            localStorage.setItem("activeLink", this.getAttribute("href"));
        });
    });
    const activeLink = localStorage.getItem("activeLink");
    if (activeLink) {
        sidebarLinks.forEach(link => {
            if (link.getAttribute("href") === activeLink) {
                link.classList.add("active");
            }
        });
    }
});