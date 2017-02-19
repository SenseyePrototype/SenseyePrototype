import $ from 'jquery';
import material from 'materialize-css';
import api from 'senseye/api';

const skills = global.skills;

$(global.document).ready(function () {
    let $skills = $('.js-skill-list');
    let $complete = $('.js-skill-autocomplete');

    function exists(name) {
        return skills.hasOwnProperty(name);
    }

    function renderSkill(name) {
        const template = $('#js-skill-template').html();

        let $skill = $(template);

        $skill.find('.js-name').html(name);

        $skills.prepend($skill);
    }

    function addSkill(name) {
        if (exists(name)) {
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
        let $skill = $(this).closest('.js-skill');
        const name = $skill.find('.js-name').html();

        if (exists(name)) {
            api.deleteSkill(skills[name], function () {
                $skill.remove();
            })
        }
    });

    $skills.on('click', '.point', function () {
        let $point = $(this);
        let $skill = $point.closest('.js-skill');
        let $score = $point.prevAll().add($point);
        const name = $skill.find('.js-name').html();

        if (exists(name)) {
            const score = $score.length;
            api.updateSkill(skills[name], score, function () {
                $point.nextAll().removeClass('active');
                $score.addClass('active');
            })
        }
    });
});