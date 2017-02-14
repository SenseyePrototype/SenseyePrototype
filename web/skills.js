$(document).ready(function () {
    var data = {};
    for (var index in skills) {
        data[skills[index]] = null;
    }

    $('input.autocomplete').autocomplete({
        data: data,
        limit: 20,
        onAutocomplete: function (name) {

        }
    });
});