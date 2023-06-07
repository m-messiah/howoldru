<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <title>How old are you?</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        p{
            font-size: 16px;
            line-height: 1.6180em;
        }

        .main{
            background-image: url('https://vpassets.infinityfree.net/welcome2017/background.jpg');
            background-position: center center;
            background-size: cover;
            height: auto;
            left: 0;
            min-height: 100%;
            min-width: 100%;
            position: absolute;
            top: 0;
            width: auto;
        }
        .cover{
            position: fixed;
            opacity: 1;
            background-color: rgba(0,0,0,.75);
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .logo-container .logo{
            overflow: hidden;
            border-radius: 50%;
            border: 1px solid #333333;
            width: 60px;
            float: left;
        }

        .main .logo{
            color: #FFFFFF;
            font-size: 56px;
            font-weight: 300;
            position: relative;
            text-align: center;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.33);
            margin-top: 150px;
            z-index: 3;
        }
        .main .logo.cursive{
            font-family: 'Grand Hotel',cursive;
            font-size: 82px;

        }
        .main .content{
            position: relative;
            z-index: 4;
            color: #FFFFFF;
            font-size: 16px;
            top: 20px;
        }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>
</head>

<body>
<div class="main">
    <div class="cover">
    <div class="container">
        <h1 class="logo cursive">
            How old are you?
        </h1>

        <div class="content show">
            <form id="formBirthday" class="form-horizontal col-sm-9 offset-sm-1">
                <div class="row mb-3" id="row_name">
                    <label for="inputName" class="col-sm-2 col-form-label">Your name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name">
                    </div>
                </div>
                <div class="row mb-3" id="row_birthday">
                    <label for="inputBirthday" class="col-sm-2 col-form-label">Your birthday</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="inputBirthday" name="birthday" placeholder="2021-01-27">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="button" id="submitButton" class="btn btn-secondary">Submit</button>
                    </div>
                </div>
            </form>
            <div id="resultDiv" class="visually-hidden">
                <h1>Hello <span id="resultName"></span>!</h1>
                <h1>Your age is <span id="resultAge"></span></h1>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script>
    function handleError(field, reason) {
        $("#formBirthday .row").removeClass("has-error");
        $("#formBirthday .row .help-block").remove();
        $("#row_"+field).addClass("has-error");
        $("#row_"+field+" input").attr("aria-describedby", "help_"+field);
        $("#row_"+field+" div").append('<span id="help_'+field+'" class="help-block bg-danger">'+reason+'</span>');
    }

    $('#submitButton').click( function() {
        return $.post("/check.php", $("#formBirthday").serialize(), function(data) {
            if (data["status"] != "OK") {
                handleError(data["field"], data["reason"]);
            } else {
                $("#formBirthday").removeClass("show");
                $("#formBirthday").addClass("visually-hidden");
                $("#resultName").text(data["name"]);
                $("#resultAge").text(data["age"]);
                $("#resultDiv").removeClass("visually-hidden");
                $("#resultDiv").addClass("show");
            }
        }, 'json');
    });
</script>
</body>
</html>
