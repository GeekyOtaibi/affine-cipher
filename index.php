<html>

<head>
    <title>Affine Cipher</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="assets/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-1 sidenav">
            </div>
            <div class="col-sm-10 text-left">
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <p><b>Kingdom of Saudi Arabia<br>
                                Ministry of Education<br>
                                King Faisal University<br>
                                College of Computer Sciences & Information Technology<br>
                                Department of Computer Sciences</b></p>
                    </div>
                    <div class="col-md-6" align="center">
                        <h1>Affine Cipher</h1>
                        <h5>CS320 Computer Data Security and Privacy</h5>
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Id</th>
                            </tr>
                            <tr>
                                <td>Hamad Al Otaibi</td>
                                <td>214020088</td>
                            </tr>
                            <tr>
                                <td>Ahmed Abakhail</td>
                                <td>213117859</td>
                            </tr>
                            <tr>
                                <td>Muhammed Almagrubi</td>
                                <td>213119515</td>
                            </tr>
                            <tr>
                                <th>Supervisor's name</th>
                            </tr>
                            <tr>
                                <td>Dr. Abdul Raouf Khan</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-3" align="center">
                        <img style="max-width:200px;width:100%" src="https://upload.wikimedia.org/wikipedia/en/7/7b/King_Faisal_University_Logo.png">
                    </div>
                </div>
                <hr>
                <div class="document">
                    <h1>Introduction</h1>
                    <p>Affine Cipher is mono-alphabetic cipher where each letter in an alphabet is mapped to an
                        equivalent numeric.
                        Affine cipher is two-way encryption uses simple mathematical function. It converts letters to
                        their mapped numbers,
                        applied mathematical function then convert it back to letter in encryption and decryption.
                        It use two keys where each letter will be ciphered with the function E(x) = (ax + b) mod 26 and
                        can be decryped back using D(x) = a^-1(x - b) mod 26 where 26 is letters total.</p>

                    <h1>Implementation</h1>
                    <p>this is an implementation of affine cipher using web technology. to apply affine cipher, first
                        it must have 2 keys which is 'a' and 'b' but in certain of
                        condition to be implemented correctly.
                        first we will find the Greatest Common Divisor (gcd). in this code variable a is key a where b
                        is letters total. an example how to call this function "result = gcd(3 , 26);".</p>
                    <pre><code>
function gcd(a, b) {
    if ( ! b) {
        return a;
    }

    return gcd(b, a % b);
};
                    </code></pre>
                    <p>then we start validate if key a and key b are valid to use to encryption process. the condition
                        to have valid keys are where key 'a' is greater than or equal to 1 and less than or equal to 25
                        and key 'b' is greater than or equal to 0 and less than or equal to 25.</p>
                    <pre><code>
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
                    </code></pre>
                    <p></p>
                    <hr>
                    <!--start key a and key b form group-->
                    <div class="row">
                        <div class="col-md-2">Key a</div>
                        <div class="col"><input type="number" id="txtkey-a" class="form-control" placeholder="enter number for key 'a'"></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2">Key b</div>
                        <div class="col"><input type="number" id="txtkey-b" class="form-control" placeholder="enter number for key 'b'"></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <p>before we start encryping, first these three condition must be true.</p>
                            <ul>
                                <li>the GCD of key 'a' and 26 must equal to 1 <strong><span id="condition-gcd"></span></strong></li>
                                <li>key 'a' is greater than or equal to 1 and less than or equal to 25 <strong><span id="condition-key-a"></span></strong></li>
                                <li>key 'b' is greater than or equal to 0 and less than or equal to 25 <strong><span id="condition-key-b"></span></strong></li>
                            </ul>
                        </div>
                    </div>
                    <!--end of key a and key b form group-->
                    <hr>
                    <h3>Encryption</h3>
                    <p>this is encryption function, it splits plaintext's character (which contain small letters) and
                        convert it to array of
                        characters then there will be a foreach loop where it goes in each character, convert it to
                        their code index and supstract to 97 which is the code index where first letter is starting
                        which is small a for example, g's code index is 104 - a's code index is 97 the resault is 6.
                        after convering to number, it will use encryption mathematical equation E(x) = (ax + b) mod 26
                        then convert it back to letter then append it to the ciphertext string.
                    </p>
                    <pre><code>
function encryption(plaintext) {
    if (validateKeys()) {

        splited_plaintext = plaintext.split('');

        var ciphertext = "";

        $.each(splited_plaintext, function (index, value) {
            var letter_value = value.charCodeAt(0) - 97;
            var encrypted_letter = ((letter_value * a) + b) % 26;
            ciphertext = ciphertext + String.fromCharCode(97 + encrypted_letter);
        });

        $(".lblciphertext").html(ciphertext);
    }
}
                    </code></pre>
                    <hr>
                    <div class="row">
                        <div class="col-md-2">Plain Text</div>
                        <div class="col"><input type="text" id="plaintext" class="form-control" onkeypress="return /[a-z]/i.test(event.key)"
                                placeholder="enter plaintext"></div>
                    </div>
                    <br>
                    <pre><code id="encrypting-proccess">
                    </code></pre>
                    <p>cipher text is <strong><span class="lblciphertext"></span></strong></p>
                    <hr>
                    <h3>Decryption</h3>
                    <p>
                        this is decryption function, in decryption we must find the Multiplicative inverse. in this
                        code we use brute force method to find the maximum inverse possible. alfter that, cihpertext
                        will go into foreach loop that convert each letter to the original text using mathematical
                        equation D(x) = inverse of a * (x - b) mod 26. if the result is negative then add 26 to fix the
                        value then covert it to letters and append it to the total.
                    </p>
                    <pre><code>
function decryption(ciphertext) {
    if (validateKeys()) {

        splited_ciphertext = ciphertext.split('');

        var plaintext = "";
        var invert = 0;
        
        //finding Multiplicative Inverse using brute force method
        for (var x = 1; x < 26; x++) {
            if ((a * x) % 26 == 1) {
                invert = x;
            }
        }
        // end of inverse

        $.each(splited_ciphertext, function (index, value) {
            var letter_value = value.charCodeAt(0) - 97;
            var decrypted_letter = (invert * (letter_value - b)) % 26;
            if (decrypted_letter < 0)
                decrypted_letter = decrypted_letter + 26;
            plaintext = plaintext + String.fromCharCode(97 + decrypted_letter);
        });
        $(".lblplaintext").html(plaintext);
    }
}
                    </code></pre>
                    <hr>
                    <div class="row">
                        <div class="col-md-2">Cipher Text</div>
                        <div class="col"><input type="text" id="ciphertext" class="form-control" onkeypress="return /[a-z]/i.test(event.key)"
                                placeholder="enter ciphertext"></div>
                    </div>
                    <br>
                    <pre><code id="decrypting-proccess">
                    </code></pre>
                    <p>plain text is <strong><span class="lblplaintext"></span></strong></p>
                    <hr>
                </div>
            </div>
            <div class="col-sm-1 sidenav">
            </div>
        </div>
        <div class="footer">
            <p>KFU@CCSIT developed by<strong> Hamad Al Otaibi, Ahmed Abakhail, and Muhammed Almagrubi</strong></p>
        </div>
    </div>


    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="script.js"></script>
</body>

</html>