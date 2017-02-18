import $ from 'jquery';
import material from 'materialize-css';
import api from 'senseye/api';

const skills = global.skills;

$(global.document).ready(function () {
    let data = {};
    for (let name in skills) {
        if (skills.hasOwnProperty(name)) {
            data[name] = null;
        }
    }

    let $autocomplete = $('.js-skill-autocomplete');

    $autocomplete.autocomplete({
        data: data,
        limit: 20,
        onAutocomplete: function (name) {
            if (skills.hasOwnProperty(name)) {
                api.addSkill(skills[name]);
            }
        }
    });
});