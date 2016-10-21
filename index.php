<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : index.php

$title = "Cloud Estate | Home";

include('header.php');

?>

<section class="Sector-slider">
    <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="first-slide" id="prlx_lyr_1">
                    <!--image-->
                </div>
                <div class="slide-dimmer">
                    <!--overlay-->
                </div>
                <div class="container">
                    <div class="carousel-caption">
                        <h2>Welcome To Cloud Estate</h2>
                        <p>Your number #1 Real Estate Platform in Durham College</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="second-slide"></div>
                <div class="slide-dimmer">
                    <!--overlay-->
                </div>
                <div class="container">
                    <div class="carousel-caption">
                        <h2>Register Now!</h2>
                        <p>Get the most out of your experience with a Cloud Estate account.</p>
                        <br/>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Register</a></p>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="third-slide"></div>
                <div class="slide-dimmer">
                    <!--overlay-->
                </div>
                <div class="container">
                    <div class="carousel-caption">
                        <h2>Cloud Estate for mobile</h2>
                        <p>Our platform can be access on your mobile device browsers.</p>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
        <div class="enter-site animated infinite pulse">
            <a href="#nav" style="color: white !important; text-decoration: none; font-style: italic;">
                <span>Enter Site</span><br/><i class="fa fa-angle-double-down"></i>
            </a>
        </div>
    </div>
</section>


<section class="sector-white stats">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="stat-val">5</div>
                    <br />
                    <p>Cities</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="stat-val">112</div>
                    <br />
                    <p>Houses</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="stat-val">104</div>
                    <br />
                    <p>Members</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="stat-val">22</div>
                    <br />
                    <p>Agents</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include('footer.php');
?>
