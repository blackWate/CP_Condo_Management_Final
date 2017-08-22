<?php

require_once( '../app/helpers/head.php');
require_once( '../app/helpers/header.php');

echo '
  <content>
    <div class="bg">
      <div class="container-fluid">
        <h1>About Us</h1>
      </div>
    </div>
    <div class="container-fluid">
      <h2>21 CLAIRTRELL RD</h2>
      <div class="row">
        <div class="col-sm-4 column">
          Found in Toronto\'s North York area and built in 2013 by Rockport Group, this Toronto condo sits near the intersection of Bayview Ave & Spring Garden Ave South Side. 21 Clairtrell is a mid-rise condo located in the Willowdale East neighbourhood. Located at 21 Clairtrell Road this Toronto condo has suites ranging from 518 to 2525 sqft. <br><br>The condo offers its residents amenities such as a Gym / Exercise Room, Common Rooftop Deck, Concierge and a Party Room. Other amenities include BBQs, Bicycle Parking, Guest Suites, Meeting / Function Room, Outdoor Patio / Garden, Parking Garage, Games / Recreation Room, Security Guard and an Enter Phone System. 
        </div>
        <div class="col-sm-4 column">
          
          <b>21 Clairtrell</b> is a 3 minute walk from Tim Hortons for that morning caffeine fix and if you\'re not in the mood to cook, Tim Hortons and China Court Express are near this condo. Groceries can be found at Loblaws which is a 3 minute walk away and you\'ll find Metro Pharmacy not far away as well. <br><br>New Art & Design is only a short distance away from this condo. Love being outside? Look no further than Bayview Village Park, Sheppard East Park or Hawksbury Park, which are a 6 minute walk from this condo.This condo is currently ranked as the 21st most expensive condo building in North York.

        </div>
        <div class="col-sm-4 column">
          <div class="embed-responsive embed-responsive-4by3">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/quRqrF-cfL0" frameborder="0" allowfullscreen></iframe>">
          </div>

        </div>
      </div>
    </div>
  </content>';

print_r($data['test']);
require_once( '../app/helpers/footer.php');
