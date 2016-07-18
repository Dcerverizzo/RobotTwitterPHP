<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SION - My Twitter Robot  </title>

        <!-- Bootstrap Core CSS -->
        <link href="core/vendor/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="core/vendor/css/logo-nav.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="http://placehold.it/150x50&text=Logo" alt="">
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#">About</a>
                        </li>
                        <li>
                            <a href="#">Serviços</a>
                        </li>
                        <li>
                            <a href="#">Contato</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1> My Robot Twitter</h1>
                    <br/>
                    <form class="form-horizontal" method="post" action="robot.php">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="tweet">Tweet:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tweet" id="tweet" placeholder="Enter Tweet">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="consumerKey">Consumer key: *:</label>
                            <div class="col-sm-10"> 
                                <input type="text" class="form-control" id="consumerKey" name="consumerKey" placeholder="Enter Consumer key">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="consumerSecret">Consumer secret: *</label>
                            <div class="col-sm-10"> 
                                <input type="text" class="form-control" id="consumerSecret" name="consumerSecret" placeholder="Enter Consumer secret">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="acessToken">Access token:</label>
                            <div class="col-sm-10"> 
                                <input type="text" class="form-control" id="acessToken" name="acessToken" placeholder="Enter Access token">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="acessTokenSecret">Access token secret:</label>
                            <div class="col-sm-10"> 
                                <input type="text" class="form-control" id="acessTokenSecret" name="acessTokenSecret" placeholder="Enter Access token secret">
                            </div>
                        </div>
                       <!-- <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label><input type="checkbox">Auto Follow</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label><input type="checkbox">Auto unfollow</label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- /.container -->
        <!-- jQuery -->
        <script src="core/vendor/js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="core/vendor/js/bootstrap.min.js"></script>

    </body>

</html>
