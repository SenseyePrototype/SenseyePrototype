import $ from 'jquery';
import material from 'materialize-css';

const skills = global.skills;

$(global.document).ready(function () {
    let data = {};
    for (let index in skills) {
        data[skills[index]] = null;
    }

    let $autocomplete = $('.js-skill-autocomplete');

    $autocomplete.autocomplete({
        data: data,
        limit: 20,
        onAutocomplete: function (name) {

        }
    });
});