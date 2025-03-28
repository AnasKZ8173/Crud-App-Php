document.addEventListener("DOMContentLoaded", () => {
    let navItems = document.querySelectorAll(".nav-link");
    let activeNav = localStorage.getItem("activeNav");

    if (activeNav) {
        navItems.forEach((navItem) => {
            if (navItem.getAttribute("href") === activeNav) {
                navItem.classList.add("active");
            } else {
                navItem.classList.remove("active");
            }
        });
    }

    navItems.forEach((navItem) => {
        navItem.addEventListener("click", (e) => {
            navItems.forEach((item) => item.classList.remove("active"));
            e.target.classList.add("active");

            localStorage.setItem("activeNav", e.target.getAttribute("href"));
        });
    });
});
