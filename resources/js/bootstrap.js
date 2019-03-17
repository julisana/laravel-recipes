let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.csrfToken = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

//Set debug on the window object if the application is in debug mode
window.appDebug = false;
let debug = document.head.querySelector('meta[name="app-debug"]');
if (debug) {
    window.appDebug = ( debug.content === '1' );
}

//Hide the popover if the popover box has been clicked
$(document).on('click', '.popover', function () {
    (($('[data-toggle="popover"]').popover('hide').data('bs.popover') || {}).inState || {}).click = false  // fix for BS 3.3.6
});

//Hide the popover if outside the popover box has been clicked
$(document).on('click', function (e) {
    $('[data-toggle="popover"],[data-original-title]').each(function () {
        //the 'is' for buttons that trigger popups
        //the 'has' for icons within a button that triggers a popup
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            (($(this).popover('hide').data('bs.popover') || {}).inState || {}).click = false  // fix for BS 3.3.6
        }
    });
});
