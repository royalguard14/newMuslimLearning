


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>x</title>

    <link href="assets_old/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets_old/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="assets_old/css/animate.css" rel="stylesheet">
    <link href="assets_old/css/styleowa.css" rel="stylesheet">

</head>
<body class="gray-bg">
    
    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div> 
            
            </div>
            <center>              
              <img src="{{asset('assets_old/img/zear_logo.png')}}" style="width:50%">                 
                <p >New Muslim Library</h2>
            </center>
            <p>
            </p>            
            <form role="form" method="POST" action="{{Route('getlogin')}}">
                <?php if (Session::get('errorMessage')):?>
                    <div class="alert alert-danger text-center alert-dismissible flash" role="alert">
                        <center><h4> {!! Session::get('errorMessage') !!}</h4></center>
                    </div>                                                                        
                <?php endif;?>
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                <div class="form-group">
                    <input type="username" class="form-control" placeholder="Username" required="" name="username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="" name="password">
                </div>                
                
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                
            </form>                   
            <p class="m-t"> <small> &copy; </small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="assets_old/js/jquery-3.1.1.min.js"></script>
    <script src="assets_old/js/bootstrap.min.js"></script>

</body>
</html>
<!-- Software Developer: JOSHUA M. FRADEJAS -->
