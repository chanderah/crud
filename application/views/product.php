<!DOCTYPE html>
<html lang="en">

<head>
  <title>Product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

  <div class="container"> 
    <h2>Import Data Site ID</h2>

    <!-- <a href="<?php echo base_url() . "index.php/product/import" ?>">Import</a> -->

              <div class="tab-pane" id="excel">
                <form class="form-horizontal" action="<?=base_url('admin/proses_excel_upload')?>" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Upload .xlsx File</label>

                    <div class="col-sm-10">
                      <input type="file" name="xlsx_file" class="form-control" id="username">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success"><i class="fa fa-send" aria-hidden="true"></i>&nbsp;Submit</button>
                    </div>
                  </div>
                </form>
              </div>

    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Title</th>
          <th>Price</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;
        foreach ($product as $value) { ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $value["title"]; ?></td>
            <td><?php echo $value["price"]; ?></td>
            <td><?php echo $value["description"]; ?></td>
          </tr>
        <?php $i++;
        } ?>

      </tbody>
    </table>
  </div>

</body>

</html>