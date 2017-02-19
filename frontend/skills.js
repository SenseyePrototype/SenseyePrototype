import $ from 'jquery';
import material from 'materialize-css';
import api from 'senseye/api';

const skills = global.skills;

$(global.document).ready(function () {
    let $skills = $('.js-skill-list');
    let $complete = $('.js-skill-autocomplete');

    function renderSkill(name) {
        const template = $('#js-skill-template').html();

        let $skill = $(template);

        $skill.find('.js-name').html(name);

        $skills.prepend($skill);
    }

    function addSkill(name) {
        if (skills.hasOwnProperty(name)) {
            api.addSkill(skills[name], function () {
                renderSkill(name);
                $complete.val('');
            });
        }
    }

    let data = {};
    for (let name in skills) {
        if (skills.hasOwnProperty(name)) {
            data[name] = null;
        }
    }

    $complete.focus();

    $complete.autocomplete({
        data: data,
        limit: 20,
        onAutocomplete: addSkill
    });

    $('.js-add-skill').click(function () {
        addSkill($complete.val());
    });

    $skills.on('click', '.js-delete', function () {
        $(this).closest('.js-skill').remove();
    });

    $skills.on('click', '.point', function () {
        var $point = $(this);

        $point.nextAll().removeClass('active');
        $point.prevAll().addClass('active');
        $point.addClass('active');
    });
});