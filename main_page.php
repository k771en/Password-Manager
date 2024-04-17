<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Generator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Password Generator</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="passwordLength">Password Length:</label>
                            <input type="range" id="passwordLength" min="8" max="20" value="12" class="form-control-range">
                            <span id="passwordLengthValue">12</span>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" id="includeSymbols" class="form-check-input">
                            <label for="includeSymbols" class="form-check-label">Include Symbols</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="generatedPassword" class="form-control" readonly>
                        </div>
                        <button id="generatePassword" class="btn btn-primary btn-block">Generate Password</button>
                        <form action="save_password.php" method="get">
                            <button type="submit" class="btn btn-secondary btn-block mt-3">Save Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById("passwordLength").addEventListener("input", function() {
            var value = document.getElementById("passwordLength").value;
            document.getElementById("passwordLengthValue").textContent = value;
        });

        document.getElementById("generatePassword").addEventListener("click", function() {
            var length = document.getElementById("passwordLength").value;
            var includeSymbols = document.getElementById("includeSymbols").checked;
            var characters = "0123456789";
            if (includeSymbols) {
                characters += "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%^&$";
            }
            var randomPassword = "";
            for (var i = 0; i < length; i++) {
                var randomIndex = Math.floor(Math.random() * characters.length);
                randomPassword += characters.charAt(randomIndex);
            }
            document.getElementById("generatedPassword").value = randomPassword;
        });
    </script>
</body>
</html>
