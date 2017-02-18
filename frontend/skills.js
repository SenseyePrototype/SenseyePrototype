import $ from 'jquery';
import material from 'materialize-css';

$(global.document).ready(function () {
    var data = {};
    for (var index in global.skills) {
        data[global.skills[index]] = null;
    }

    $('input.autocomplete').autocomplete({
        data: data,
        limit: 20,
        onAutocomplete: function (name) {

        }
    });
});