function zegar() {
    var data = new Date();
    var godzina = data.getHours();
    var min = data.getMinutes();
    var sek = data.getSeconds();
    var terazjest = ((godzina<10)?"0":" ")+godzina+
        ((min<10)?":0":":")+min+
        ((sek<10)?":0":":")+sek;
    document.getElementById("watch").innerHTML = terazjest;
    setTimeout("zegar()", 1000); }
zegar();