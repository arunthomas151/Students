<!DOCTYPE html>
<html>
    <head>
        <title>Add Student Mark</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="/css/admin.css" rel="stylesheet" />
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    </head>
    <body>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('dashboard') }}">Dashboard</a> |
                <a href="{{ route('studentlist') }}">Students List</a> |
                <a href="{{ route('marklist') }}">Mark List</a> |
            </div>
            <div class="card-body custom-container">
                <form class="addform" id="addform" enctype="multipart/form-data">
                <h2>Student Marks Details</h2>

                    <div class="form-group">
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

                <button type="button" id="save" class="btn btn-primary">Save</button>
                <a href="{{route('marklist')}}"><button type="button" id="save" class="btn btn-danger">Cancel</button></a>

                </form>
            </div>
        </div>
    </body>
</html>
<script>
      toastr.options = {
          "closeButton": true,
          "newestOnTop": true,
          "positionClass": "toast-top-right"
        };
    $('#save').on('click', function() {
        var formData = new FormData($('#addform')[0]);
        formData.append("_token", '{{csrf_token()}}');
        $.ajax({
            type: "post",
            url: "{{ route('add_studentmark') }}",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.status == 201) {
                    toastr.success(res.message);
                    document.getElementById("addform").reset();
                } else {
                    toastr.error(res.message);
                }
            }
        });
    });
</script>