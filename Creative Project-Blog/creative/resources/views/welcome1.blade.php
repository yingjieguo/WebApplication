<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Theme Made By www.w3schools.com - No Copyright -->
    <title>503 Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script> --}}
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js"></script> --}}
    <style>
    body {
        font: 400 15px/1.8 Lato, sans-serif;
        color: #111;
    }
    
    h3,h4 {
        margin: 10px 0 30px 0;
        letter-spacing: 10px;
        font-size: 20px;
        color: #111;
    }
    
    .container {
        padding: 80px 120px;
    }
    
    .person {
        border: 10px solid transparent;
        margin-bottom: 25px;
        width: 80%;
        height: 80%;
        opacity: 0.7;
    }
    
    .person:hover {
        border-color: #f1f1f1;
    }
    
    .carousel-inner img {
        -webkit-filter: grayscale(90%);
        filter: grayscale(20%);
        /* make all photos black and white */
        width: 100%;
        /* Set width to 100% */
        margin: auto;
    }
    
    .carousel-caption h3 {
        color: #fff !important;
    }
    
    @media (max-width: 600px) {
        .carousel-caption {
            display: none;
            /* Hide the carousel text when the screen is less than 600 pixels wide */
        }
    }
    
    .band {
        width: 100%;
        background-color: #F0E68C;
    }
    
    .bg-1 {
        background: #2d2d30;
        color: #bdbdbd;
    }
    
    .bg-1 h3 {
        color: #fff;
    }
    
    .bg-1 p {
        font-style: italic;
    }
    
    .list-group-item:first-child {
        border-top-right-radius: 0;
        border-top-left-radius: 0;
    }
    
    .list-group-item:last-child {
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    
    .thumbnail {
        padding: 0 0 15px 0;
        border: none;
        border-radius: 0;
    }
    
    .thumbnail p {
        margin-top: 15px;
        color: #555;
    }
    
    .btn {
        padding: 10px 20px;
        background-color: #333;
        color: #f1f1f1;
        border-radius: 0;
        transition: .2s;
    }
    
    .btn:hover,
    .btn:focus {
        border: 1px solid #333;
        background-color: #fff;
        color: #000;
    }
    
    .modal-header,
    h4,
    .close {
        background-color: #F0E68C;
        color: #000000 !important;
        font-style: italic;
        text-align: center;
    }
    
    .modal-header,
    .modal-body {
        padding: 40px 50px;
    }
    
    .nav-tabs li a {
        color: #777;
    }
    
    #googleMap {
        width: 100%;
        height: 400px;
        -webkit-filter: grayscale(100%);
        filter: grayscale(50%);
    }
    
    .navbar {
        font-family: Montserrat, sans-serif;
        margin-bottom: 0;
        background-color: #DAA520;
        border: 0;
        font-size: 11px !important;
        letter-spacing: 4px;
        opacity: 0.9;
    }
    
    .navbar li a,
    .navbar .navbar-brand {
        color: #d5d5d5 !important;
    }
    
    .navbar-nav li a:hover {
        color: #fff !important;
    }
    
    .navbar-nav li.active a {
        color: #fff !important;
        background-color: #29292c !important;
    }
    
    .navbar-default .navbar-toggle {
        border-color: transparent;
    }
    
    .open .dropdown-toggle {
        color: #fff;
        background-color: #555 !important;
    }
    
    .dropdown-menu li a {
        color: #000 !important;
    }
    
    .dropdown-menu li a:hover {
        background-color: red !important;
    }
    
    footer {
        background-color: #DAA520;
        color: #f5f5f5;
        padding: 32px;
    }
    
    footer a {
        color: #f5f5f5;
    }
    
    footer a:hover {
        color: #777;
        text-decoration: none;
    }
    
    .form-control {
        border-radius: 0;
    }
    
    textarea {
        resize: none;
    }
    </style>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" >BBS</a>
                {{-- href="#myPage" --}}
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#myPage">HOME</a></li>
                    <li><a href="#band">PROJECT</a></li>
                    <li><a href="#contact">INFO</a></li>
                    <li><a href="{{Auth::check()? route('trytrytry'):url('auth/login')}}">{{Auth::check()?'Enter BBS':'Login'}} </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="wustl-wp-brookings-trees.jpg" alt="New York" width="1200" height="700">
                <div class="carousel-caption">
                    <p></p>
                </div>
            </div>
            <div class="item">
                <img src="seigle_hall.jpg" alt="Chicago" width="1200" height="700">
                <div class="carousel-caption">
                    <p></p>
                </div>
            </div>
            <div class="item">
                <img src="b7f0f01390337b3cd0eed9024e1c2050.jpg" alt="Los Angeles" width="1200" height="700">
                <div class="carousel-caption">
                    <p></p>
                </div>
            </div>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- Container (The Band Section) -->
    <div id="band" class="container">
        <div class="text-center">
            <h3>THE PROJECT</h3>
            <p><em>We love coding!</em></p>
        </div>
        <div id="ad" class="container col-sm-12">
            <p>In this project, we used PHP Laravel to build a functional BBS. In this BBS, you can talk about your creative ideas, your every thought. You can share your posts with everyone in the world, and also you can choose to hide this post from yourself. Besides, there is another important feature in our blog. You can post blogs without others' knowing that's yours post. From this feature, you can share your secrets with other people, and get useful help about some awkwark questions.</p>
            <p>We encourage you to try out blogs first before making any decision, because we have it all!!!!!!!!!</p>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3">
                <p><strong>Zhen Cheng:</strong></p>
                <br>
                <a href="#demo" data-toggle="collapse">
                    <img src="IMG_0379.JPG" class="img-circle" alt="Random Name" width="120" height="120">
                </a>
                <div id="demo" class="collapse">
                    <p>Master Student</p>
                    <p>Major in Information Science</p>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-3">
                <p><strong>Yingjie Guo:</strong></p>
                <br>
                <a href="#demo2" data-toggle="collapse">
                    <img src="IMG_0884.JPG" class="img-circle" alt="Random Name" width="120" height="120">
                </a>
                <div id="demo2" class="collapse">
                    <p>Master Student</p>
                    <p>Major in Computer Science</p>
                    <p></p>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
    <hr>
    <!-- Container (Contact Section) -->
    <div id="contact" class="container">
        <h3 class="text-center">INFO</h3>
        <!--<p class="text-center"><em>We need suggestions!</em></p>-->
        <div class="row">
            <p class="text-center"><span class="glyphicon glyphicon-map-marker"></span>Saint Louis, US</p>
            <p class="text-center"><span class="glyphicon glyphicon-phone"></span>Phone: You can use email</p>
            <p class="text-center"><span class="glyphicon glyphicon-envelope"></span>Email: Just kidding. Don't contact us.</p>
        </div>
        <br>
        
        <br>
        <h3 class="text-center">Our Blog</h3>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Basic Function</a></li>
            <li><a data-toggle="tab" href="#menu1">Creative</a></li>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <br>
                <h2>What we can do</h2>
                <br>
                <ul>
                    <li>login, logout, Register</li>
                    <li>Laravel environment sets correctly on EC2</li>
                    <li>You can Choose a category to post</li>
                    <li>Only other user can comment, author can't</li>
                    <li>Can correctly list all Comments to a blog</li>
                    <li>Show the time of created at and updated at</li>
                    <li>List all posts ordered by post time. Newest First</li>
                    <li>Can't edit or delete other's posts.</li>
                    <li>Show the author</li>
                    <li>Shortcut for edit besides readmore.(only for author)</li>
                    <li>Shortcut for post in the up right corner</li>
                    <li>You can go back to the welcome page from navigation bar</li>
                </ul>
            </div>
            <div id="menu1" class="tab-pane fade">
                {{-- <h2>Yingjie Guo, creator</h2> --}}
                {{-- <p>Always a pleasure people! Hope you enjoyed it as much as I did. Could I BE.. any more pleased?</p> --}}
                <br>
                <ul>
                    <li>You can create new category in the up-right corner, and make changes to your post's category </li>
                    <li>icon mark</li>
                    <li>You have to login to comment</li>
                    <li>You don't have to login to view, but you need to login to post</li>
                    <li>Only show first few words of post. You have to click readmore to read the whole post</li>
                    <li>Release an anonymous post</li>
                    <li>The Carousel Plugin on the welcome page</li>
                    <li>The Scrollspy Plugin: a navigation bar at the top of the page that collapses on smaller screens, scroll with the content of the page.</li>
                </ul>
            </div>
        </div>
    </div>
{{--     <div id="googleMap"></div>
    <!-- Add Google Maps -->

    <script>
    var myCenter = new google.maps.LatLng(38.649583, -90.306326);

    function initialize() {
        var mapProp = {
            center: myCenter,
            zoom: 12,
            scrollwheel: false,
            draggable: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

        var marker = new google.maps.Marker({
            position: myCenter,
        });

        marker.setMap(map);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
    </script> --}}

<div>
<img src="http://cdn.head-fi.org/9/9d/9d5cd10a_determined-fumanchu-computer-stare-l.png" alt="blank" height="956" width="1250">
</div>
<div class="text-center">
    <img src="http://s2.quickmeme.com/img/bd/bd10948b3ea22e8cb119ed98dec57cd07143d7d40a2ca81c20baf750cc00030e.jpg" alt="">
</div>
    <!-- Footer -->
    <footer class="text-center">
        <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
            <span class="glyphicon glyphicon-chevron-up"></span>
        </a>
        <br>
        <br>
        <p>503 Project made by: Yingjie Guo , Zhen Cheng</p>
    </footer>

    <script>
    $(document).ready(function() {
        // Initialize Tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Add smooth scrolling to all links in navbar + footer link
        $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {

                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 900, function() {

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
    })
    </script>
</body>

</html>
