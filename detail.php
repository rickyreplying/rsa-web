<?php
include_once("config.php");
global $id, $noRangka;
$id = $_GET['id'];
$noRangka = $_GET['noRangka'];
$result = mysqli_query($conn, "select nama, alamat, telepon, noPolisi, tglBeli, detail_servis.noRangka, tglServisTerakhir, tglServisSelanjutnya from pelanggan, mobil, detail_servis where pelanggan.id = $id and mobil.noRangka = '$noRangka' and mobil.noRangka = detail_servis.noRangka ORDER BY tglServisSelanjutnya ASC");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require 'header.php'; ?>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-4">
        <?php
        while ($user_data = mysqli_fetch_array($result)) {
            $nama = $user_data['nama'];
            $alamat = $user_data['alamat'];
            $telepon = $user_data['telepon'];
            $noPolisi = $user_data['noPolisi'];
            $tglBeli = $user_data['tglBeli'];
            $tglServisTerakhir = $user_data['tglServisTerakhir'];
            $tglServisSelanjutnya = $user_data['tglServisSelanjutnya'];

            // due date
            $diff = abs(strtotime($tglServisTerakhir) - strtotime($tglServisSelanjutnya));
            $years = floor($diff / (365 * 60 * 60 * 24));
            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
            //printf("%d years, %d months, %d days\n", $years, $months, $days);

            $date1 = date_create($tglServisTerakhir);
            $date2 = date_create($tglServisSelanjutnya);
            $diff = date_diff($date2, $date1);
            //echo $diff->format("%R%a days");
            //update pelanggan set nama  = 'Jehuda Siahaya', alamat = 'Jln. Yabansai, No 3 Perumnas 1 Waena' where id = 1
        }
        ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>

        <form action="" id="fupForm" name="form1" method="post">
            <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" value="<?php echo $nama ?>" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" value="<?php echo $alamat ?>" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telepon" value="<?php echo $telepon ?>" disabled>
                </div>
            </div>
            <input type="button" name="edit" class="btn btn-primary" value="Edit" id="edit">
            <input type="button" name="simpan" class="btn btn-primary" value="Simpan" id="simpan" disabled>
        </form>

        <h3 class="mt-4">Data Mobil</h3>
        <form class="form-floating mt-2">
            <input type="text" class="form-control" id="floatingInputValue" value="<?php echo $noPolisi ?>" disabled>
            <label for="floatingInputValue">No Polisi</label>
        </form>
        <form class="form-floating mt-2">
            <input type="text" class="form-control" id="floatingInputValue" value="<?php echo $noRangka ?>" disabled>
            <label for="floatingInputValue">No Rangka</label>
        </form>
        <form class="form-floating mt-2">
            <input type="text" class="form-control" id="floatingInputValue" value="<?php echo $tglBeli ?>" disabled>
            <label for="floatingInputValue">Tanggal Beli</label>
        </form>
        <form class="form-floating mt-2">
            <input type="text" class="form-control" id="floatingInputValue" value="<?php echo $tglServisTerakhir ?>" disabled>
            <label for="floatingInputValue">Servis Terakhir</label>
        </form>
        <form class="form-floating mt-2">
            <input type="text" class="form-control" id="floatingInputValue" value="<?php echo $tglServisSelanjutnya ?>" disabled>
            <label for="floatingInputValue">Servis Selanjutnya</label>
        </form>
        <form class="form-floating mt-2 mb-4">
            <input type="text" class="form-control" id="floatingInputValue" value="<?php echo $diff->format("%R%a hari ");
                                                                                    printf("(%d bulan, %d hari)", $months, $days); ?>" disabled>
            <label for="floatingInputValue">Due</label>
        </form>

        <!-- <h2> No Polisi: <?php echo $noPolisi ?></h2>
        <h2> No Rangka: <?php echo $noRangka ?></h2>
        <h2> Tanggal Beli: <?php echo $tglBeli ?></h2>
        <h2> Tanggal Servis Terakhir: <?php echo $tglServisTerakhir ?></h2>
        <h2> Tanggal Servis Selanjutnya: <?php echo $tglServisTerakhir ?></h2>
        <h2> Due Date: <?php echo $diff->format("%R%a days ");
                        printf("(%d months, %d days)", $months, $days); ?> </h2>

        <div class="card" style="width: 18rem;">
            <div class="card-header">
                Featured
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">No Polisi: <?php echo $noPolisi ?></li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Vestibulum at eros</li>
            </ul>
        </div> -->
    </div>
    <div id="wrap">
        <div id="main" class="container clear-top">
            <p style="text-align: center;"><i>Reminder Servis Application (RSA) - Version 1.0.0 Beta</i></p>
        </div>
    </div>
    <footer class="footer"></footer>
    <script>
        $(document).ready(function() {
            $('#edit').on('click', function() {
                $("#nama").removeAttr("disabled");
                $("#alamat").removeAttr("disabled");
                $("#telepon").removeAttr("disabled");
                $("#simpan").removeAttr("disabled");
            });
            $('#simpan').on('click', function() {
                $("#nama").attr("disabled", "disabled");
                $("#alamat").attr("disabled", "disabled");
                $("#telepon").attr("disabled", "disabled");
                $("#simpan").attr("disabled", "disabled");
                var nama = $('#nama').val();
                var alamat = $('#alamat').val();
                var telepon = $('#telepon').val();
                var id = '<?php echo $id ?>';
                //alert(sl);
                if (nama != "" && alamat != "" && telepon != "" && id != "") {
                    //alert(id);
                    //alert(nama);
                    //alert(telepon);
                    //alert(alamat);
                    $.ajax({
                        type: "POST",
                        url: "detail_edit_proses.php",
                        //dataType: 'json',
                        data: {
                            'nama': nama,
                            'alamat': alamat,
                            'telepon': telepon,
                            'id': id
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