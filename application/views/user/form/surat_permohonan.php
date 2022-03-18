<br><br><br>

    <div class="container text-center" style="margin: 2em auto;">

    <h2 class="tex-center">Surat Permohonan</h2>



  </div>



   <!-- Content Wrapper. Contains page content -->

   <div class="content-wrapper">

    <!-- Content Header (Page header) -->



    <!-- Main content -->

    <section class="content">

      <div class="row">

        <!-- left column -->

        <div class="col-md-12">

          <div class="container">

            <!-- general form elements -->

          <div class="box box-primary" style="width:94%;">

            <!-- /.box-header -->

            <!-- form start -->

            

            <div class="container">

              <form id="form_insert_site" method="post" autocomplete="off" accept-charset="utf-8"style="width:95%;margin-left:10px">   

                <div class="form-group" style="display:inline-block; margin-left:75px">

                  <button type="reset" class="btn btn-basic" name="btn_reset" style="width:95px;margin-left:-70px;"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>

                </div>



                <div class="form-group form-group-lg col-md-12">

                  <label for="the_insured">1. Nama Tertanggung</label>

                    <select name="the_insured" class="form-control">

                      <option selected>Choose...</option>

                      <option value="PT. FiberHome Technologies Indonesia and/or BAKTI (Badan Aksesibilitas Telekomunikasi dan Informasi)">PT. FiberHome Technologies Indonesia and/or BAKTI (Badan Aksesibilitas Telekomunikasi dan Informasi)</option>

                      <option value="Lainnya">Lainnya</option>

                    </select>

                </div>

               

                <div class="form-group form-group-lg col-md-12">

                  <label for="address_">2. Alamat</label>

                    <select class="form-control" name="address_">

                      <option selected>Choose...</option>

                      <option value="APL Tower, 30 Floor, Grogol, West Jakarta">APL Tower, 30 Floor, Grogol, West Jakarta</option>

                      <option value="Lainnya">Lainnya</option>

                    </select>

                </div>



                <table id="cart_table" class="table table-sm table-stripped table-hover" style="margin-left:7px;width:99%">

                    <thead>

                        <tr>

                            <th width="80%">3. Jenis Barang yang Dikirim</th>

                            <th width="20%">Quantity</th>

                            <th width="5%"></th>

                        </tr>

                        <tr>

                        </tr> 

                    </thead>

                    <tbody>

                        <tr>

                            <td>

                                <div class="form-group form-group-lg">

                                    <input type="text" name="txtTitle[]" placeholder="Jenis Barang" required="required" class="form-control"/>

                                </div>

                            </td> 

                            <td>

                                <div class="form-group form-group-lg">

                                    <input type="number" name="txtDescription[]" class="form-control" placeholder="@ pcs" required="required"/>

                                </div>

                            </td>

                            

                            <td>

                                <button id="addItem" name="addItem" type="button" class="btn btn-success btn-block btn-sm add_button"><i style="color:#fff" class="fa fa-plus-circle"></i></button>

                                <button id="removeItem" name="removeItem" type="button" class="btn btn-danger btn-block btn-sm remove_button"><i style="color:#fff;" class="fa fa-trash-o"></i></button>

                            </td>

                        </tr>

                    </tbody>

                </table>



                <div class="form-group form-group-lg col-md-12"style="margin-top:-25px">

                  <label for="conveyance">4. Pengiriman Melalui</label>

                    <select class="form-control" id="conveyance" name="conveyance">

                      <option value="none">Choose...</option>

                      <option value="Darat">Darat</option>

                      <option value="Laut">Laut</option>

                      <option value="Udara">Udara</option>

                    </select>

                </div>



                <div class="conveyance_select" id="Darat">

                  <div class="form-group form-group-lg col-md-3">

                    <label for="conveyance_type">Jenis Alat Angkut</label>

                      <select class="form-control" id="conveyance_type" name="conveyance_type">

                        <option value="Car">Car</option>

                        <option value="Truck">Truck</option>

                        <option value="Pick Up">Pick Up</option>

                        <option value="Container">Container</option>

                        <option value="Lainnya">Lainnya</option>

                    </select>

                  </div>

                  <div class="form-group form-group-lg col-md-3">

                    <label for="conveyance_policeno">Plat Nomor</label>

                    <input type="text" class="form-control" name="conveyance_policeno" placeholder="Plat Nomor">

                  </div>

                  <div class="form-group form-group-lg col-md-3">

                    <label for="conveyance_age">Usia Kendaraan</label>

                    <input type="number" class="form-control" name="conveyance_age" placeholder="Usia Kendaraan">

                  </div>

                  <div class="form-group form-group-lg col-md-3">

                    <label for="conveyance_driver">No. SIM / Registrasi Pengemudi</label>

                    <input type="text" class="form-control" name="conveyance_driver" placeholder="No. SIM / Registrasi Pengemudi">

                  </div>

                </div>



                <div class="conveyance_select" id="Laut">

                  <div class="form-group form-group-lg col-md-3">

                    <label for="conveyance_ship_name">Nama Kapal</label>

                    <input type="text" class="form-control" name="conveyance_ship_name" placeholder="Nama Kapal">

                  </div>

                  <div class="form-group form-group-lg col-md-3">

                    <label for="conveyance_ship_type">Jenis Kapal</label>

                    <input type="text" class="form-control" name="conveyance_ship_type" placeholder="Jenis Kapal">

                  </div>

                  <div class="form-group form-group-lg col-md-3">

                    <label for="conveyance_ship_age">Usia Kapal</label>

                    <input type="number" class="form-control" name="conveyance_ship_age" placeholder="Usia Kapal">

                  </div>

                  <div class="form-group form-group-lg col-md-3">

                    <label for="conveyance_ship_GRT">GRT Kapal</label>

                    <input type="text" class="form-control" name="conveyance_ship_GRT" placeholder="GRT Kapal">

                  </div>

                </div>



                <div class="conveyance_select" id="Udara">

                  <div class="form-group form-group-lg col-md-6">

                    <label for="conveyance_plane_type">Jenis Pesawat</label>

                      <select class="form-control" id="conveyance_plane_type" name="conveyance_plane_type">

                      <option value="Car">Cargo</option>

                      <option value="Truck">Penumpang</option>

                      <option value="Pick Up">Helicopter</option>

                      <option value="Container">Charter</option>

                    </select>

                  </div>

                  <div class="form-group form-group-lg col-md-6">

                    <label for="conveyance_plane_AWB">No. AWB</label>

                    <input type="text" class="form-control" name="conveyance_plane_AWB" placeholder="No. AWB">

                  </div>

                </div>



                <div class="form-group form-group-lg col-md-6">

                  <label for="destination_from">5. Tempat Keberangkatan</label>

                  <input type="text" name="destination_from" class="form-control" placeholder="Dari">

                </div>

                <div class="form-group form-group-lg col-md-6">

                  <label for="destination_to">Tujuan Akhir</label>

                  <input type="text" class="form-control" name="destination_to" placeholder="Ke">

                </div>



                <div class="form-group form-group-lg col-md-12">

                  <label for="sailing_date">6. Tanggal Keberangkatan</label>

                  <input type="date" placeholder="Tanggal Keberangkatan" name="sailing_date" required="required" class="form-control"/>

                </div>



                <div class="form-group form-group-lg col-md-12">

                  <label for="amount_insured">7. Nilai Barang yang Diangkut</label>

                  <input type="number" name="amount_insured" placeholder="Nilai Barang" required="required" class="form-control"/>

                </div>



                <div class="form-group form-group-lg col-md-12">

                  <label for="lampiran">8. Lampiran Data Pendukung</label>

                </div>

                <div class="form-group form-group-lg col-md-4">

                  <label for="lampiran_BL">Bill of Lading (B/L)</label>

                  <input type="text" class="form-control" name="lampiran_BL" placeholder="B/L">

                </div>

                <div class="form-group form-group-lg col-md-4">

                  <label for="lampiran_LC">Letter of Credit (L/C) *</label>

                  <input type="text" class="form-control" name="lampiran_LC" placeholder="L/C">

                </div>

                <div class="form-group form-group-lg col-md-4">

                  <label for="lampiran_invoice">Invoice</label>

                  <input type="text" class="form-control" name="lampiran_invoice" placeholder="Invoice">

                </div>

                <div class="form-group form-group-lg col-md-6">

                  <label for="lampiran_PL">Packing List</label>

                  <input type="text" class="form-control" name="lampiran_PL" placeholder="Packing List">

                </div>

                <div class="form-group form-group-lg col-md-6">

                  <label for="lampiran_DO">Delivery Order (DO)</label>

                  <input type="text" class="form-control" name="lampiran_DO" placeholder="DO">

                </div>          

                

                <div class="box-footer col-md-12" style="width:100%; margin-left:30px; margin-bottom:10px; margin-top:5px">

                  <a type="button" class="btn btn-default" style="width:10%;margin-right:26%" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>

                  <a type="button" class="btn btn-info" style="width:18%;margin-right:20%" href="<?=base_url('admin/tabel_barangmasuk')?>" name="btn_listbarang">

                  <i class="fa fa-table" aria-hidden="true"></i> Lihat List Permintaan</a>

                  <button type="submit" input type="submit" style="width:20%" id="btnSave" class="btn btn-md btn-success"><i class="fa fa-check" aria-hidden="true"></i>Create</button>

                </div>

                <div id="user_message" style="display:inline-block"></div>

              </form>

            </div>

          </div>

          <!-- /.box -->



          <!-- Form Element sizes -->



          <!-- /.box -->





          <!-- /.box -->



          <!-- Input addon -->



          <!-- /.box -->



        </div>

        <!--/.col (left) -->

        <!-- right column -->

        <!-- <div class="col-md-6">

          <!-- Horizontal Form -->



          <!-- /.box -->

          <!-- general form elements disabled -->



          <!-- /.box -->



        </div>

        </div>

        <!--/.col (right) -->

      </div>

      <!-- /.row -->

    </section>

    <!-- /.content -->

  </div>



  <!-- jQuery 3 -->

  <script src="<?php echo base_url()?>assets/web_admin/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->

  <script src="<?php echo base_url()?>assets/web_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->

  <script src="<?php echo base_url()?>assets/web_admin/bower_components/fastclick/lib/fastclick.js"></script>

  <!-- AdminLTE App -->

  <script src="<?php echo base_url()?>assets/web_admin/dist/js/adminlte.min.js"></script>

  <script src="<?php echo base_url()?>assets/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

  <!-- AdminLTE for demo purposes -->

  <script src="<?php echo base_url()?>assets/web_admin/dist/js/demo.js"></script>



  <script type="text/javascript">

      $(".form_datetime").datetimepicker({

        format: 'dd/mm/yyyy',

        autoclose: true,

        todayBtn: true,

        pickTime: false,

        minView: 2,

        maxView: 4,

      });

  </script>



<script src="<?php echo base_url("assets/js/jquery.min.js");?>"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>



    <script type="text/javascript">

        var i = 1, max = 50;

        var cartTable = {

            options: {

                table: "#cart_table"

            },

            initialize: function() {

                this.setVars().events();

            },

            setVars: function() {

                this.$table = $(this.options.table);

                this.$totalLines = $(this.options.table).find('tr').length - 1;

                return this;

            },

            updateLines: function() {

                var totalLines = $(this.options.table).find('tr').length - 1;

                if (totalLines == 1) {

                    $('.add_button').show();

                    $('.remove_button').hide();

                }

                return this;

            },

            events: function() {

                var _self = this;

                _self.updateLines();

                this.$table.on('click', 'button.add_button', function(e) {

                    e.preventDefault();

                    if(max > i) {

                        var $tr = $(this).closest('tr');

                        var $clone = $tr.clone();

                        $clone.find(':text').val('');

                        $tr.after($clone);

                        if (_self.setVars().$totalLines > 1) {

                            $('.remove_button').show();

                            $('.add_button').show();

                        }

                        i++;

                    }

                }).on('click', 'button.remove_button', function(e) {

                    if (i > 1) {

                        e.preventDefault();

                        var $tr = $(this).closest('tr');

                        $tr.remove();

                        //if have delete last button with button add visible, add another button to last tr

                        if (_self.setVars().$totalLines > 1) {

                            _self.$table.find('tr:last').find('.add').show();

                        }

                        i--;

                    }

                });



                return this;

            }

        };



        function initializeCartTable() {

            cartTable.initialize();

        }

        window.addEventListener('load', initializeCartTable, false);

    </script>



    <script>

        var display_bill_table = "";

        $(document).ready(function() {



            $('#form_insert_site').submit(function(e) {

                e.preventDefault();

                var data = $("#form_insert_site").serialize();

                $.ajax({

                    type:"POST",

                    url:'<?php echo base_url("main/input_suratpermohonan"); ?>',

                    data: data,

                    success: function(data) {

                        $("#user_message").html(data);

                        $(":text").val('');

                        display_bill_table.ajax.reload();

                    },

                });

            });

            //end

        });



    </script>

    

    <script>

      $(document).ready(function(){

      $('.conveyance_select').hide();

      $('#conveyance').change(function(){

      $('.conveyance_select').hide();

      $('#' + $(this).val()).show();

    });

  });

  </script>