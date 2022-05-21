<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="mt-5" method="post" action="user_check.php">
				<div class="row">
					<div class="col-12 text-center">
						<h3>Přihlášení</h3>
					</div>
				</div>
			  	<div class="row justify-content-md-center">
			  		<div class="col-6">
			  			<input name="name" type="text" class="form-control" placeholder="Name">	
			  		</div>
		    	</div>
	    		<div class="row mt-3 justify-content-md-center">
	    			<div class="col-6">
		      			<input name="heslo" type="password" class="form-control" placeholder="Heslo">
		      		</div>
		    	</div>
		    	<div class="row justify-content-md-center mb-5">
		    		<div class="col-6">
		    			<button class="btn btn-primary mt-3" type="submit">Přihlásit</button>	
		    		</div>
		    	</div>							
			</form>
		</div>
	</div>
</div>

<div id="insert-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="mt-5" method="post" action="action_insert.php">
				<div class="row">
					<div class="col-12 text-center">
						<h3>Přidat Nový</h3>
					</div>
				</div>
				<div class="row justify-content-md-center">
					<div class="col-6">
					  	<select class="form-control form-select-lg" aria-label="Default select example" name="category">
					  		<option value="" selected>Vyberte kategorii</option>
							<?php
								$data = $db->category_in_array();
								$print->category_Selection($data);
							?>
					  	</select>
					</div>
				</div>
				<div class="row justify-content-md-center mt-3">
					<div class="col-6">
						<input type="text" name="Name" class="form-control" placeholder="Název">
					</div>
				</div>
				<div class="row justify-content-md-center mt-3">
					<div class="col-6">
						<input type="text" name="URL" class="form-control" placeholder="URL">
					</div>
				</div>
				<div class="row justify-content-md-center mt-3">
					<div class="col-6">
						<input type="text" name="URL_IMG" class="form-control" placeholder="URL_IMG">
					</div>
				</div>
				<div class="row justify-content-md-center mt-3">
					<div class="col-6">
						<input type="text" name="URL_YTB" class="form-control" placeholder="URL_YTB">
					</div>
				</div>
				<div class="row justify-content-md-center mt-3">
					<div class="col-6">
						<textarea class="form-control" name="Desc" placeholder="Popis" rows="3"></textarea>
					</div>
				</div>
		    	<div class="row justify-content-md-center mb-5 mt-3">
		    		<div class="col-6">
		    			<button class="btn btn-primary mt-3" type="submit">Přidat</button>	
		    		</div>
		    	</div>							
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="max-width: 60%; height: 100%;">
    	<div class="modal-content">
     		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="myModalLabel"></h4>
      		</div>
      		<div class="modal-body">
        		<img src="" id="imagepreview" style="max-width: 100%; height: 100%;" >
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div>
    	</div>
	</div>
</div>