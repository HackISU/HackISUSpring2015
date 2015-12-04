<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HackISU - Success</title>

    <link rel="icon" type="image/png" href="./img/hackathonlogo2.ico">
    <!-- Bootstrap Core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <header>
        <div class="overlay">
            <div class="container">
                <div class="intro-text" style="padding-top:100px">
                    <div class="intro-heading">
                        <img style="width:25%" src="./img/hackathonlogo2.png"/>
                    </div>
                    <h2 class="section-heading icon-red">Congrats! You've almost registered for HackISU Spring 2016!</h2>
                    <div class="row">
                            <h4 class="resume-form icon-red">Upload your resume to share it with our sponsors (optional):</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-5 form-group"></div>
                        <div class="col-md-2 form-group">
                          <!--input type="text" class="form-control" id="resume" placeholder="http://example.com/your/resume/url"-->
                            <input type="file" name="fileselect" id="fileselect"></input>
                        </div>
                        <div class="col-md-5 form-group"></div>
                    </div>
                    <div class="row">
                        <div onclick="postData()" class="resume-form btn btn-xl">Submit</div>
                        <h2 id="uploading" class="section-heading icon-red" style="display:none">Uploading....</h2>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script>
    $(document).ready(function(){

    });

                var file;

            // Set an event listener on the Choose File field.
            $('#fileselect').bind("change", function(e) {
              var files = e.target.files || e.dataTransfer.files;
              // Our file var now holds the selected file
              file = files[0];
            });

        var postData = function(){

            var resume = $("#resume").val();

            if (!file){
                addData("");
                return;
            }

            var serverUrl = 'https://api.parse.com/1/files/' + file.name;
            $(".resume-form").hide();
            $("#uploading").show();
          $.ajax({
            type: "POST",
            beforeSend: function(request) {
              request.setRequestHeader("X-Parse-Application-Id", '0FVA52cDu3JzTMyNGFuhrHRu19lIlRJN2jT0NVQd');
              request.setRequestHeader("X-Parse-REST-API-Key", 'dwQxzzeJEbRNygTjBh3LNaE3kO4hPiVXhoegcreq');
              request.setRequestHeader("Content-Type", file.type);
            },
            url: serverUrl,
            data: file,
            processData: false,
            contentType: false,
            success: function(data) {
                addData(data.url);
            },
            error: function(data) {
              var obj = jQuery.parseJSON(data);
              //alert(obj.error);
            }
          });
        }

        var addData = function(url){
            var token = getUrlParameter("access_token");
            $.ajax({
                    type: "POST",
                    url: "http://hackisu-signup.herokuapp.com/signup",
                    data: JSON.stringify({token:token,resume:url}),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(data){
                        //console.log(data);
                        window.location.assign("http://hackisu.com");
                    }
            });
        }

        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = decodeURIComponent(window.location.href.split("#")[1]),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        };
    </script>
</body>
</html>
