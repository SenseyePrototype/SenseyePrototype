$(document).ready(function(){
    $('input.autocomplete').autocomplete({
        data: {
            "CSS": null,
            "HTML": null,
            "Git": 'https://git-scm.com/images/logos/downloads/Git-Icon-Black.png'
        },
        limit: 20 // The max amount of results that can be shown at once. Default: Infinity.
    });
});