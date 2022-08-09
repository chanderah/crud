<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Bill</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" />
</head>

<body>

    <div class="container">
        <h3>Dynamic Form Table</h3>
        <!-- <h4>Create Bill</h4> -->
        <div id="user_message"></div>
        <form id="form_insert_site" method="post" autocomplete="off" accept-charset="utf-8">
            <!-- <div class="form-group">
                <input type="text" id="txtName" name="txtName" placeholder="Customer Name" required="required" class="form-control" />
            </div> -->
            <table id="cart_table" class="table table-stripped table-hover">
                <tbody>
                    <tr>
                        <td colspan="12">
                            <?php if ($list_data) {
                                foreach ($list_data as $d) { ?>
                                    <div class="form-group">
                                        <label for="site_id" style="display:inline">SITE ID (Separate by Comma)</label>
                                        <input type="text" name="site_id" class="form-control" placeholder="Site ID" style="margin-top:10px" value="<?= $d->site_id ?>">
                                    </div>
                                <?php }
                            } else { ?>
                                <div class="form-group">
                                    <label for="site_id" style="display:inline">SITE ID (Separate by Comma)</label>
                                    <input type="text" name="site_id" class="form-control" placeholder="Site ID" style="margin-top:10px" value="">
                                </div>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12">
                            <div class="form-group">
                                <label>Insurance</label>
                                <select name="insurance" class="form-control">
                                    <option value="Malacca">Malacca</option>
                                    <option value="Maximus">Maximus</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12">
                            <div class="form-group">
                                <label for="itemInsured" style="display:inline;">Jenis Barang yang Dikirim</label>
                                <textarea class="form-control" style="margin-top:10px;" id="itemInsured" name="itemInsured" rows="3" placeholder="Jenis Barang"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <!-- for array -->
                    <tr>
                        <td>
                            <div class="form-group">
                                <label>Darat</label>
                                <select class="form-control" name="conveyance_by[]">
                                    <option value="">Choose...</option>
                                    <option value="Car">Car</option>
                                    <option value="Truck">Truck</option>
                                    <option value="Pick Up">Pick Up</option>
                                    <option value="Container">Container</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label>.</label>
                                <input type="text" name="conveyance_type[]" placeholder="Jenis Kendaraan" required="required" class="form-control" />
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label>.</label>
                                <input type="text" name="conveyance_policeno[]" placeholder="Plat Nomor" required="required" class="form-control" />
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label>.</label>
                                <input type="text" name="conveyance_driver[]" placeholder="Pengemudi" required="required" class="form-control" />
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                            </div>
                        </td>
                        <td>
                            <button id="addItem" name="addItem" type="button" class="btn btn-success btn-block btn-sm add_button"><i style="color:#fff" class="fa fa-plus-circle"></i></button>
                            <button id="removeItem" name="removeItem" type="button" class="btn btn-danger btn-block btn-sm remove_button"><i style="color:#fff;" class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label>Laut</label>
                                <input type="text" name="conveyance_ship_name[]" placeholder="Nama Kapal" required="required" class="form-control" />

                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label>.</label>
                                <input type="text" name="conveyance_ship_type[]" placeholder="Jenis Kapal" required="required" class="form-control" />
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label>.</label>
                                <input type="text" name="conveyance_ship_birth[]" placeholder="Tahun Pembuatan Kapal" required="required" class="form-control" />
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label>.</label>
                                <input type="text" name="conveyance_ship_GRT[]" placeholder="GRT Kapal" required="required" class="form-control" />
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label>.</label>
                                <input type="text" name="conveyance_ship_containerno[]" placeholder="Container No." required="required" class="form-control" />
                            </div>
                        </td>
                        <td>
                            <button id="addItem" name="addItem" type="button" class="btn btn-success btn-block btn-sm add_button"><i style="color:#fff" class="fa fa-plus-circle"></i></button>
                            <button id="removeItem" name="removeItem" type="button" class="btn btn-danger btn-block btn-sm remove_button"><i style="color:#fff;" class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label>Udara</label>
                                <select class="form-control" name="conveyance_plane_type[]">
                                    <option value="">Choose...</option>
                                    <option value="Cargo">Cargo</option>
                                    <option value="Penumpang">Penumpang</option>
                                    <option value="Helicopter">Helicopter</option>
                                    <option value="Charter">Charter</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label>.</label>
                                <input type="text" name="conveyance_plane_AWB[]" placeholder="No. AWB" required="required" class="form-control" />
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                            </div>
                        </td>
                        <td>
                            <button id="addItem" name="addItem" type="button" class="btn btn-success btn-block btn-sm add_button"><i style="color:#fff" class="fa fa-plus-circle"></i></button>
                            <button id="removeItem" name="removeItem" type="button" class="btn btn-danger btn-block btn-sm remove_button"><i style="color:#fff;" class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <div class="form-group">
                                <label>Tanggal Keberangkatan</label>
                                <input type="date" placeholder="Sailing Date" name="sailing_date[]" required="required" class="form-control" />
                            </div>
                        </td>
                        <td>
                            <button id="addItem" name="addItem" type="button" class="btn btn-success btn-block btn-sm add_button"><i style="color:#fff" class="fa fa-plus-circle"></i></button>
                            <button id="removeItem" name="removeItem" type="button" class="btn btn-danger btn-block btn-sm remove_button"><i style="color:#fff;" class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="form-group">
                                <label for="destination_from">Tempat Keberangkatan</label>
                                <textarea class="form-control" id="destination_from" name="destination_from" placeholder="From" rows="4"></textarea>
                            </div>
                        </td>
                        <td colspan="3">
                            <div class="form-group">
                                <label for="destination_to">Tujuan Akhir</label>
                                <textarea class="form-control" id="destination_to" name="destination_to" placeholder="To" rows="4"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12">
                            <div class="form-group">
                                <label for="amount_insured">Nilai Barang yang Diangkut</label>
                                <select class="form-control" id="currency" name="currency" style="margin-bottom:5px;width:fit-content">
                                    <option value="IDR">IDR</option>
                                </select>
                                <input type="number" name="amount_insured" placeholder="Nilai Barang" required="required" class="form-control" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12">
                            <div class="form-group">
                                <label for="issuedDate">Tanggal Penerbitan</label>
                                <input type="date" value="<?php echo date("Y-m-d") ?>" name="issuedDate" required="required" class="form-control" />
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="12" class="text-right">
                            <input type="submit" id="btnSave" name="btnSave" value="Create" class="btn btn-md btn-success" />
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>

    <script src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
        var i = 1,
            max = 50;
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
                    if (max > i) {
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
        $('#form_insert_site').submit(function(e) {
            e.preventDefault();
            var data = $("#form_insert_site").serialize();
            var url2 = '<?php echo base_url("admin/tabel_barangmasuk"); ?>';
            $.ajax({
                type: "POST",
                url: '<?php echo base_url("admin/input_datamasuk"); ?>',
                data: data,
                success: function(data) {
                    $(":text").val('');
                    // location.href = url2;
                    window.open(url2, "_blank");
                    // $("#user_message").html(data);
                },
            });
        });
        //end 
    </script>

</body>

</html>