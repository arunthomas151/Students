<!DOCTYPE html>
<html>
<head>
    <title>Students Mark List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body>
<div class="card-header">
    <a href="{{ route('dashboard') }}">Dashboard</a> |
    <a href="{{ route('studentlist') }}">Students List</a> |
    <a href="{{ route('marklist') }}">Mark List</a> |
</div>
<div class="container mt-5">
    <h2 class="mb-4">Students Mark List</h2>
    <a href="{{route('newstudentmark')}}"><button class="btn btn-success">Add Student Mark</button></a>
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Maths</th>
                <th>Science</th>
                <th>History</th>
                <th>Term</th>
                <th>Total Marks</th>
                <th>Created On</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script type="text/javascript">

  $(function () {
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ajaxmarklist') }}",
        columns: [
            {data: 'marklist_id', name: 'marklist_id'},
            {data: 'student_name', name: 'student_name'},
            {data: 'maths', name: 'maths'},
            {data: 'science', name: 'science'},
            {data: 'history', name: 'history'},
            {data: 'term', name: 'term'},
            {data: 'totalmark', name: 'totalmark'},
            {data: 'created_at', name: 'created_at'},
            {
                "targets": -1,
                "data": "marklist_id",
                "className": "center",
                "render": function(data, type, row, meta) {
                    return '<button name="marklist_id" id=' + data + ' value="Edit" class="btn btn-secondary update_record" style="margin:10%">Edit</button><button id=' + data + ' value="Delete" class="btn btn-danger delete_record" style="margin:10%">Delete</button>'
                }
            }
        ]
    });
    
  });


  $(document).on('click', '.delete_record', function() {
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right"
        };
        $.ajax({
            type: "post",
            url: "{{ route('studentmark_delete') }}",
            data: {
                'marklist_id': this.id,
                _token: '{{csrf_token()}}'
            },
            success: function(res) {
                if (res.status == 201) {
                    $('.yajra-datatable').DataTable().ajax.reload();
                    toastr.success(res.message);
                } else {
                    toastr.error(res.message);
                }
            }
        });
    });

    $(document).on('click', '.update_record', function() {
        $.ajax({
            type: "post",
            url: "{{ route('studentmark_details') }}",
            data: {
                'marklist_id': this.id,
                _token: '{{csrf_token()}}'
            },
            success: function(res) {
                $('#marklist_id').val(res.marklist_id);
                $('#student_name').val(res.student_id);
                $('#term').val(res.term);
                $('#maths').val(res.maths);
                $('#science').val(res.science);
                $('#history').val(res.history);
                $('#studentmarkupdatemodal').modal('show');
            }
        });
    });

    $(document).on('click', '.update_mark', function() {
        var formData = new FormData($('#updateform')[0]);
        formData.append("_token", '{{csrf_token()}}');
        $.ajax({
            type: "post",
            url: "{{ route('studentmark_update') }}",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.status == 201) {
                    toastr.success(res.message);
                    $('.yajra-datatable').DataTable().ajax.reload();
                    $('#studentmarkupdatemodal').modal('hide');
                    document.getElementById("updateform").reset();
                } else {
                    toastr.error(res.message);
                }
            }
        });
    });
</script>
</html>

<!-- Modal -->
<div class="modal fade" id="studentmarkupdatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="studentmarkupdatemodal">Update Student Mark</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="updateform" id="updateform" enctype="multipart/form-data">

            <div class="form-group">
                <input type="hidden" name="marklist_id" id="marklist_id">
                <label>Student Name</label>
                <select type="text" required class="form-control" id="student_name" name="student_name">
                    <option value="" selected disabled>Select One</option>
                    @foreach($students as $student)
                        <option value="{{ $student->student_id }}">{{ $student->student_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Term</label>
                <select type="text"  required class="form-control" id="term" name="term">
                    <option value="" selected disabled>Select One</option>
                    <option value="One">One</option>
                    <option value="Two">Two</option>
                </select>
            </div>
        <div class="form-group">
            <h4>Subject </h4>
            <label>Maths </label>
            <input type="text" required class="form-control" id="maths" name="maths">
        </div>
        <div class="form-group">
            <label>Science</label>
            <input type="text" required class="form-control" id="science" name="science">
        </div>
        <div class="form-group">
            <label>History</label>
            <input type="text" required class="form-control" id="history" name="history">
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary update_mark">Save changes</button>
        </div>
    
        </form>
    </div>
  </div>
</div>