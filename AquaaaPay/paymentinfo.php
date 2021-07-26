<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Payment Details</title>
	<link rel="stylesheet" type="text/css" href="css/payment.css">
	<link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css">

	<link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
</head>
<body>

	      <nav>
         <div class="logo">AquaPay</div>
         <ul>
            <li><a class="active" href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Logout</a></li>
            <li><a href="#">Feedback</a></li>
         </ul>
      </nav>
	<div class="container">
  <div class="row">
    <div class="span12">
      <form class="form-horizontal span6">
        <fieldset>
          <legend>Payment</legend>
       
          <div class="control-group">
            <label class="control-label">Card Holder's Name</label>
            <div class="controls">
              <input type="text" class="input-block-level" pattern="\w+ \w+.*" title="Fill your first and last name" required>
            </div>
          </div>
       
          <div class="control-group">
            <label class="control-label">Card Number</label>
            <div class="controls">
              <div class="row-fluid">
                <div class="span3">
                  <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="First four digits" required>
                </div>
                <div class="span3">
                  <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Second four digits" required>
                </div>
                <div class="span3">
                  <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Third four digits" required>
                </div>
                <div class="span3">
                  <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Fourth four digits" required>
                </div>
              </div>
            </div>
          </div>
       
          <div class="control-group">
            <label class="control-label">Card Expiry Date</label>
            <div class="controls">
              <div class="row-fluid">
                <div class="span9">
                  <select class="input-block-level">
                    <option value="01">January</option>
				    <option value="02">February</option>
				    <option value="03">March</option>
				    <option value="04">April</option>
				    <option value="05">May</option>
				    <option value="06">June</option>
				    <option value="07">July</option>
				    <option value="08">August</option>
				    <option value="09">September</option>
				    <option value="10">October</option>
				    <option value="11">November</option>
				    <option value="12">December</option>
                  </select>
                </div>
                <div class="span3">
                  <select class="input-block-level">
                    <option value="2021">2021</option>
				    <option value="2022">2022</option>
				    <option value="2023">2023</option>
				    <option value="2024">2024</option>
				    <option value="2025">2025</option>
				    <option value="2026">2026</option>
				    <option value="2027">2027</option>
				    <option value="2028">2028</option>
				    <option value="2029">2029</option>
				    <option value="2030">2030</option>
				    <option value="2031">2031</option>
				    <option value="2032">2032</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
       
          <div class="control-group">
            <label class="control-label">Card CVV</label>
            <div class="controls">
              <div class="row-fluid">
                <div class="span3">
                  <input type="text" class="input-block-level" autocomplete="off" maxlength="3" pattern="\d{3}" title="Three digits at back of your card" required>
                </div>
                <div class="span8">
                  <!-- screenshot may be here -->
                </div>
              </div>
            </div>
          </div>
       
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn">Cancel</button>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>

<script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>