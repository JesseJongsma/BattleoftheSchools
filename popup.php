<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">ID + Percentage competenties </button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

      	<div style="margin:20px" class="form-group">
      	  <label>Jou competenties:</label></br>
      	  <?php
      	  	echo "competentie 1 ";
      	  	echo "competentie 2 ";
      	  	echo "competentie 3 ";
      	  	echo "competentie 4 ";
      	  ?>
      	</div>

      	<div style="margin:20px" class="form-group">
      	  <label>Vul hier je motivatie in:</label>
      	  <textarea class="form-control" rows="10" id="comment"></textarea>
      	</div>

      </div>
      
    </div>
  </div>
  
</div>

</body>
</html>