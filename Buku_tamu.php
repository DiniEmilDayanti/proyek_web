<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu CRUD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/poppers.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdb.bootstrapcdn.com/bootstrap/4.5.2/js/bootsrap.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2>Buku Tamu</h2>
    <!--form for create/update-->
    <form id="guestForm" class="mb-4">
        <div class="form-group">
            <label for="guestKode">Kode:</label>
            <input type="text" class="form-control" id="guestKode" required>
        </div>
        <div class="form-group">
            <label for="guestNama">Nama:</label>
            <input type="text" class="form-control" id="guestNama" required>
        </div>
        <div class="form-group">
            <label for="guestEmail">Email:</label>
            <input type="text" class="form-control" id="guestEmail" required>
        </div>
        <div class="form-group">
            <label for="guestPesan">guestPesan:</label>
            <input type="text" class="form-control" id="guestPesan" required>
        </div>
        <button type="submit" class="btn btn-primary" id="submitBtn">Add Guest</button>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>KODE</th>
                <th>NAMA</th>
                <th>EMAIL</th>
                <th>PESAN</th>
                <!--<th>Action</th>-->
            </tr>
        </thead>
        <tbody id="guestTableBody">
            <!--Guest rows will be appended here-->
        </tbody>
    </table>
</div>

<script>

    $(document).ready(function(){
        const script_url ='https://script.google.com/u/0/home/projects/1VPTxnazXv9wbWlXXy9Y19AntDEWpDv-5cZe7lynMkBJYq6YnXlGsuRoP/edit';
     loadGuests();
     // Handle form submit untuk membuat atau memperbarui data
    $('#guestForm').on('submit', function(event) {
    event.preventDefault();

    const kode = $('#guestKode').val();
    const nama = $('#guestNama').val();
    const email = $('#guestEmail').val();
    const pesan = $('#guestPesan').val();

    $.ajax({
        url: 'script-url',
        type: 'GET',
        dataType: 'jsonp',
        data: {
            kode: kode,
            nama: nama,
            email: email,
            pesan: pesan,
            action: 'insert'
        },
        success: function(response) {
            alert(response.result);
            loadGuests();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Request failed:', textStatus, errorThrown);
        }
    });
});


     function loadGuests(){
        $.ajax({
            url: script_url,
            type: "GET",
            data: {action: "read"},
            dataType: "json",
            success: function(reponse) {
                const tbody= $('#guestTableBody');
                tbody.empty();

                response.forEach(guest => {
                    tbody.append(`
                    <tr>
                        <td>${guest.KODE}</td>
                        <td>${guest.NAMA}</td>
                        <td>${guest.EMAIL}</td>
                        <td>${guest.PESAN}</td>
                    </tr>
                    `);
                });
        },
        error:function(jqXHR, textStatus, errorThrown){
            console.error("Request failed:", textStatus, errorThrown);
        }
     });
     }
    });
    
</script>
</body>
</html>