import $ from 'jquery';

export default {
    addSkill: function (alias, success) {
        $.ajax({
            method: 'POST',
            url: '/api/v1/developer/profile/skill/add.json',
            data: {
                alias
            },
            success
        })
    }
};