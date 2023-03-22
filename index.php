<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 1 </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
    
    <div class="container">
        <form method="POST" action="done.php">
            <div class="mb-3">
                <label for="fname" class="form-label">First Name : </label>
                <input name="fname" type="text" class="form-control" id="fname" value="Nader">
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name : </label>
                <input name="lname" type="text" class="form-control" id="lname" value="Mohammed">
            </div>
            <!-- textarea -->
            <div class="mb-3">
                <label for="address" class="form-label">Address :</label>
                <textarea name="address" class="form-control" id="address" rows="3">Samannoud, gharbia, egypt</textarea>
            </div>
            <!-- select -->
            <select name="country" class="form-select" aria-label="Default select example">
                <option disabled>Open this select menu</option>
                <option selected value="EG">Egypt</option>
                <option value="UK">United Kingdom</option>
                <option value="US">United States</option>
            </select>
            <!-- Radio checkboxes -->
            <div class="row my-3">
                <div class="col-2">
                    <label for="gender" class="form-label">Gender :</label>
                </div>
                <div class="form-check col-2">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check col-2">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>
            <!-- Checkboxes -->
            <div class="row">
                <div class="mb-3 form-check col-4">
                    <input name="langs[]" type="checkbox" class="form-check-input" id="php" value="PHP" checked>
                    <label class="form-check-label" for="php">PHP</label>
                </div>
                <div class="mb-3 form-check col-4">
                    <input name="langs[]" type="checkbox" class="form-check-input" id="js" value="JavaScript" checked>
                    <label class="form-check-label" for="js">JS</label>
                </div>
                <div class="mb-3 form-check col-4">
                    <input name="langs[]" type="checkbox" class="form-check-input" id="python" value="Python" checked>
                    <label class="form-check-label" for="python">Python</label>
                </div>
                <div class="mb-3 form-check col-4">
                    <input name="langs[]" type="checkbox" class="form-check-input" id="perl" value="Perl">
                    <label class="form-check-label" for="perl">Perl</label>
                </div>
                <div class="mb-3 form-check col-4">
                    <input name="langs[]" type="checkbox" class="form-check-input" id="ruby" value="Ruby">
                    <label class="form-check-label" for="ruby">Ruby</label>
                </div>

                <div class="mb-3 form-check col-4">
                    <input name="langs[]" type="checkbox" class="form-check-input" id="go" value="Go Lang">
                    <label class="form-check-label" for="go">Go Lang</label>
                </div>
                
            </div>
            <!-- login -->
            <div class="mb-3">
                <label for="username" class="form-label">username : </label>
                <input name="username" type="text" class="form-control" id="username" value="username">
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password : </label>
                <input name="pass" type="text" class="form-control" id="pass" value="123456">
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department : </label>
                <input name="department" readonly value="Open Source" type="text" class="form-control" id="department">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>