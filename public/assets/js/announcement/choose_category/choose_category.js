$(document).ready(function () {
    $('#announcements_add_form_category').on('change', function () {
        var value = $(this).val();

        if (value == 1) {
            var parent1 = $('#template1');
            var div = parent1.children()[0];
            div.style.display = 'block';
        }
        if (value == 2) {
            var parent2 = $('#template2');
            var child2 = parent2.children()[0];
            child2.style.display = 'block';
        }
        if (value == 3) {
            var parent3 = $('#template3');
            var child3 = parent3.children()[0];
            child3.style.display = 'block';
        }
        if (value == 4) {
            var parent4 = $('#template4');
            var child4 = parent4.children()[0];
            child4.style.display = 'block';
        }
        if (value == 5) {
            var parent5 = $('#template5');
            var child5 = parent5.children()[0];
            var child51 = parent5.children()[1];
            child5.style.display = 'block';
            child51.style.display = 'block';
        }
        if (value == 6) {
            var parent6 = $('#template6');
            var child6 = parent6.children()[0];
            console.log(parent6)
            child6.style.display = 'block';
        }
        if (value == 7) {
            var parent7 = $('#template7');
            var child7 = parent7.children()[0];
            child7.style.display = 'block';
        }
        if (value == 8) {
            var parent8 = $('#template8');
            var child8 = parent8.children()[0];
            child8.style.display = 'block';
        }
        if (value == 9) {
            var parent9 = $('#template9');
            var child9 = parent9.children()[0];
            child9.style.display = 'block';
        }

        $('#announcements_add_form_category').on('change', function () {
            location.reload()
        })
    })
})