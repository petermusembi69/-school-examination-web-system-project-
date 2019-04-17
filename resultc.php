
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <title>Real Estate Agnecy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="manifest" href="js/manifest.json"/>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/main.js"></script>
    <style type='text/css'>
    .c
    {
         background-image: url('image/animation.png');
    }
    .b
    {
         background-color: rgba(0,0,0,0.4);
    }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark">
        
        <a class="navbar-brand" href="#">
        <img src="image/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
        <i class="fa fa-user" aria-hidden="true"></i>
        COD Portal
      </a>
                <button class="navbar-toggler dropdown-toggle" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <div class="collapse navbar-collapse float-md-right" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="codprofile.php">Units</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">Results<span class="sr-only light">(current)</span></a>
                            </li>
                            <li>
                              <a class="nav-link" href="logout.php" style="text-decoration:none;">Logout</a>
                            </li> 
                         </ul>
                     </div>
         </nav>
  <p><br/></p>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <hr>
                <div><p class="text-monospace">Search forstudent result using by Registration number to display results</p></div>
                <hr/>
            </div>
        </div>
    </div>
  <div class="container-fluid">
        <div class="row">
        <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" id="search">
                <button class="btn btn-outline-success my-2 my-sm-0" id="search_btn">Search</button>
              </form>
            </div>
        <div class="col-md-4"></div>
        </div>
    </div>
    <p><br/></p>
    <p><br/></p>

    <div class="container-fluid">
		     <div class="row">
			     <div class="col-md-1"></div>
				 <div class="col-md-10" id="get_results"></div>
				 <!--student results -->
				 <div class="col-md-1"></div>
			 </div>
       </div>
    <p><br/></p>
    <p><br/></p>
    <p><br/></p>
    <p><br/></p>
    <p><br/></p>
<!--footer-->
<div class='row'>
  <div class='col-md-1'></div>
  <div class='col-md-10'>
  <footer class="section footer-classic" style="background-color: BurlyWood;">
        <div class="container">
          <div class="row row-30">
            <div class="col-md-4 col-xl-5">
              <div class="pr-xl-4"><a class="brand" href="index.html"><img class="brand-logo-light" src="images/agency/logo-inverse-140x37.png" alt="" width="140" height="37" srcset="images/agency/logo-retina-inverse-280x74.png 2x"></a>
                <p>This is dekut, the home of technology.</p>
                
              </div>
            </div>
            <div class="col-md-4">
              <h5>Contacts</h5>
              <dl class="contact-list">
                <dt>Address:</dt>
                <dd> Nyeri kenya</dd>
              </dl>
              <dl class="contact-list">
                <dt>email:</dt>
                <dd><a href="mailto:#"><span style="text-color: black;">dekut@gmail.com</span></a></dd>
              </dl>
              <dl class="contact-list">
                <dt>phones:</dt>
                <dd><a href="tel:#">+254700583879</a> <span>or</span> <a href="tel:#">+254700583879</a>
                </dd>
              </dl>
            </div>
            <div class="col-md-4 col-xl-3">
              <h5>Links</h5>
              <ul class="nav-list">
                <li><a href="about.php">About Us</a></li>
                <li><a href="help.php">Help Center</a></li>
                <li><a href="about.php">Contacts</a></li>
              </ul>
            </div>
          </div>
        </div>
</footer>
<hr>
<!-- Rights-->
<p class="rights"><span>©  </span><span class="copyright-year">2018</span><span> </span><span>Kenya</span><span>. </span><span>All Rights Reserved.</span></p>
  </div>
  <div class='col-md-1'></div>
</div>

</body>
</html>