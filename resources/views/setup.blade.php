
<!------ Include the above in your HEAD tag ---------->
<?php
    $path = dirname($_SERVER['PHP_SELF']);
    /*echo $path;*/
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- UI CSS -->
<link href="{{ asset('css/login.css') }}" rel='stylesheet' type='text/css' />

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">


    <title>Billing Software System</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">Billing Software</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        
    </div>
</nav>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Installation</div>
                    <div class="card-body">
                        <form id="setupForm" name="setupForm">

                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">Host</label>
                                <div class="col-md-6">
                                    <input type="text" id="host" class="form-control" name="host" required disabled="true">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">Database Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="dbName" class="form-control" name="dbName" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Database User Name</label>
                                <div class="col-md-6">
                                    
                                    <input type="text" id="dbUserName" class="form-control" value="" name="dbUserName" required>
                                    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Database Password</label>
                                <div class="col-md-6">
                                    
                                    <input type="text" id="dbPassword" class="form-control" value="" name="dbPassword">
                                    
                                </div>
                            </div>


                            <div class="col-md-6 offset-md-4">

                                <button type="submit" id="setup" class="btn btn-primary">
                                    Next
                                </button>
                                
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>



<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
                /*alert(window.location.origin);*/
                $('#host').val(window.location.origin)
        $('#setupForm').on('submit',function(e){
            e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    
                    url:'{{url("/setupdb")}}',
                    type:'POST',
                    data:data,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType:'json',
                    contentType:false,
                    processData: false,
                    success:function(element){
                            if(element.success == 1)
                            {
                                location.href="{{url('/login')}}";
                            }
                            else{
                                alert("Invalid Data");
                            }
                    }
                });

        });


        /*$('#signIn').click(function(e)
        {
            
            location.href="http://localhost/ngo-app/public/billing";
        });*/
    });
</script>



</body>
</html>