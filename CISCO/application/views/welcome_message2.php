<!DOCTYPE html>
<html>
<head>
	<title>Network Routers Properties</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">
</head>
<body>


<div class="container">


<div class="row">
  	<div class="col-lg-12 margin-tb">
  	  <div class="pull-left">
  	    <h2>Network Routers Properties</h2>
  	  </div>
  	  <div class="pull-right">
  	    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item"> Create Item</button>
  	  </div>
  	</div>
</div>

<form class="example" action="<?php echo base_url(); ?>">
  <input type="text" placeholder="Search.." name="search" id="search">
  <button  type="button" class="btn btn-success" onclick="manageData()">Search</button>
</form>



<table class="table table-bordered">


	<thead>
	    <tr>
		      <th>DNS</th>
		      <th>Hostname</th>
			  <th>Client IP</th>
			  <th>MAC Address</th>
		      <th width="200px">Action</th>
	    </tr>
	</thead>


	<tbody>
	</tbody>


</table>


<!-- <ul id="pagination" class="pagination-sm"></ul> -->


<!-- Create Item Modal -->
<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">


  <div class="modal-dialog" role="document">
    <div class="modal-content">


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Create Item</h4>
      </div>


      <div class="modal-body">


            <form data-toggle="validator" action="<?php echo base_url(); ?>/items/store" method="POST" id="insert">


                <div class="form-group">
                    <label class="control-label" for="title">DNS Record:</label>
                    <input type="text" name="dns" class="form-control" data-error="Please enter dns record." required />
                    <div class="help-block with-errors"></div>
                </div>


                <div class="form-group">
                    <label class="control-label" for="title">Hostname:</label>
                    <input type="text" name="hostname" class="form-control" data-error="Please enter hostname." required>
                    <div class="help-block with-errors"></div>
                </div>


				<div class="form-group">
                    <label class="control-label" for="title">Client Ip:</label>
                    <input type="text" name="client_ip" class="form-control" data-error="Please enter client ip." required />
                    <div class="help-block with-errors"></div>
                </div>


				
				<div class="form-group">
                    <label class="control-label" for="title">Mac Address:</label>
                    <input type="text" name="mac_address" class="form-control" data-error="Please enter mac address." required />
                    <div class="help-block with-errors"></div>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn crud-submit btn-success">Submit</button>
                </div>


            </form>


      </div>


    </div>
  </div>
</div>


<!-- Edit Item Modal -->
<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">


  <div class="modal-dialog" role="document">
    <div class="modal-content">


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
      </div>


      <div class="modal-body">


            <form data-toggle="validator" action="" method="put" id="update">


                <div class="form-group">
                    <label class="control-label" for="title">DNS Record:</label>
                    <input type="text" name="dns" class="form-control" data-error="Please enter title." required />
                    <div class="help-block with-errors"></div>
                </div>


                <div class="form-group">
                    <label class="control-label" for="title">Hostname:</label>
                    <input type="text" name="hostname" class="form-control" data-error="Please enter hostname." required>
                    <div class="help-block with-errors"></div>
                </div>

				<div class="form-group">
                    <label class="control-label" for="title">Client Ip:</label>
                    <input type="text" name="client_ip" class="form-control" data-error="Please enter client ip." required />
                    <div class="help-block with-errors"></div>
                </div>


				


                <div class="form-group">
                    <button type="submit" class="btn btn-success crud-submit-edit">Submit</button>
                </div>


            </form>


      </div>
    </div>
  </div>
</div>


</div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">



<script type="text/javascript">
	var url = "http://localhost/CRUD/items";
</script>


<script src="<?php echo base_url(); ?>/js/item-ajax.js"></script> 


</body>
</html>
