'use strict';

$(function() {
    [].forEach.call($('.menu-toggle__list>li'), function(element, index, list) {
            element.classList.remove('menu_toggle__item--current');
            if (element.querySelector('a').href == location.href) {
                element.classList.add('menu_toggle__item--current');
            }
        }
    );
});