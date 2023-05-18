function handleResize() {
    if (window.innerWidth <= "768") {
        document.body.classList.add("sidebar-minimize");
    } else {
        document.body.classList.remove("sidebar-minimize");
    }
}
const handleBurgerSidebar = () => document.body.classList.toggle("sidebar-minimize");
handleResize();
window.onresize = () => {
    handleResize();
    if (typeof handleHeightTableGift != "undefined") {
        handleHeightTableGift();
    }
};

/**
 * If the user is logged in, log them out and redirect them to the login page.
 */
function logout() {
    fetch_query(null, "user", "logout")
        .then((res) => {
            console.log(res);
            if (res) return (location.href = http_domain + "panel");
        })
        .catch((err) => {
            console.log(err);
        });
}

window.onkeyup = (evt) => {
    if (evt.ctrlKey && evt.keyCode == 190) logout();
    if (evt.ctrlKey && evt.keyCode == 188) window.open(http_domain + "services/configuration", "_blank");
};
