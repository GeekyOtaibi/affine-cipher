$(function () {
    //$("input").val('');
    //--demo--------------------------
    $("#txtkey-a").val(7);
    $("#txtkey-b").val(2);
    $("#plaintext").val("helloworld");
    $("#ciphertext").val("zebbwawrbx");
    validateKeys();
    encryption("helloworld");
    decryption("zebbwawrbx");
    //----------------------------
    $("#plaintext").change(function () {
        refresh();
    });
    $("#ciphertext").change(function () {
        refresh();
    });
    $("#txtkey-a").change(function () {
        refresh();
    });
    $("#txtkey-b").change(function () {
        refresh();
    });
});

function refresh(){
    validateKeys();
    encryption($("#plaintext").val());
    decryption($("#ciphertext").val());
}

var a = 1;
var b = 1;

function gcd(a, b) {
    if (!b) {
        return a;
    }
    return gcd(b, a % b);
}

function validateKeys() {
    a = $("#txtkey-a").val();
    b = $("#txtkey-b").val();
    var pass = true;
    var gcd_val = gcd(a, 26);

    if (gcd_val == 1) {
        $("#condition-gcd").html("True");
    } else {
        $("#condition-gcd").html("False");
        pass = false;
    }
    if (a >= 1 && a <= 25) {
        $("#condition-key-a").html("True");
    } else {
        $("#condition-key-a").html("False");
        pass = false;
    }
    if (b >= 1 && b <= 25) {
        $("#condition-key-b").html("True");
    } else {
        $("#condition-key-b").html("False");
        pass = false;
    }
    return pass;
}

function encryption(plaintext) {
    if (validateKeys()) {

        splited_plaintext = plaintext.split('');

        var ciphertext = "";
        var log = "";
        a = Number(a);
        b = Number(b);

        $.each(splited_plaintext, function (index, value) {
            var letter_value = value.charCodeAt(0) - 97;
            var encrypted_letter = ((letter_value * a) + b) % 26;
            log = log + value + " => (" + letter_value + " * " + a + " + " + b + ") % 26 = " + encrypted_letter + " => " + String.fromCharCode(97 + encrypted_letter) + "\n";
            ciphertext = ciphertext + String.fromCharCode(97 + encrypted_letter);
        });

        $("#encrypting-proccess").html(log);
        $(".lblciphertext").html(ciphertext);
    }
}

function decryption(ciphertext) {
    if (validateKeys()) {

        splited_ciphertext = ciphertext.split('');

        var plaintext = "";
        var log = "";
        var invert = 0;
        a = Number(a);
        b = Number(b);

        for (var x = 1; x < 26; x++) {
            if ((a * x) % 26 == 1) {
                invert = x;
                console.log(invert);
            }
        }

        $.each(splited_ciphertext, function (index, value) {
            var letter_value = value.charCodeAt(0) - 97;
            var decrypted_letter = (invert * (letter_value - b)) % 26;
            if (decrypted_letter < 0) {
                decrypted_letter = decrypted_letter + 26;
                log = log + value + " => ((" + invert + " * (" + letter_value + " - " + b + ")) % 26 ) + 26 = " + decrypted_letter + " => " + String.fromCharCode(97 + decrypted_letter) + "\n";
            } else
                log = log + value + " => (" + invert + " * (" + letter_value + " - " + b + ")) % 26 = " + decrypted_letter + " => " + String.fromCharCode(97 + decrypted_letter) + "\n";
            plaintext = plaintext + String.fromCharCode(97 + decrypted_letter);
        });
        $("#decrypting-proccess").html(log);
        $(".lblplaintext").html(plaintext);
    }
}