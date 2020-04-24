<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ajax</title>
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript" ></script> 
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript" ></script> 
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Detail</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="col-md-4">
                <form method="POST">
                    @csrf
                    <div class="form-group myid">
                        <label for="id">ID</label>
                        <input type="number" id="id" class="form-control" readonly="readonly" >
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="detail">Detail</label>
                        <input type="text" id="detail" class="form-control">
                    </div>
                    <button type="button" id="save" class="btn btn-primary" onClick="saveData()" >Submit</button>
                    <button type="button" id="update" class="btn btn-warning" onClick="updateData()" >Update</button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // $('#datatable').DataTable();
        $('#save').show();
        $('#update').hide();
        $('.myid').hide();
        
        $.ajaxSetup({
            header: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function viewData() {
            $.ajax({
                type: "GET",
                url: "/cruds",
                success: function(response){
                    var rows = "";
                    $.each(response, function(key, value){
                        rows = rows + "<tr>";
                        rows = rows + "<td>" + value.id + "</td>" ;
                        rows = rows + "<td>" + value.name + "</td>" ;
                        rows = rows + "<td>" + value.detail + "</td>" ;
                        rows = rows + "<td>";
                        rows = rows + "<button type='button' class='btn btn-primary' onClick='editData("+value.id+")'>Edit</button>";
                        rows = rows + "<button type='button' class='btn btn-warning' onClick='deleteData("+value.id+")'>Delete</button>";
                        rows = rows + "</td></tr>";
                    });
                    $('tbody').html(rows);
                }
            })
        }
        viewData();

        function saveData() {
            var name = $('#name').val();
            var detail = $('#detail').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {'name': name, 'detail': detail, _token: '{{csrf_token()}}'},
                url: '/cruds',
                success: function(response){
                    viewData();
                    clearData();
                    $('#save').show();
                }
            })
        }

        function clearData() {
            $('#id').val('');
            $('#name').val('');
            $('#detail').val('');
        }

        function editData(id, name, detail) {
            $('#save').hide();
            $('#update').show();
            $('.myid').show();
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: '/cruds/'+id+"/edit",
                success: function(response){
                    $('#id').val(response.id);
                    $('#name').val(response.name);
                    $('#detail').val(response.detail);
                }
            })
        }

        function updateData() {
            var id = $('#id').val();
            var name = $('#name').val();
            var detail = $('#detail').val();
            $.ajax({
                type: "PUT",
                dataType: 'json',
                data: {'name': name, 'detail': detail, _token: '{{csrf_token()}}'},
                url: '/cruds/'+id,
                success: function(response){
                    viewData();
                    clearData();
                    $('#save').show();
                    $('#update').hide();
                    $('.myid').hide();
                }
            })
        }
        
        function deleteData(id) {
            $.ajax({
                type: "DELETE",
                dataType: 'json',
                data: { _token: '{{csrf_token()}}'},
                url: '/cruds/'+id,
                success: function(response){
                    viewData();
                }
            })
        }
       
    </script>
</body>
</html>