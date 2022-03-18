<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dynamic</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h4>Dynamic</h4><br>
  <form class="form-horizontal" action="<?=base_url('add_remove/store')?>" role="form" method="post">
    <div id="dynamic_field">
    <div class="form-group">
      <label class="control-label col-sm-2" for="dummy_id">Name:</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="dummy_id" placeholder="Enter Name" name="dummy_id" autocomplete="off">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="site_id">Email:</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="site_id" placeholder="Enter email" name="site_id" autocomplete="off">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="region">Mobile Number:</label>
      <div class="col-sm-5">          
        <input type="text" class="form-control" id="region" placeholder="Enter Mobile Number" name="region" autocomplete="off">
      </div>
    </div>
    </div>  
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
      </div>
    </div>
     <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" /> 
  </form>
</div>
</body>

<script type="text/javascript">
    $(document).ready(function(){      
      var i=1;  
   
      $('#add').click(function(){  
           i++;             
           $('#dynamic_field').append('<div id="row'+i+'"><div class="form-group"><label class="control-label col-sm-2" for="name">Name:</label><div class="col-sm-5"><input type="text" class="form-control"  placeholder="Enter Name" name="name[]" autocomplete="off"></div></div><div class="form-group"><label class="control-label col-sm-2" for="email">Email:</label><div class="col-sm-5"><input type="email" class="form-control" id="email" placeholder="Enter email" name="email[]" autocomplete="off"></div></div><div class="form-group"><label class="control-label col-sm-2" for="mobno">Mobile Number:</label><div class="col-sm-5"><input type="number" class="form-control" id="mobno" placeholder="Enter Mobile Number" name="mobno[]" autocomplete="off"></div><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div></div>');
     });
     
     $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id"); 
           var res = confirm('Are You Sure You Want To Delete This?');
           if(res==true){
           $('#row'+button_id+'').remove();  
           $('#'+button_id+'').remove();  
           }
      });  
  
    });  
</script>
</html>