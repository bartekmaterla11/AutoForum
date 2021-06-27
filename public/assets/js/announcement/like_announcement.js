$(document).ready(function (){
    $('.likeAnnoun').click(function (e){
        e.preventDefault()
        var that = $(this);
        var offerid = that.data('offerid')

        console.log(offerid)
        $.ajax({
            url: "/ajax/set-like-offer",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                "offerid": offerid,
            },
            success: function (data) {
                if(data.Error){
                    alert('Nie udało się dodać oferty do ulubionych')
                }else{
                    var a = that.parent();
                    var b = a.children()[0];
                    b.style.color = 'rgb(0, 165, 255)'

                    alert('Udało się dodać ofertę do ulubionych')
                    location.reload()
                }
            }
        });
        return false;
    })
    $('.likeAnnoun1').click(function (e){
        e.preventDefault()

        var that = $(this);
        var offerid = that.data('offerid')

        console.log(offerid)
        $.ajax({
            url: "/ajax/set-unlike-offer",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                "offerid": offerid,
            },
            success: function (data) {
                if(data.Error){
                    alert('Nie udało się usunąć oferty z ulubionych')
                }else{
                    var a = that.parent();
                    var b = a.children()[0];
                    // var c = a.children()[1];
                    b.style.color = 'rgb(255, 255, 255)'
                    // c.hidden = true;
                    alert('Usunięto ofertę z ulubionych')
                    location.reload()
                }
            }
        });
        return false;
    })
})