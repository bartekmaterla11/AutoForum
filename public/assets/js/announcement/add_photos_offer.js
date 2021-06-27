$(document).ready(function () {
    var parent1 = $('#photo-1');
    var photo11 = parent1.children()[1];

    parent1.on('change', function (){
        var photo1name = photo11.value;
        var value1 = photo1name.substring(photo1name.lastIndexOf("\\") + 1, photo1name.length);

        if(value1){
           var label = parent1.children()[0];
            label.style.cssText=` white-space: pre-line`;
           label.innerHTML=value1
        }
    })
    var parent2 = $('#photo-2');
    var photo22 = parent2.children()[1];

    parent2.on('change', function (){
        var photo2name = photo22.value;
        var value2 = photo2name.substring(photo2name.lastIndexOf("\\") + 1, photo2name.length);

        if(value2){
            var label = parent2.children()[0];
            label.style.cssText=`font-size: 13px!important; margin-top: 8px!important; white-space: pre-line`;
            label.innerHTML=value2
        }
    })

    var parent3 = $('#photo-3');
    var photo33 = parent3.children()[1];

    parent3.on('change', function (){
        var photo3name = photo33.value;
        var value3 = photo3name.substring(photo3name.lastIndexOf("\\") + 1, photo3name.length);

        if(value3){
            var label = parent3.children()[0];
            label.style.cssText=`font-size: 13px!important; margin-top: 8px!important; white-space: pre-line`;
            label.innerHTML=value3
        }
    })
    var parent4 = $('#photo-4');
    var photo44 = parent4.children()[1];

    parent4.on('change', function (){
        var photo4name = photo44.value;
        var value4 = photo4name.substring(photo4name.lastIndexOf("\\") + 1, photo4name.length);

        if(value4){
            var label = parent4.children()[0];
            label.style.cssText=`font-size: 13px!important; margin-top: 8px!important; white-space: pre-line`;
            label.innerHTML=value4
        }
    })
    var parent5 = $('#photo-5');
    var photo55 = parent5.children()[1];

    parent3.on('change', function (){
        var photo5name = photo55.value;
        var value5 = photo5name.substring(photo5name.lastIndexOf("\\") + 1, photo5name.length);

        if(value5){
            var label = parent5.children()[0];
            label.style.cssText=`font-size: 13px!important; margin-top: 8px!important; white-space: pre-line`;
            label.innerHTML=value5
        }
    })
    var parent6 = $('#photo-6');
    var photo66 = parent6.children()[1];

    parent6.on('change', function (){
        var photo6name = photo66.value;
        var value6 = photo6name.substring(photo6name.lastIndexOf("\\") + 1, photo6name.length);

        if(value6){
            var label = parent6.children()[0];
            label.style.cssText=`font-size: 13px!important; margin-top: 8px!important; white-space: pre-line`;
            label.innerHTML=value6
        }
    })
    var parent7 = $('#photo-7');
    var photo77 = parent7.children()[1];

    parent7.on('change', function (){
        var photo7name = photo77.value;
        var value7 = photo7name.substring(photo7name.lastIndexOf("\\") + 1, photo7name.length);

        if(value7){
            var label = parent7.children()[0];
            label.style.cssText=`font-size: 13px!important; margin-top: 8px!important; white-space: pre-line`;
            label.innerHTML=value7
        }
    })
    var parent8 = $('#photo-8');
    var photo88 = parent8.children()[1];

    parent8.on('change', function (){
        var photo8name = photo88.value;
        var value8 = photo8name.substring(photo8name.lastIndexOf("\\") + 1, photo8name.length);

        if(value8){
            var label = parent8.children()[0];
            label.style.cssText=`font-size: 13px!important; margin-top: 8px!important; white-space: pre-line`;
            label.innerHTML=value8
        }
    })
    $('#save_photos_offer').on('click', function () {

        const files1 = document.querySelectorAll('[type=file]');

        const formData = new FormData();
        for(let j = 0; j < files1.length; j++){
            let aa = files1[j].files;
            for (let i = 0; i < aa.length; i++) {
                let file = aa[i];

                formData.append('files[]', file)
            }
        }

        $.ajax({
            url: "/ajax/photos-offer",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function () {}

        });

    })

})