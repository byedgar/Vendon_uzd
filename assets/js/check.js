function validatename() {
    var error = 0;
    var x = document.forms["form1"]["firstname"].value;
    var y = document.forms["form1"]["tests"].value;
    if (x == "") {
        text = "Vārds nav ievadīts";
        alert(text);
        error++;
        return false;

    }
    if (x.length <= 3) {
        text = "Vārds ir mazāk par 4 simboliem";
        alert(text);
        error++;
        return false;

    }
    if (y < 1) {
        text = "Nav izvēlēta ankēta";
        alert(text);
        error++;
        return false;

    }
}


function validateanswer() {
    var x = document.getElementsByName('atbilde');
    for (var i = 0, length = x.length; i < length; i++)
    {
        if (x[i].checked)
        {
            return true;
        } else {
            return false;
        }
    }






    if (x == "") {
        text = "Nav izvēlēta atbilde";
        alert(text);
        return false;
    }
}