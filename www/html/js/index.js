/*=================================== MENU =================================== */

document.addEventListener("DOMContentLoaded", function () {

    var menus = document.getElementsByClassName("menu");
    for (var i = 0; i < menus.length; i++) {
        var menu = menus[i];
        menu.onclick = function () {
            var menuData = this.getAttribute('data-reference');
            var menuContent = document.querySelector('[data-referenced="' + menuData + '"]');
            menuContent.classList.toggle('hide');
        };
    }

});

/*=================================== /MENU =================================== */

/*=================================== ALERT =================================== */

// Close alert box.
document.addEventListener("click", function (event) {
    if (event.target.classList.contains("alert-close")) {
        var that = event.target;
        that.parentElement.classList.add("hide");
    }
});

/*=================================== /ALERT =================================== */
