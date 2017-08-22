<?php 
require_once( '../app/helpers/head.php');
require_once( '../app/helpers/header.php');

echo '
        <div class="container col-md-12" style="padding: 0px;">
            <div class="wrapper  col-md-12" style="padding: 0px;">
                <div id="ei-slider" class="ei-slider col-md-12">
                    <ul class="ei-slider-large">
                        <li>
                            <img src="icon/1L.jpg" alt="image01"/>
                            <div class="ei-title">
                                <h2>21 Clairtrell Condo</h2>
                                <h3></h3>
                            </div>
                        </li>
                
                        <li>
                            <img src="icon/2L.jpg" alt="image02" />
                            <div class="ei-title">
                                <h2>Elevators</h2>
                                <h3>At our condo, we offer booking services for elevator. If you need one for a certain time, book it online and have it confirm!</h3>
                            </div>
                        </li>
                        <li>
                            <img src="icon/3L.jpg" alt="image03"/>
                            <div class="ei-title">
                                <h2>Party Room</h2>
                                <h3>Rent a private space for your events.</h3>
                            </div>
                        </li>
                       
                        <li>
                            <img src="icon/4L.jpg" alt="image04"/>
                            <div class="ei-title">
                                <h2>Services</h2>
                                <h3></h3>
                            </div>
                        </li>
                     
                    </ul><!-- ei-slider-large -->
                    <ul class="ei-slider-thumbs">
                        <li class="ei-slider-element">Current</li>
                        <li><a href="#">Slide 6</a><img src="icon/1S.jpg" alt="thumb01" /></li>
                        <li><a href="#">Slide 2</a><img src="icon/2S.jpg" alt="thumb02" /></li>
                        <li><a href="#">Slide 3</a><img src="icon/3S.jpg" alt="thumb03" /></li>
                        <li><a href="#">Slide 5</a><img src="icon/4S.jpg" alt="thumb04" /></li>
                    </ul><!-- ei-slider-thumbs -->
                </div><!-- ei-slider -->
            </div><!-- wrapper -->
        </div>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.eislideshow.js"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <script type="text/javascript">
            $(function() {
                $("#ei-slider").eislideshow({
                    animation           : "center",
                    autoplay            : true,
                    slideshow_interval  : 3000,
                    titlesFactor        : 0
                });
            });
        </script>

    </div>
    ';


require_once( '../app/helpers/footer.php');



