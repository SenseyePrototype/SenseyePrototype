$(document).ready(function () {
    var $range = $('.js-search-criteria-range');
    var $multi = $('.js-search-criteria-multi');
    var $must = $('.js-search-criteria-must');
    var $all = $multi.add($must);
    var $search = $('.js-search-criteria-fulltext');
    var $hint = $('#js-count-hint');
    var $loader = $('.js-count-loader', $hint);
    var $count = $('.js-count-result', $hint);
    var $empty = $('.js-empty', $hint);
    var $submit = $('.js-submit', $hint);
    var $container = $('.js-container');

    function getCriteria() {
        var criteria = [];

        $all.each(function () {
            var $this = $(this);
            var list = [];
            $('input:checked', $this).each(function () {
                list.push($(this).attr('data-alias'));
            });
            if (list.length) {
                criteria.push($this.attr('data-param') + '=' + list.join());
            }
        });

        $range.each(function () {
            var $this = $(this);

            criteria.push($this.attr('data-param') + '=' + $('.js-range-from', $this).val() + '-' + $('.js-range-to', $this).val());
        });

        criteria.push('search' + '=' + $search.val());

        return '?' + criteria.join('&');
    }

    function search() {
        window.location.href = '/developers' + getCriteria();
    }

    function setCountOffset(top) {
        $hint.css('top', top);
    }

    function showCount(props) {
        $hint.toggleClass('shown', props.shown);
        $loader.toggleClass('loader', props.loaded);
        $count.html(props.count);
        $empty.toggle(props.empty);
        $submit.toggle(props.submit);
    }
    
    function showConcreteCountMap($map, map) {
        var param = $map.attr('data-param');
        $('input', $map).each(function () {
            var $input = $(this);
            var alias = $input.attr('data-alias');
            var count = map[param][alias] || 0;
            $input.next('label').find('span.badge').html(count);
        });
    }

    function updateCountMap(response) {
        showConcreteCountMap($multi, response.multi);
        showConcreteCountMap($must, response.must);
    }

    function updateRange(response) {
        $range.each(function () {
            var $this = $(this);
            var param = $this.attr('data-param');

            if (response.range.hasOwnProperty(param)) {
                var range = response.range[param];

                $('.js-range-from', $this).attr('placeholder', range.from);
                $('.js-range-to', $this).attr('placeholder', range.to);
            }
        });
    }

    function getCount() {
        showCount({
            shown: true,
            loaded: true,
            submit: true,
            empty: false,
            count: ''
        });
        $.ajax({
            url: '/api/v1/developers/count.json' + getCriteria(),
            success: function (response) {
                showCount({
                    shown: true,
                    loaded: false,
                    submit: response.count > 0,
                    empty: response.count === 0,
                    count: response.count
                });
                updateCountMap(response);
                updateRange(response);
            }
        });
    }

    $(document).on('click', '.js-search-submit', search);
    $submit.on('click', search);
    $('input', $all).on('change', function () {
        setCountOffset($(this).offset().top - $container.offset().top);
        getCount();
    });
    $hint.on('click', '.js-close', function () {
        showCount({
            shown: false,
            loaded: false,
            submit: true,
            empty: false,
            count: '',
        });
    });
    $search.add($range).on('keyup', function (event) {
        if (event.keyCode === 0b1101) {
            search();
        }
    });
});