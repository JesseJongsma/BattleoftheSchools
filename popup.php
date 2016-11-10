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
