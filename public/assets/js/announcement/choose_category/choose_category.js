$(document).ready(function () {
    $('#announcements_add_form_category').on('change', function () {
        var value = $(this).val();

        if (value == 1) {
            var parent1 = $('#template1');
            var div = parent1.children()[0];
            div.style.display = 'block';

            var parent2 = $('#template2');
            var child2 = parent2.children()[0];
            child2.style.display = 'none';
            var b1 = $('#button2');
            var b = parent2.children()[1];
            var c = parent2.children()[2];
            var c1 = b1.children()[0];
            b.style.display = 'none';
            c.style.display = 'none';
            c1.style.display = 'none';

            var parent3 = $('#template3');
            var child3 = parent3.children()[0];
            child3.style.display = 'none';
            var b13 = $('#button3');
            var b3 = parent3.children()[1];
            var c3 = parent3.children()[2];
            var c13 = b13.children()[0];
            b3.style.display = 'none';
            c3.style.display = 'none';
            c13.style.display = 'none';
            var temp = $('.template3');
            var a = temp.children()[0];
            var b = temp.children()[2];
            var c = temp.children()[3];
            var d = temp.children()[4];
            var f = temp.children()[5];
            var g = temp.children()[6];
            var h = temp.children()[7];
            var i = temp.children()[9];
            var j = temp.children()[10]
            a.style.display = 'none'
            b.style.display = 'none'
            c.style.display = 'none'
            d.style.display = 'none'
            f.style.display = 'none'
            g.style.display = 'none'
            h.style.display = 'none'
            i.style.display = 'none'
            j.style.display = 'none'

            var parent4 = $('#template4');
            var child4 = parent4.children()[0];
            child4.style.display = 'none';
            var b14 = $('#button4');
            var b4 = parent4.children()[1];
            var c4 = parent4.children()[2];
            var c14 = b14.children()[0];
            b4.style.display = 'none';
            c4.style.display = 'none';
            c14.style.display = 'none';

            var parent5 = $('#template5');
            var child5 = parent5.children()[0];
            var child51 = parent5.children()[1];
            child5.style.display = 'none';
            child51.style.display = 'none';
            var b15 = $('#button5');
            var c15 = b15.children()[0];
            c15.style.display = 'none';

            var parent6 = $('#template6');
            var child6 = parent6.children()[0];
            child6.style.display = 'none';
            var b16 = $('#button6');
            var b66 = parent6.children()[1];
            var c66 = parent6.children()[2];
            var c16 = b16.children()[0];
            b66.style.display = 'none';
            c66.style.display = 'none';
            c16.style.display = 'none';
            var temp6 = $('.template6');
            var a6 = temp6.children()[1];
            var b6 = temp6.children()[2];
            var c6 = temp6.children()[3];
            var d6 = temp6.children()[4];
            var f6 = temp6.children()[5];
            a6.style.display = 'none';
            b6.style.display = 'none';
            c6.style.display = 'none';
            d6.style.display = 'none';
            f6.style.display = 'none';

            var parent7 = $('#template7');
            var child7 = parent7.children()[0];
            child7.style.display = 'none';
            var b17 = $('#button7');
            var b7 = parent7.children()[1];
            var c7 = parent7.children()[2];
            var c17 = b17.children()[0];
            b7.style.display = 'none';
            c7.style.display = 'none';
            c17.style.display = 'none';

            var parent8 = $('#template8');
            var child8 = parent8.children()[0];
            child8.style.display = 'none';
            var b18 = $('#button8');
            var b8 = parent8.children()[1];
            var c18 = b18.children()[0];
            b8.style.display = 'none';
            c18.style.display = 'none';

            var parent9 = $('#template9');
            var child9 = parent9.children()[0];
            child9.style.display = 'none';
            var b19 = $('#button9');
            var c19 = b19.children()[0];
            c19.style.display = 'none';

        }
        if (value == 2) {
            var parent1 = $('#template1');
            var div = parent1.children()[0];
            div.style.display = 'none';
            var b1 = $('#button1');
            var b = parent1.children()[1];
            var c = parent1.children()[2];
            var c1 = b1.children()[0];
            b.style.display = 'none';
            c.style.display = 'none';
            c1.style.display = 'none';

            var parent2 = $('#template2');
            var child2 = parent2.children()[0];
            child2.style.display = 'block';

            var parent3 = $('#template3');
            var child3 = parent3.children()[0];
            child3.style.display = 'none';
            var b13 = $('#button3');
            var b3 = parent3.children()[1];
            var c3 = parent3.children()[2];
            var c13 = b13.children()[0];
            b3.style.display = 'none';
            c3.style.display = 'none';
            c13.style.display = 'none';
            var temp = $('.template3');
            var a = temp.children()[0];
            var b = temp.children()[2];
            var c = temp.children()[3];
            var d = temp.children()[4];
            var f = temp.children()[5];
            var g = temp.children()[6];
            var h = temp.children()[7];
            var i = temp.children()[9];
            var j = temp.children()[10]
            a.style.display = 'none'
            b.style.display = 'none'
            c.style.display = 'none'
            d.style.display = 'none'
            f.style.display = 'none'
            g.style.display = 'none'
            h.style.display = 'none'
            i.style.display = 'none'
            j.style.display = 'none'

            var parent4 = $('#template4');
            var child4 = parent4.children()[0];
            child4.style.display = 'none';
            var b14 = $('#button4');
            var b4 = parent4.children()[1];
            var c4 = parent4.children()[2];
            var c14 = b14.children()[0];
            b4.style.display = 'none';
            c4.style.display = 'none';
            c14.style.display = 'none';

            var parent5 = $('#template5');
            var child5 = parent5.children()[0];
            var child51 = parent5.children()[1];
            child5.style.display = 'none';
            child51.style.display = 'none';
            var b15 = $('#button5');
            var c15 = b15.children()[0];
            c15.style.display = 'none';

            var parent6 = $('#template6');
            var child6 = parent6.children()[0];
            child6.style.display = 'none';
            var b16 = $('#button6');
            var b66 = parent6.children()[1];
            var c66 = parent6.children()[2];
            var c16 = b16.children()[0];
            b66.style.display = 'none';
            c66.style.display = 'none';
            c16.style.display = 'none';
            var temp6 = $('.template6');
            var a6 = temp6.children()[1];
            var b6 = temp6.children()[2];
            var c6 = temp6.children()[3];
            var d6 = temp6.children()[4];
            var f6 = temp6.children()[5];
            a6.style.display = 'none';
            b6.style.display = 'none';
            c6.style.display = 'none';
            d6.style.display = 'none';
            f6.style.display = 'none';

            var parent7 = $('#template7');
            var child7 = parent7.children()[0];
            child7.style.display = 'none';
            var b17 = $('#button7');
            var b7 = parent7.children()[1];
            var c7 = parent7.children()[2];
            var c17 = b17.children()[0];
            b7.style.display = 'none';
            c7.style.display = 'none';
            c17.style.display = 'none';

            var parent8 = $('#template8');
            var child8 = parent8.children()[0];
            child8.style.display = 'none';
            var b18 = $('#button8');
            var b8 = parent8.children()[1];
            var c18 = b18.children()[0];
            b8.style.display = 'none';
            c18.style.display = 'none';

            var parent9 = $('#template9');
            var child9 = parent9.children()[0];
            child9.style.display = 'none';
            var b19 = $('#button9');
            var c19 = b19.children()[0];
            c19.style.display = 'none';
        }
        if (value == 3) {
            var parent1 = $('#template1');
            var div = parent1.children()[0];
            div.style.display = 'none';
            var b13 = $('#button1');
            var b3 = parent1.children()[1];
            var c3 = parent1.children()[2];
            var c13 = b13.children()[0];
            b3.style.display = 'none';
            c3.style.display = 'none';
            c13.style.display = 'none';

            var parent2 = $('#template2');
            var child2 = parent2.children()[0];
            child2.style.display = 'none';
            var b1 = $('#button2');
            var b = parent2.children()[1];
            var c = parent2.children()[2];
            var c1 = b1.children()[0];
            b.style.display = 'none';
            c.style.display = 'none';
            c1.style.display = 'none';

            var parent3 = $('#template3');
            var child3 = parent3.children()[0];
            child3.style.display = 'block';

            var parent4 = $('#template4');
            var child4 = parent4.children()[0];
            child4.style.display = 'none';
            var b14 = $('#button4');
            var b4 = parent4.children()[1];
            var c4 = parent4.children()[2];
            var c14 = b14.children()[0];
            b4.style.display = 'none';
            c4.style.display = 'none';
            c14.style.display = 'none';

            var parent5 = $('#template5');
            var child5 = parent5.children()[0];
            var child51 = parent5.children()[1];
            child5.style.display = 'none';
            child51.style.display = 'none';
            var b15 = $('#button5');
            var c15 = b15.children()[0];
            c15.style.display = 'none';

            var parent6 = $('#template6');
            var child6 = parent6.children()[0];
            child6.style.display = 'none';
            var b16 = $('#button6');
            var b66 = parent6.children()[1];
            var c66 = parent6.children()[2];
            var c16 = b16.children()[0];
            b66.style.display = 'none';
            c66.style.display = 'none';
            c16.style.display = 'none';
            var temp6 = $('.template6');
            var a6 = temp6.children()[1];
            var b6 = temp6.children()[2];
            var c6 = temp6.children()[3];
            var d6 = temp6.children()[4];
            var f6 = temp6.children()[5];
            a6.style.display = 'none';
            b6.style.display = 'none';
            c6.style.display = 'none';
            d6.style.display = 'none';
            f6.style.display = 'none';

            var parent7 = $('#template7');
            var child7 = parent7.children()[0];
            child7.style.display = 'none';
            var b17 = $('#button7');
            var b7 = parent7.children()[1];
            var c7 = parent7.children()[2];
            var c17 = b17.children()[0];
            b7.style.display = 'none';
            c7.style.display = 'none';
            c17.style.display = 'none';

            var parent8 = $('#template8');
            var child8 = parent8.children()[0];
            child8.style.display = 'none';
            var b18 = $('#button8');
            var b8 = parent8.children()[1];
            var c18 = b18.children()[0];
            b8.style.display = 'none';
            c18.style.display = 'none';

            var parent9 = $('#template9');
            var child9 = parent9.children()[0];
            child9.style.display = 'none';
            var b19 = $('#button9');
            var c19 = b19.children()[0];
            c19.style.display = 'none';

        }
        if (value == 4) {
            var parent1 = $('#template1');
            var div = parent1.children()[0];
            div.style.display = 'none';
            var b14 = $('#button1');
            var b4 = parent1.children()[1];
            var c4 = parent1.children()[2];
            var c14 = b14.children()[0];
            b4.style.display = 'none';
            c4.style.display = 'none';
            c14.style.display = 'none';

            var parent2 = $('#template2');
            var child2 = parent2.children()[0];
            child2.style.display = 'none';
            var b1 = $('#button2');
            var b = parent2.children()[1];
            var c = parent2.children()[2];
            var c1 = b1.children()[0];
            b.style.display = 'none';
            c.style.display = 'none';
            c1.style.display = 'none';

            var parent3 = $('#template3');
            var child3 = parent3.children()[0];
            child3.style.display = 'none';
            var b13 = $('#button3');
            var b3 = parent3.children()[1];
            var c3 = parent3.children()[2];
            var c13 = b13.children()[0];
            b3.style.display = 'none';
            c3.style.display = 'none';
            c13.style.display = 'none';
            var temp = $('.template3');
            var a = temp.children()[0];
            var b = temp.children()[2];
            var c = temp.children()[3];
            var d = temp.children()[4];
            var f = temp.children()[5];
            var g = temp.children()[6];
            var h = temp.children()[7];
            var i = temp.children()[9];
            var j = temp.children()[10]
            a.style.display = 'none'
            b.style.display = 'none'
            c.style.display = 'none'
            d.style.display = 'none'
            f.style.display = 'none'
            g.style.display = 'none'
            h.style.display = 'none'
            i.style.display = 'none'
            j.style.display = 'none'

            var parent4 = $('#template4');
            var child4 = parent4.children()[0];
            child4.style.display = 'block';

            var parent5 = $('#template5');
            var child5 = parent5.children()[0];
            var child51 = parent5.children()[1];
            child5.style.display = 'none';
            child51.style.display = 'none';
            var b15 = $('#button5');
            var c15 = b15.children()[0];
            c15.style.display = 'none';

            var parent6 = $('#template6');
            var child6 = parent6.children()[0];
            child6.style.display = 'none';
            var b16 = $('#button6');
            var b66 = parent6.children()[1];
            var c66 = parent6.children()[2];
            var c16 = b16.children()[0];
            b66.style.display = 'none';
            c66.style.display = 'none';
            c16.style.display = 'none';
            var temp6 = $('.template6');
            var a6 = temp6.children()[1];
            var b6 = temp6.children()[2];
            var c6 = temp6.children()[3];
            var d6 = temp6.children()[4];
            var f6 = temp6.children()[5];
            a6.style.display = 'none';
            b6.style.display = 'none';
            c6.style.display = 'none';
            d6.style.display = 'none';
            f6.style.display = 'none';

            var parent7 = $('#template7');
            var child7 = parent7.children()[0];
            child7.style.display = 'none';
            var b17 = $('#button7');
            var b7 = parent7.children()[1];
            var c7 = parent7.children()[2];
            var c17 = b17.children()[0];
            b7.style.display = 'none';
            c7.style.display = 'none';
            c17.style.display = 'none';

            var parent8 = $('#template8');
            var child8 = parent8.children()[0];
            child8.style.display = 'none';
            var b18 = $('#button8');
            var b8 = parent8.children()[1];
            var c18 = b18.children()[0];
            b8.style.display = 'none';
            c18.style.display = 'none';

            var parent9 = $('#template9');
            var child9 = parent9.children()[0];
            child9.style.display = 'none';
            var b19 = $('#button9');
            var c19 = b19.children()[0];
            c19.style.display = 'none';

        }
        if (value == 5) {
            var parent1 = $('#template1');
            var div = parent1.children()[0];
            div.style.display = 'none';
            var b15 = $('#button1');
            var b5 = parent1.children()[1];
            var c5 = parent1.children()[2];
            var c15 = b15.children()[0];
            b5.style.display = 'none';
            c5.style.display = 'none';
            c15.style.display = 'none';

            var parent2 = $('#template2');
            var child2 = parent2.children()[0];
            child2.style.display = 'none';
            var b1 = $('#button2');
            var b = parent2.children()[1];
            var c = parent2.children()[2];
            var c1 = b1.children()[0];
            b.style.display = 'none';
            c.style.display = 'none';
            c1.style.display = 'none';

            var parent3 = $('#template3');
            var child3 = parent3.children()[0];
            child3.style.display = 'none';
            var b13 = $('#button3');
            var b3 = parent3.children()[1];
            var c3 = parent3.children()[2];
            var c13 = b13.children()[0];
            b3.style.display = 'none';
            c3.style.display = 'none';
            c13.style.display = 'none';
            var temp = $('.template3');
            var a = temp.children()[0];
            var b = temp.children()[2];
            var c = temp.children()[3];
            var d = temp.children()[4];
            var f = temp.children()[5];
            var g = temp.children()[6];
            var h = temp.children()[7];
            var i = temp.children()[9];
            var j = temp.children()[10]
            a.style.display = 'none'
            b.style.display = 'none'
            c.style.display = 'none'
            d.style.display = 'none'
            f.style.display = 'none'
            g.style.display = 'none'
            h.style.display = 'none'
            i.style.display = 'none'
            j.style.display = 'none'

            var parent4 = $('#template4');
            var child4 = parent4.children()[0];
            child4.style.display = 'none';
            var b14 = $('#button4');
            var b4 = parent4.children()[1];
            var c4 = parent4.children()[2];
            var c14 = b14.children()[0];
            b4.style.display = 'none';
            c4.style.display = 'none';
            c14.style.display = 'none';

            var parent5 = $('#template5');
            var child5 = parent5.children()[0];
            var child51 = parent5.children()[1];
            child5.style.display = 'block';
            child51.style.display = 'block';

            var parent6 = $('#template6');
            var child6 = parent6.children()[0];
            child6.style.display = 'none';
            var b16 = $('#button6');
            var b66 = parent6.children()[1];
            var c66 = parent6.children()[2];
            var c16 = b16.children()[0];
            b66.style.display = 'none';
            c66.style.display = 'none';
            c16.style.display = 'none';
            var temp6 = $('.template6');
            var a6 = temp6.children()[1];
            var b6 = temp6.children()[2];
            var c6 = temp6.children()[3];
            var d6 = temp6.children()[4];
            var f6 = temp6.children()[5];
            a6.style.display = 'none';
            b6.style.display = 'none';
            c6.style.display = 'none';
            d6.style.display = 'none';
            f6.style.display = 'none';

            var parent7 = $('#template7');
            var child7 = parent7.children()[0];
            child7.style.display = 'none';
            var b17 = $('#button7');
            var b7 = parent7.children()[1];
            var c7 = parent7.children()[2];
            var c17 = b17.children()[0];
            b7.style.display = 'none';
            c7.style.display = 'none';
            c17.style.display = 'none';

            var parent8 = $('#template8');
            var child8 = parent8.children()[0];
            child8.style.display = 'none';
            var b18 = $('#button8');
            var b8 = parent8.children()[1];
            var c18 = b18.children()[0];
            b8.style.display = 'none';
            c18.style.display = 'none';

            var parent9 = $('#template9');
            var child9 = parent9.children()[0];
            child9.style.display = 'none';
            var b19 = $('#button9');
            var c19 = b19.children()[0];
            c19.style.display = 'none';

        }
        if (value == 6) {
            var parent1 = $('#template1');
            var div = parent1.children()[0];
            div.style.display = 'none';
            var b16 = $('#button1');
            var b66 = parent1.children()[1];
            var c66 = parent1.children()[2];
            var c16 = b16.children()[0];
            b66.style.display = 'none';
            c66.style.display = 'none';
            c16.style.display = 'none';

            var parent2 = $('#template2');
            var child2 = parent2.children()[0];
            child2.style.display = 'none';
            var b1 = $('#button2');
            var b = parent2.children()[1];
            var c = parent2.children()[2];
            var c1 = b1.children()[0];
            b.style.display = 'none';
            c.style.display = 'none';
            c1.style.display = 'none';

            var parent3 = $('#template3');
            var child3 = parent3.children()[0];
            child3.style.display = 'none';
            var b13 = $('#button3');
            var b3 = parent3.children()[1];
            var c3 = parent3.children()[2];
            var c13 = b13.children()[0];
            b3.style.display = 'none';
            c3.style.display = 'none';
            c13.style.display = 'none';
            var temp = $('.template3');
            var a = temp.children()[0];
            var b = temp.children()[2];
            var c = temp.children()[3];
            var d = temp.children()[4];
            var f = temp.children()[5];
            var g = temp.children()[6];
            var h = temp.children()[7];
            var i = temp.children()[9];
            var j = temp.children()[10]
            a.style.display = 'none'
            b.style.display = 'none'
            c.style.display = 'none'
            d.style.display = 'none'
            f.style.display = 'none'
            g.style.display = 'none'
            h.style.display = 'none'
            i.style.display = 'none'
            j.style.display = 'none'

            var parent4 = $('#template4');
            var child4 = parent4.children()[0];
            child4.style.display = 'none';
            var b14 = $('#button4');
            var b4 = parent4.children()[1];
            var c4 = parent4.children()[2];
            var c14 = b14.children()[0];
            b4.style.display = 'none';
            c4.style.display = 'none';
            c14.style.display = 'none';

            var parent5 = $('#template5');
            var child5 = parent5.children()[0];
            var child51 = parent5.children()[1];
            child5.style.display = 'none';
            child51.style.display = 'none';
            var b15 = $('#button5');
            var c15 = b15.children()[0];
            c15.style.display = 'none';

            var parent6 = $('#template6');
            var child6 = parent6.children()[0];
            child6.style.display = 'block';


            var parent7 = $('#template7');
            var child7 = parent7.children()[0];
            child7.style.display = 'none';
            var b17 = $('#button7');
            var b7 = parent7.children()[1];
            var c7 = parent7.children()[2];
            var c17 = b17.children()[0];
            b7.style.display = 'none';
            c7.style.display = 'none';
            c17.style.display = 'none';

            var parent8 = $('#template8');
            var child8 = parent8.children()[0];
            child8.style.display = 'none';
            var b18 = $('#button8');
            var b8 = parent8.children()[1];
            var c18 = b18.children()[0];
            b8.style.display = 'none';
            c18.style.display = 'none';

            var parent9 = $('#template9');
            var child9 = parent9.children()[0];
            child9.style.display = 'none';
            var b19 = $('#button9');
            var c19 = b19.children()[0];
            c19.style.display = 'none';

        }
        if (value == 7) {
            var parent1 = $('#template1');
            var div = parent1.children()[0];
            div.style.display = 'none';
            var b17 = $('#button1');
            var b7 = parent1.children()[1];
            var c7 = parent1.children()[2];
            var c17 = b17.children()[0];
            b7.style.display = 'none';
            c7.style.display = 'none';
            c17.style.display = 'none';

            var parent2 = $('#template2');
            var child2 = parent2.children()[0];
            child2.style.display = 'none';
            var b1 = $('#button2');
            var b = parent2.children()[1];
            var c = parent2.children()[2];
            var c1 = b1.children()[0];
            b.style.display = 'none';
            c.style.display = 'none';
            c1.style.display = 'none';

            var parent3 = $('#template3');
            var child3 = parent3.children()[0];
            child3.style.display = 'none';
            var b13 = $('#button3');
            var b3 = parent3.children()[1];
            var c3 = parent3.children()[2];
            var c13 = b13.children()[0];
            b3.style.display = 'none';
            c3.style.display = 'none';
            c13.style.display = 'none';
            var temp = $('.template3');
            var a = temp.children()[0];
            var b = temp.children()[2];
            var c = temp.children()[3];
            var d = temp.children()[4];
            var f = temp.children()[5];
            var g = temp.children()[6];
            var h = temp.children()[7];
            var i = temp.children()[9];
            var j = temp.children()[10]
            a.style.display = 'none'
            b.style.display = 'none'
            c.style.display = 'none'
            d.style.display = 'none'
            f.style.display = 'none'
            g.style.display = 'none'
            h.style.display = 'none'
            i.style.display = 'none'
            j.style.display = 'none'

            var parent4 = $('#template4');
            var child4 = parent4.children()[0];
            child4.style.display = 'none';
            var b14 = $('#button4');
            var b4 = parent4.children()[1];
            var c4 = parent4.children()[2];
            var c14 = b14.children()[0];
            b4.style.display = 'none';
            c4.style.display = 'none';
            c14.style.display = 'none';

            var parent5 = $('#template5');
            var child5 = parent5.children()[0];
            var child51 = parent5.children()[1];
            child5.style.display = 'none';
            child51.style.display = 'none';
            var b15 = $('#button5');
            var c15 = b15.children()[0];
            c15.style.display = 'none';

            var parent6 = $('#template6');
            var child6 = parent6.children()[0];
            child6.style.display = 'none';
            var b16 = $('#button6');
            var b66 = parent6.children()[1];
            var c66 = parent6.children()[2];
            var c16 = b16.children()[0];
            b66.style.display = 'none';
            c66.style.display = 'none';
            c16.style.display = 'none';
            var temp6 = $('.template6');
            var a6 = temp6.children()[1];
            var b6 = temp6.children()[2];
            var c6 = temp6.children()[3];
            var d6 = temp6.children()[4];
            var f6 = temp6.children()[5];
            a6.style.display = 'none';
            b6.style.display = 'none';
            c6.style.display = 'none';
            d6.style.display = 'none';
            f6.style.display = 'none';

            var parent7 = $('#template7');
            var child7 = parent7.children()[0];
            child7.style.display = 'block';

            var parent8 = $('#template8');
            var child8 = parent8.children()[0];
            child8.style.display = 'none';
            var b18 = $('#button8');
            var b8 = parent8.children()[1];
            var c18 = b18.children()[0];
            b8.style.display = 'none';
            c18.style.display = 'none';

            var parent9 = $('#template9');
            var child9 = parent9.children()[0];
            child9.style.display = 'none';
            var b19 = $('#button9');
            var c19 = b19.children()[0];
            c19.style.display = 'none';

        }
        if (value == 8) {
            var parent1 = $('#template1');
            var div = parent1.children()[0];
            div.style.display = 'none';
            var b18 = $('#button1');
            var b8 = parent1.children()[1];
            var c8 = parent1.children()[2];
            var c18 = b18.children()[0];
            b8.style.display = 'none';
            c8.style.display = 'none';
            c18.style.display = 'none';

            var parent2 = $('#template2');
            var child2 = parent2.children()[0];
            child2.style.display = 'none';
            var b1 = $('#button2');
            var b = parent2.children()[1];
            var c = parent2.children()[2];
            var c1 = b1.children()[0];
            b.style.display = 'none';
            c.style.display = 'none';
            c1.style.display = 'none';

            var parent3 = $('#template3');
            var child3 = parent3.children()[0];
            child3.style.display = 'none';
            var b13 = $('#button3');
            var b3 = parent3.children()[1];
            var c3 = parent3.children()[2];
            var c13 = b13.children()[0];
            b3.style.display = 'none';
            c3.style.display = 'none';
            c13.style.display = 'none';
            var temp = $('.template3');
            var a = temp.children()[0];
            var b = temp.children()[2];
            var c = temp.children()[3];
            var d = temp.children()[4];
            var f = temp.children()[5];
            var g = temp.children()[6];
            var h = temp.children()[7];
            var i = temp.children()[9];
            var j = temp.children()[10]
            a.style.display = 'none'
            b.style.display = 'none'
            c.style.display = 'none'
            d.style.display = 'none'
            f.style.display = 'none'
            g.style.display = 'none'
            h.style.display = 'none'
            i.style.display = 'none'
            j.style.display = 'none'

            var parent4 = $('#template4');
            var child4 = parent4.children()[0];
            child4.style.display = 'none';
            var b14 = $('#button4');
            var b4 = parent4.children()[1];
            var c4 = parent4.children()[2];
            var c14 = b14.children()[0];
            b4.style.display = 'none';
            c4.style.display = 'none';
            c14.style.display = 'none';

            var parent5 = $('#template5');
            var child5 = parent5.children()[0];
            var child51 = parent5.children()[1];
            child5.style.display = 'none';
            child51.style.display = 'none';
            var b15 = $('#button5');
            var c15 = b15.children()[0];
            c15.style.display = 'none';

            var parent6 = $('#template6');
            var child6 = parent6.children()[0];
            child6.style.display = 'none';
            var b16 = $('#button6');
            var b66 = parent6.children()[1];
            var c66 = parent6.children()[2];
            var c16 = b16.children()[0];
            b66.style.display = 'none';
            c66.style.display = 'none';
            c16.style.display = 'none';
            var temp6 = $('.template6');
            var a6 = temp6.children()[1];
            var b6 = temp6.children()[2];
            var c6 = temp6.children()[3];
            var d6 = temp6.children()[4];
            var f6 = temp6.children()[5];
            a6.style.display = 'none';
            b6.style.display = 'none';
            c6.style.display = 'none';
            d6.style.display = 'none';
            f6.style.display = 'none';

            var parent7 = $('#template7');
            var child7 = parent7.children()[0];
            child7.style.display = 'none';
            var b17 = $('#button7');
            var b7 = parent7.children()[1];
            var c7 = parent7.children()[2];
            var c17 = b17.children()[0];
            b7.style.display = 'none';
            c7.style.display = 'none';
            c17.style.display = 'none';

            var parent8 = $('#template8');
            var child8 = parent8.children()[0];
            child8.style.display = 'block';

            var parent9 = $('#template9');
            var child9 = parent9.children()[0];
            child9.style.display = 'none';
            var b19 = $('#button9');
            var c19 = b19.children()[0];
            c19.style.display = 'none';

        }
        if (value == 9) {
            var parent1 = $('#template1');
            var div = parent1.children()[0];
            div.style.display = 'none';
            var b19 = $('#button1');
            var b9 = parent1.children()[1];
            var c9 = parent1.children()[2];
            var c19 = b19.children()[0];
            b9.style.display = 'none';
            c9.style.display = 'none';
            c19.style.display = 'none';


            var parent2 = $('#template2');
            var child2 = parent2.children()[0];
            child2.style.display = 'none';
            var b1 = $('#button2');
            var b = parent2.children()[1];
            var c = parent2.children()[2];
            var c1 = b1.children()[0];
            b.style.display = 'none';
            c.style.display = 'none';
            c1.style.display = 'none';

            var parent3 = $('#template3');
            var child3 = parent3.children()[0];
            child3.style.display = 'none';
            var b13 = $('#button3');
            var b3 = parent3.children()[1];
            var c3 = parent3.children()[2];
            var c13 = b13.children()[0];
            b3.style.display = 'none';
            c3.style.display = 'none';
            c13.style.display = 'none';
            var temp = $('.template3');
            var a = temp.children()[0];
            var b = temp.children()[2];
            var c = temp.children()[3];
            var d = temp.children()[4];
            var f = temp.children()[5];
            var g = temp.children()[6];
            var h = temp.children()[7];
            var i = temp.children()[9];
            var j = temp.children()[10]
            a.style.display = 'none'
            b.style.display = 'none'
            c.style.display = 'none'
            d.style.display = 'none'
            f.style.display = 'none'
            g.style.display = 'none'
            h.style.display = 'none'
            i.style.display = 'none'
            j.style.display = 'none'

            var parent4 = $('#template4');
            var child4 = parent4.children()[0];
            child4.style.display = 'none';
            var b14 = $('#button4');
            var b4 = parent4.children()[1];
            var c4 = parent4.children()[2];
            var c14 = b14.children()[0];
            b4.style.display = 'none';
            c4.style.display = 'none';
            c14.style.display = 'none';

            var parent5 = $('#template5');
            var child5 = parent5.children()[0];
            var child51 = parent5.children()[1];
            child5.style.display = 'none';
            child51.style.display = 'none';
            var b15 = $('#button5');
            var c15 = b15.children()[0];
            c15.style.display = 'none';

            var parent6 = $('#template6');
            var child6 = parent6.children()[0];
            child6.style.display = 'none';
            var b16 = $('#button6');
            var b66 = parent6.children()[1];
            var c66 = parent6.children()[2];
            var c16 = b16.children()[0];
            b66.style.display = 'none';
            c66.style.display = 'none';
            c16.style.display = 'none';
            var temp6 = $('.template6');
            var a6 = temp6.children()[1];
            var b6 = temp6.children()[2];
            var c6 = temp6.children()[3];
            var d6 = temp6.children()[4];
            var f6 = temp6.children()[5];
            a6.style.display = 'none';
            b6.style.display = 'none';
            c6.style.display = 'none';
            d6.style.display = 'none';
            f6.style.display = 'none';

            var parent7 = $('#template7');
            var child7 = parent7.children()[0];
            child7.style.display = 'none';
            var b17 = $('#button7');
            var b7 = parent7.children()[1];
            var c7 = parent7.children()[2];
            var c17 = b17.children()[0];
            b7.style.display = 'none';
            c7.style.display = 'none';
            c17.style.display = 'none';

            var parent8 = $('#template8');
            var child8 = parent8.children()[0];
            child8.style.display = 'none';
            var b18 = $('#button8');
            var b8 = parent8.children()[1];
            var c18 = b18.children()[0];
            b8.style.display = 'none';
            c18.style.display = 'none';

            var parent9 = $('#template9');
            var child9 = parent9.children()[0];
            child9.style.display = 'block';

        }
    })
})