<?php
include_once("config.php");
global $id, $noRangka;
$id = $_GET['id'];
$noRangka = $_GET['noRangka'];
$result = mysqli_query($conn, "select nama, alamat, telepon, noPolisi, tglBeli, detail_servis.noRangka, tglServisTerakhir, tglServisSelanjutnya from pelanggan, mobil, detail_servis where pelanggan.id = $id and mobil.noRangka = '$noRangka' and mobil.noRangka = detail_servis.noRangka ORDER BY tglServisSelanjutnya ASC");
// update detail_servis set detail_servis.tglServisTerakhir = '2020-12-28', detail_servis.tglServisSelanjutnya = '2021-02-12' where detail_servis.noRangka = '214253MH6975D'
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Tanggal</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require 'header.php'; ?>
</head>

<body>
    <?php
    while ($user_data = mysqli_fetch_array($result)) {
        $nama = $user_data['nama'];
        $alamat = $user_data['alamat'];
        $telepon = $user_data['telepon'];
        $noPolisi = $user_data['noPolisi'];
        $tglBeli = $user_data['tglBeli'];
        $tglServisTerakhir = date("d-m-Y", strtotime($user_data['tglServisTerakhir']));
        $tglServisSelanjutnya = date("d-m-Y", strtotime($user_data['tglServisSelanjutnya']));
    }
    ?>

    <form id="fupForm" name="form1" method="post">
        <label for="fname">Servis terakhir: (<?php echo  $tglServisTerakhir;  ?>)</label><br>
        <input type="date" id="st" name="st"><br>
        <label for="lname">Servis selanjutnya: (<?php echo  $tglServisSelanjutnya;  ?>)</label><br>
        <input type="date" id="sl" name="sl"><br><br>
        <input type="hidden" id="nr" name="nr" value=" <?php echo $noRangka; ?> ">
        <input type="button" name="save" class="btn btn-primary" value="Simpan" id="butsave">
    </form>

    <p><a href="index.php">HOME</a></p>


    <script>
        $(document).ready(function() {
            $('#butsave').on('click', function() {
                $("#butsave").attr("disabled", "disabled");
                var st = $('#st').val();
                var sl = $('#sl').val();
                var nr = "<?php echo $noRangka; ?>";
                //alert(sl);
                if (st != "" && sl != "" && nr != "") {
                    //alert($('#nr').val());
                    $.ajax({
                        type: "POST",
                        url: "edit_proses.php",
                        //dataType: 'json',
                        data: {
                            'st': st,
                            'sl': sl,
                            'nr': nr,
                        },
                        cache: false,
                        success: function(dataResult) {
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.statusCode == 200) {
                                $("#butsave").removeAttr("disabled");
                                //$('#fupForm').find('input:text').val('');
                                //$("#success").show();
                                //$('#success').html('Data added successfully !');
                                alert("Success!");
                                location.reload();
                            } else if (dataResult.statusCode == 201) {
                                alert("Error occured !");
                            }

                        }
                    });
                } else {
                    alert('Please fill all the field !');
                    //$("#butsave").removeAttr("disabled");
                }
            });
        });
    </script>
</body>

</html>