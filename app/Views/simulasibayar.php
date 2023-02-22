<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>simulasibayar</title>
</head>
<body>
    <input type="text" id="idexternal" placeholder="id external" required>
    <input type="number" id="jumlahbayar" placeholder="jumlah bayar" required>
    <button onclick="bayar()">Bayar</button>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <script>

        function bayar() {
            var id = $('#idexternal').val();
            var biaya= $('#jumlahbayar').val();
            $.ajax({
                type: "POST",
                data: {external:id,total:biaya},
                url: "<?= base_url().'/simulasibayar/kirim'?>",
                success: function (response) {
                    document.write(response);
                },
                error: function (xhr,ajaxOptions,thrownError) {
                alert(xhr.status + "\n"+ xhr.responseText + "\n"+thrownError);
                }
            });
        }
    </script>
</body>
</html>