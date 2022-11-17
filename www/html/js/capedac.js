/*

. OPEN NAVIGATION FULL CONTENT
. TAB SAMPLE CONTENT

*/

document.addEventListener("DOMContentLoaded", function () {
    var elementFocus = document.querySelector('.focus');
    if(elementFocus) {
        elementFocus.focus();
        /*document.querySelectorAll('.focus').forEach(function (value) {
            value.focus();
        });*/
    }
});

/* =================================== OPEN NAVIGATION FULL CONTENT =================================== */

document.addEventListener("DOMContentLoaded", function () {

    document.getElementById("toogle-navigation-full-content").addEventListener("click", function (event) {
        // document.querySelector('.navigation.full.content > .content-row > .content > .brand > .toggle').addEventListener("click", function (event) {
        // document.addEventListener("click", function (event) {
        //     if (event.target.matches('.navigation.full.content > .content-row > .content > .brand')) {
        /*event.target*/
        this.parentElement.nextElementSibling.classList.toggle("hide");
        // }
    });

});

/*document.addEventListener("DOMContentLoaded", function () {

    document.addEventListener("click", function (event) {
        if (event.target.classList.contains('toggle')/!*.matches('.navigation.full.content > .content-row > .content > .brand > .toggle')*!/) {
            event.target.parentElement.nextElementSibling.classList.toggle("hide");
        }
    });

});*/

/*document.addEventListener("DOMContentLoaded", function () {

    var menus = document.getElementsByClassName("menu");
    for (var i = 0; i < menus.length; i++) {
        var menu = menus[i];
        menu.onclick = function () {
            var menuData = this.getAttribute('data-reference');
            var menuContent = document.querySelector('[data-referenced="' + menuData + '"]');
            menuContent.classList.toggle('hide');
        };
    }

});*/

/* =================================== /OPEN NAVIGATION FULL CONTENT =================================== */

/* =================================== TAB SAMPLE CONTENT =================================== */

document.addEventListener("DOMContentLoaded", function () {
    var tabs = document.querySelectorAll(".tab.sample.content > .item > span");
    for(var i = 0; i < tabs.length; i++) {
        tabs[i].addEventListener("click", function () {
            this.nextElementSibling.classList.toggle("hide");
        });
    }
});

/* =================================== /TAB SAMPLE CONTENT =================================== */

document.addEventListener("input", function (event) {

    if (event.target.matches("input[data-validation=\"cpfcnpj\"]")) {

        var that = event.target;

        var element = that;

        var max_chars = 18;

        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }

        var value = element.value;

        //Remove tudo o que não é dígito
        value = value.replace(/\D/g, "");

        if (value.length > 11) { //CPF

            //Coloca ponto entre o segundo e o terceiro dígitos
            value = value.replace(/^(\d{2})(\d)/, "$1.$2");

            //Coloca ponto entre o quinto e o sexto dígitos
            value = value.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");

            //Coloca uma barra entre o oitavo e o nono dígitos
            value = value.replace(/\.(\d{3})(\d)/, ".$1/$2");

            //Coloca um hífen depois do bloco de quatro dígitos
            value = value.replace(/(\d{4})(\d)/, "$1-$2");

        } else { //CNPJ

            //Coloca um ponto entre o terceiro e o quarto dígitos
            value = value.replace(/(\d{3})(\d)/, "$1.$2");

            //Coloca um ponto entre o terceiro e o quarto dígitos
            //de novo (para o segundo bloco de números)
            value = value.replace(/(\d{3})(\d)/, "$1.$2");

            //Coloca um hífen entre o terceiro e o quarto dígitos
            value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

        }

        element.value = value;

    }

});

document.addEventListener("input", function (event) {

    if (event.target.matches("input[data-validation=\"date\"]")) {

        var that = event.target;

        var element = that;

        var max_chars = 10;

        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }

        var value = element.value;

        //Remove tudo o que não é dígito
        value = value.replace(/\D/g, "");

        //Coloca um ponto entre o terceiro e o quarto dígitos
        value = value.replace(/(\d{2})(\d)/, "$1/$2");

        //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        value = value.replace(/(\d{2})(\d)/, "$1/$2");

        element.value = value;

    }

});

document.addEventListener("input", function (event) {

    if (event.target.matches("input[data-validation=\"word\"]")) {

        var that = event.target;

        var element = that;

        var max_chars = 255;

        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }

        var value = element.value;

        //Remove tudo o que não é dígito
        value = value.replace(/[^a-zA-Z çÇáéíóúýÁÉÍÓÚÝàèìòùÀÈÌÒÙãõñäëïöüÿÄËÏÖÜÃÕÑâêîôûÂÊÎÔÛ`^´¨~]+/, "");

        // IMPORTANT: REMOVE EXTRA SPACES.
        // value = value.replace(/\s\s+/g, ' ');

        // value = value.replace(/[^a-zA-Z \u0080-\u00ff]+/, "");

        // /(^$)|(^([a-zA-Z çÇáéíóúýÁÉÍÓÚÝàèìòùÀÈÌÒÙãõñäëïöüÿÄËÏÖÜÃÕÑâêîôûÂÊÎÔÛ]{3,100})$)/

        element.value = value;

        /*// Aplicar cor de erros.
        if (element.value.match(/^([a-zA-Z çÇáéíóúýÁÉÍÓÚÝàèìòùÀÈÌÒÙãõñäëïöüÿÄËÏÖÜÃÕÑâêîôûÂÊÎÔÛ])*$/)) {
            element.style = "border-color: rgba(0, 255, 0, 0.25);";
        } else {
            element.style = "border-color: rgba(255, 0, 0, 0.25);";
        }*/

    }
    
});
    
    document.addEventListener("input", function (event) {

    if (event.target.matches("input[data-validation=\"name\"]")) {
        var that = event.target;
        var element = that;
        var max_chars = 100;
        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }
        var value = element.value;
        value = value.replace(/[^a-zA-Z çÇáéíóúýÁÉÍÓÚÝàèìòùÀÈÌÒÙãõñäëïöüÿÄËÏÖÜÃÕÑâêîôûÂÊÎÔÛ`^´¨~]+/, "");
        element.value = value;
    }
    
    if (event.target.matches("input[data-validation=\"password\"]")) {
        var that = event.target;
        var element = that;
        var max_chars = 32;
        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }
        var value = element.value;
        value = value.replace(/[^a-zA-Z0-9]+/, "");
        element.value = value;
    }

    if (event.target.matches("input[data-validation=\"alphanumeric\"]")) {

        var that = event.target;

        var element = that;

        var max_chars = 100;

        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }

        var value = element.value;

        value = value.replace(/[^a-zA-Z0-9 çÇáéíóúýÁÉÍÓÚÝàèìòùÀÈÌÒÙãõñäëïöüÿÄËÏÖÜÃÕÑâêîôûÂÊÎÔÛ`^´¨~-]+/, "");

        element.value = value;

    }
    
    if (event.target.matches("input[data-validation=\"location\"]")) {
        var that = event.target;
        var element = that;
        var max_chars = 64;
        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }
        var value = element.value;
        value = value.replace(/[^a-zA-Z0-9 çÇáéíóúýÁÉÍÓÚÝàèìòùÀÈÌÒÙãõñäëïöüÿÄËÏÖÜÃÕÑâêîôûÂÊÎÔÛ`^´¨~-]+/, "");
        element.value = value;

    }

    if (event.target.matches("input[data-validation=\"rg\"]")) {
        var that = event.target;
        var element = that;
        var max_chars = 32;
        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }
        var value = element.value;
        value = value.replace(/[^a-zA-Z0-9 \/-]+/, "");
        element.value = value;
    }
    
    if (event.target.matches("input[data-validation=\"cpf\"]")) {
        var that = event.target;
        var element = that;
        var max_chars = 11;
        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }
        var value = element.value;
        value = value.replace(/[^0-9]+/, "");
        element.value = value;
    }

    if (event.target.matches("input[data-validation=\"number\"]")) {
        var that = event.target;
        var element = that;
        var max_chars = 16;
        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }
        var value = element.value;
        // value = value.replace(/\D/g, "");
        value = value.replace(/[^a-zA-Z 0-9º-]+/, "");
        element.value = value;
    }

    if (event.target.matches("input[data-validation=\"cep\"]")) {
        var that = event.target;
        var element = that;
        var max_chars = 32;
        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }
        var value = element.value;
        value = value.replace(/[^0-9]+/, "");
        element.value = value;
    }
    
    if (event.target.matches("input[data-validation=\"complement\"]")) {
        var that = event.target;
        var element = that;
        var max_chars = 100;
        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }
        var value = element.value;
        value = value.replace(/[^a-zA-Z0-9 çÇáéíóúýÁÉÍÓÚÝàèìòùÀÈÌÒÙãõñäëïöüÿÄËÏÖÜÃÕÑâêîôûÂÊÎÔÛ`^´¨~-]+/, "");
        element.value = value;
    }

    if (event.target.matches("input[data-validation=\"email\"]")) {
        var that = event.target;
        var element = that;
        var max_chars = 100;
        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }
        var value = element.value;
        value = value.replace(/[^a-zA-Z0-9çÇáéíóúýÁÉÍÓÚÝàèìòùÀÈÌÒÙãõñäëïöüÿÄËÏÖÜÃÕÑâêîôûÂÊÎÔÛ\-.@!#$%&'*+/=?_`^´{|}~]+/, "");
        element.value = value;
    }
    
    if (event.target.matches("input[data-validation=\"phone\"]")) {
        var that = event.target;
        var element = that;
        var max_chars = 32;
        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }
        var value = element.value;
        value = value.replace(/[^0-9 )+(-]+/, "");
        element.value = value;
    }
    
    if (event.target.matches("input[data-validation=\"cid\"]")) {
        var that = event.target;
        var element = that;
        var max_chars = 16;
        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }
        var value = element.value;
        value = value.replace(/[^a-zA-Z0-9.]+/, "");
        element.value = value;
    }

    if (event.target.matches("input[data-validation=\"character\"]")) {

        var that = event.target;

        var element = that;

        var max_chars = 100;

        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }

        var value = element.value;

        value = value.replace(/[^a-zA-Z0-9]+/, "");

        element.value = value;

    }

});

// MENU PAINEL =====================================================================================
// menu-top
document.addEventListener("scroll", function () {
    /*var menu = document.getElementsByClassName("menu-top")[0];
    if (document.body.scrollTop > menu.style.height) {
        menu.classList.add("moved");
    } else {
        menu.classList.remove("moved");
    }*/
});

// menu-left
window.addEventListener("load", function () {
    var muenuItems = document.getElementsByClassName("menu-items");
    for (var i = 0; i < muenuItems.length; i++) {
        var menuItem = muenuItems[i];
        menuItem.querySelector("div").addEventListener("click", function () {
            var eacl = this.lastElementChild;
            if (eacl.classList.contains("fa-arrow-circle-down")) {
                eacl.classList.remove("fa-arrow-circle-down");
                eacl.classList.add("fa-arrow-circle-up");
            } else {
                eacl.classList.add("fa-arrow-circle-down");
                eacl.classList.remove("fa-arrow-circle-up");
            }
            this.nextElementSibling.classList.toggle("hide");
        });
    }
});
