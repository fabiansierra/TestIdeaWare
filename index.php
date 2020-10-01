<?php
  require "get-access-token.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/subscriber.js"></script>
  <title>Register Suscribers Aweber</title>
</head>
<body>
  <div class="container">
    <div class="col-lg-6 form-subscriber">
      <div class="col-lg-12 title">
        <h1>Add a Subscriber</h1>
        <label>Please fill the following items to add a new subscriber</label>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <label for="name" class="control-label">Name</label>
          <input type="text" 
                 class="form-control" 
                 id="name_subscriber" 
                 name="name_subscriber">
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <label for="email" class="control-label">Email</label>
          <input type="text" 
                 class="form-control" 
                 id="email_subscriber" 
                 name="email_subscriber">
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <label for="name" class="control-label">Ad Tracking</label>
          <input type="text" 
                 class="form-control" 
                 id="track_subscriber" 
                 name="track_subscriber">
        </div>
      </div>
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-6">
            <input type="checkbox" 
                    id="check_terms" 
                    name="check_terms">
            <a href="#" data-toggle="modal" data-target="#terms">
              <label for="name" class="control-label">Terms and Conditions</label>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <button class="btn btn-success" id="save">Save</button>
      </div>
    </div>
    <div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="termsLabel">Terms and Conditions</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Last revised: 6/20/2019</p>


            <p>AWeber's platform is used by nearly 100,000 small businesses around the world to engage with prospects and clients. 
              The integration and automation between the hundreds of different online applications that business owners use can save time and enhance the value they derive from those products. 
              Our API was born out of the desire to open our platform to thousands of independent developers worldwide and service providers to create unique and time saving integrations.</p>
              
            <p>As a part of that process we need to set some easy to follow guidelines to both encourage your imagination around interesting projects as well as protect both AWeber's and 
              users' rights.</p>
              
            <p>We're glad you've chosen to use the AWeber API. By using the AWeber API (the "AWeber API" or "API"), you and, if applicable, the company you represent (collectively, "you") 
              accept and agree to be bound by the following terms and conditions (the "Terms of use" or "Terms") for developing your application ("app"). It is important that you read 
              these Terms as they form a legal agreement between you and AWeber Systems, Inc. ("AWeber", "we", or "us").</p>
              
            <p>In addition to the content of these Terms you also agree to the following agreements:</p>
              
            <p>1. the AWeber Service Agreement at <a href="https://www.aweber.com/service-agreement.htm" target="blank">https://www.aweber.com/service-agreement.htm</a>,</p>
            <p>2. the AWeber Privacy Policy at <a href="https://www.aweber.com/privacy.htm" target="blank">https://www.aweber.com/privacy.htm</a>,</p>
            <p>3. the AWeber Anti-spam Policy at <a href="https://www.aweber.com/antispam.htm" target="blank">https://www.aweber.com/antispam.htm</a>, and</p>
            <p>4. the AWeber Data Processing and Security Terms at <a href="https://www.aweber.com/dpst.htm" target="blank">https://www.aweber.com/dpst.htm</a></p>
            <p>5. If you disagree with anything in these Terms, do not click that you agree to them, do not create an AWeber Developer account, and do not access or use the AWeber API.</p>
              
            <p>AWeber reserves the right, from time to time, with or without notice to you, to change these Terms. The most current version of these Terms can be reviewed at this URL 
              anytime. The most current version of the Terms will supersede all previous versions. By using the AWeber API after changes are made to the Terms you agree to be bound by 
              these changes. Your only recourse, if you disagree, is to discontinue your use of the API.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>