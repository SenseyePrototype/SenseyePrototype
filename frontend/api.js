import $ from 'jquery';

const path = '/api/v1/developer/profile/skill.json';

export default {
    addSkill: function (alias, success) {
        $.ajax({
            method: 'PUT',
            url: path,
            data: {
                alias
            },
            success
        })
    },

    deleteSkill: function (alias, success) {
        $.ajax({
            method: 'DELETE',
            url: path,
            data: {
                alias
            },
            success
        })
    }
};