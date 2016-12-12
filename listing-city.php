<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : dashboard.php

// Page title
$title = "Cloud Estate | Dashboard";

// Include header
include_once('header.php');


?>

    <div class="content">
        <div class="container">
            <div class="text-center">
                <h1>Search listing</h1>
                <p>Use the map below to select a city.</p>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <img src="img/map.png" alt="" usemap="#Map" />
                    <map name="Map" id="Map">
                        <area alt="Ajax" title="Ajax" href="listing-search.php?City=Ajax" shape="rect" coords="647,404,689,469" />
                        <area alt="Whitby" title="Whitby" href="listing-search.php?City=Whitby" shape="rect" coords="690,348,736,469" />
                        <area alt="Oshawa" title="Oshawa" href="listing-search.php?City=Oshawa" shape="rect" coords="785,348,738,470" />
                        <area alt="Clarington" title="Clarington" href="listing-search.php?City=Clarington" shape="rect" coords="979,364,789,480" />
                        <area alt="Scugog" title="Scugog" href="listing-search.php?City=Scugog" shape="poly" coords="687,239,690,344,787,343,790,359,874,358,877,252" />
                        <area alt="Brock" title="Brock" href="listing-search.php?City=Brock" shape="poly" coords="781,18,748,14,688,102,688,231,779,233" />
                        <area alt="Oxbridge" title="Oxbridge" href="listing-search.php?City=Oxbridge" shape="rect" coords="590,172,684,344" />
                        <area alt="Pickering" title="Pickering" href="listing-search.php?City=Pickering" shape="poly" coords="589,349,591,451,603,466,643,470,644,399,683,397,683,351" />
                        <area alt="Georgina" title="Georgina" href="listing-search.php?City=Georgina" shape="poly" coords="684,162,682,107,587,97,516,113,487,167" />
                        <area alt="East Gwillimbury" title="East Gwillimbury" href="listing-search.php?City=East Gwillimbury" shape="poly" coords="582,173,485,174,475,189,464,240,512,240,515,252,584,255" />
                        <area alt="Whitchurch Stouffville" title="Whitchurch Stouffville" href="listing-search.php?City=Whitchurch Stouffville" shape="poly" coords="510,256,503,352,586,350,585,262" />
                        <area alt="Newmarket" title="Newmarket" href="listing-search.php?City=Newmarket" shape="rect" coords="463,248,502,275" />
                        <area alt="Aurora" title="Aurora" href="listing-search.php?City=Aurora" shape="rect" coords="456,280,500,316" />
                        <area alt="Richmond Hill" title="Richmond Hill" href="listing-search.php?City=Richmond Hill" shape="poly" coords="453,319,499,321,480,400,440,400" />
                        <area alt="Markham" title="Markham" href="listing-search.php?City=Markham" shape="poly" coords="499,357,485,408,453,408,453,424,583,420,583,357" />
                        <area alt="Toronto" title="Toronto" href="listing-search.php?City=Toronto" shape="poly" coords="327,426,334,485,322,499,339,508,334,529,340,544,387,523,421,546,601,474,585,455,586,428" />
                        <area alt="Vaughan" title="Vaughan" href="listing-search.php?City=Vaughan" shape="poly" coords="448,406,435,404,442,342,316,341,327,420,445,421" />
                        <area alt="King" title="King" href="listing-search.php?City=King" shape="poly" coords="466,190,408,246,309,256,318,333,442,337" />
                        <area alt="Caledon" title="Caledon" href="listing-search.php?City=Caledon" shape="poly" coords="89,276,178,432,312,357,301,254,135,251" />
                        <area alt="Brampton" title="Brampton" href="listing-search.php?City=Brampton" shape="poly" coords="213,489,186,439,314,365,319,435,274,471" />
                        <area alt="Mississuga" title="Mississuga" href="listing-search.php?City=Mississuga" shape="poly" coords="322,443,207,503,242,559,254,557,273,591,332,548" />
                        <area alt="Haton Hills" title="Haton Hills" href="listing-search.php?City=Haton Hills" shape="poly" coords="148,391,70,436,119,520,151,503,159,516,208,495" />
                        <area alt="Milton" title="Milton" href="listing-search.php?City=Milton" shape="poly" coords="200,507,158,525,149,513,120,529,63,439,11,468,85,584,133,557,159,599,190,568,228,555" />
                        <area alt="Burlington" title="Burlington" href="listing-search.php?City=Burlington" shape="poly" coords="157,610,131,567,86,594,119,655,80,658,93,685,190,651,164,606" />
                        <area alt="Oakville" title="Oakville" href="listing-search.php?City=Oakville" shape="poly" coords="232,558,189,578,170,602,195,644,268,596" />
                    </map>
                </div>
            </div>
            <br/>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>