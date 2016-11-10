function togglenavbarLeft(toggled) {
    if (toggled === 0) {
        $('.navbar-left').width('300px');
        $('.overlay').css('width', '100%');
        $('.overlay').css('height', '100%');
        toggled = 1;
    }
    else {
        $('.navbar-left').width('0px');
        $('.overlay').css('width', '0');
        $('.overlay').css('height', '0');
        toggled = 0;
    }
    return toggled;
}

function openSubmenu(clickedSubmenu, openedSubmenu, submenuMaxHeight) {
    if (openedSubmenu === null) {
        openedSubmenu = $(clickedSubmenu);
        openedSubmenu.closest(openedSubmenu).siblings('ul').css('height', submenuMaxHeight);
    }
    else if (clickedSubmenu.is(openedSubmenu)) {
        $(openedSubmenu).closest(openedSubmenu).siblings('ul').css('height', '0px');
        openedSubmenu = null;
    }
    else {
        $(openedSubmenu).closest(openedSubmenu).siblings('ul').css('height', '0px');
        openedSubmenu = $(clickedSubmenu);
        openedSubmenu.closest(clickedSubmenu).siblings('ul').css('height', submenuMaxHeight);
    }
    return openedSubmenu;
}

function setHeights(menuCollapsedHeight, openedSubmenu) {
    var submenuMaxHeight = $('.navbar-left').height() - $('.navbar-top').height() - menuCollapsedHeight;
    if (openedSubmenu !== null) {
       openedSubmenu.closest(openedSubmenu).siblings('ul').css('height', submenuMaxHeight);
    }
    return submenuMaxHeight;
}

$(document).ready(function() {
    
    window.toggled = 0;
    var menuCollapsedHeight = $('.navbar-left > .content > ul').height();
    var submenuMaxHeight = setHeights(menuCollapsedHeight, null);
    var openedSubmenu = null;

    $('.toggle-btn').click(function(){
        window.toggled = togglenavbarLeft(toggled);
    });

    $('.overlay').click(function(){
        window.toggled = togglenavbarLeft(toggled);
    });

    $('.navbar-left > .content > ul > li > a').click(function(){
        openedSubmenu = openSubmenu($(this), openedSubmenu, submenuMaxHeight);
    });

    $(window).resize(function(){
        submenuMaxHeight = setHeights(menuCollapsedHeight, openedSubmenu, null);
    });

});









//Dashboard


function openSubmenu2Middle(clickedSubmenu2, openedSubmenu2, submenu2MaxHeight) {
    if (openedSubmenu2 === null) {
        openedSubmenu2 = $(clickedSubmenu2);
        openedSubmenu2.closest(openedSubmenu2).siblings('ul').css('height', submenu2MaxHeight);
    }
    else if (clickedSubmenu2.is(openedSubmenu2)) {
        $(openedSubmenu2).closest(openedSubmenu2).siblings('ul').css('height', '0px');
        openedSubmenu2 = null;
    }
    else {
        $(openedSubmenu2).closest(openedSubmenu2).siblings('ul').css('height', '0px');
        openedSubmenu2 = $(clickedSubmenu2);
        openedSubmenu2.closest(clickedSubmenu2).siblings('ul').css('height', submenu2MaxHeight);
    }
    return openedSubmenu2;
}

function setHeights2(menuCollapsedHeight, openedSubmenu2) {
    var submenu2MaxHeight = $('.navbar-middle').height() - $('.navbar-top').height() - menuCollapsedHeight;
    if (openedSubmenu2 !== null) {
       openedSubmenu2.closest(openedSubmenu2).siblings('ul').css('height', submenu2MaxHeight);
    }
    return submenu2MaxHeight;
}

$(document).ready(function() {
    
    window.toggled = 0;
    var menuCollapsedHeight = $('.navbar-middle > .content > ul').height();
    var submenu2MaxHeight = setHeights2(menuCollapsedHeight, null);
    var openedSubmenu2 = null;

    $('.toggle-btn').click(function(){
        window.toggled = togglenavbarmiddle(toggled);
    });

    $('.overlay').click(function(){
        window.toggled = togglenavbarmiddle(toggled);
    });

    $('.navbar-middle > .content > ul > li > a').click(function(){
        openedSubmenu2 = openSubmenu2Middle($(this), openedSubmenu2, submenu2MaxHeight);
    });

    $(window).resize(function(){
        submenu2MaxHeight = setHeights2(menuCollapsedHeight, openedSubmenu2, null);
    });

});