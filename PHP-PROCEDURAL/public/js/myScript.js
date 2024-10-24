// Function that verifies that only one checkbox can be selected at a time
function onlyOne(checkbox) {
    // console.log(checkbox.name);
    let checkboxes = document.getElementsByName(checkbox.name);
    // console.log(checkboxes);
    checkboxes.forEach( function (item) {
        if (item != checkbox) {
            item.checked = false;
        };
    })
};

// Function that gets an ID of a selected checkbox
function getIdChecked(nameElement) {
    let elements = document.getElementsByName(nameElement);
    let article_id = 0;
    elements.forEach(function(item) {
        if(item.checked == true) {
            article_id = item.id;
            stop;
        }
    })
    return article_id;
}

// Burger menu 
let menuButton = document.getElementById("menu-burger");

let menuBurgerElementTop = document.getElementById("burger-elem-top");
let menuBurgerElementMid = document.getElementById("burger-elem-mid");
let menuBurgerElementBot = document.getElementById("burger-elem-bot");

let navListBurger = document.getElementById("nav-list");

function showMenu() {
    menuBurgerElementTop.classList.toggle("burger-elem-opened");
    menuBurgerElementMid.classList.toggle("burger-elem-opened");
    menuBurgerElementBot.classList.toggle("burger-elem-opened");
    navListBurger.classList.toggle("opened");
};
// menuButton.addEventListener("click", showMenu);

function checkResize() {
    if (window.innerWidth > 950) {
        // Ensure navListBurger is closed when the width is over 1000px
        navListBurger.classList.remove("opened");
        menuBurgerElementTop.classList.remove("burger-elem-opened");
        menuBurgerElementMid.classList.remove("burger-elem-opened");
        menuBurgerElementBot.classList.remove("burger-elem-opened");
    }
}
window.addEventListener("resize", checkResize);


// Sous-menu 
function sousMenu(parent) {
    let allSousMenus = document.getElementsByClassName('niveau-h2');
    console.log(allSousMenus);
    let sousMenu = parent.children[1];
    Array.from(allSousMenus).forEach(element => {
        if (element !== sousMenu) {
            element.classList.add('hide');
          }
    });
    sousMenu.classList.toggle('hide');
  }

// Preview Image en sauvegarde
function previewImage(image_changed, id_view_image) {
    const image = image_changed.files[0];
    let view_image = document.getElementById(id_view_image);
    if(image) {
        view_image.src=URL.createObjectURL(image);
    }
}

function popupCenter(url, title, w, h) {
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    return window.open (url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    } 

function showLoader() {
    attente.style.visibility="visible";
}

function hideLoader() {
    attente.style.visibility="hidden";
}

function touche(event) {
    if (event.keyCode == 13) {
      chercher();
    }
  }