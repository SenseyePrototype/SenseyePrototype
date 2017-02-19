import $ from 'jquery';

export default {
    addSkill: function (alias, success) {
        $.ajax({
            method: 'PUT',
            url: '/api/v1/developer/profile/skill.json',
            data: {
                alias
            },
            success
        })
    }
};