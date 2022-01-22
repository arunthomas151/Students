<!DOCTYPE html>
<html>
<head>
    <title>Add New Student</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="/css/admin.css" rel="stylesheet" />
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<div class="card">
</head>
<body>
<div class="card-header">
    <a href="{{ route('dashboard') }}">Dashboard</a> |
    <a href="{{ route('studentlist') }}">Students List</a> |
    <a href="{{ route('marklist') }}">Mark List</a> |
</div>
<div class="card-body custom-container">
<form class="addform" id="addform" enctype="multipart/form-data">
<h2>Student Details</h2>
  <div class="form-group">

    <label>Student Name</label>
    <input type="text" required class="form-control" id="student_name" name="student_name">
  </div>
  <div class="form-group">
    <label>Student Age</label>
    <input type="text" required class="form-control" id="age" name="age">
  </div>
  <div class="form-group">
    <label>Student Gender</label>
    <select type="text"  required class="form-control" id="gender" name="gender">
        <option value="" selected disabled>Select One</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>
  </div>
  <div class="form-group">
    <label>Reporting Teacher</label>
    <select type="text" required class="form-control" id="teacher_id" name="teacher_id">
        <option value="" selected disabled>Select One</option>
        @foreach($teachers as $teacher)
            <option value="{{ $teacher->teacher_id }}">{{ $teacher->teacher_name }}</option>
        @endforeach
    </select>
  </div>

  <button type="button" id="save" class="btn btn-primary">Save</button>
  <a href="{{route('studentlist')}}"><button type="button" id="save" class="btn btn-danger">Cancel</button></a>

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
            url: "{{ route('add_student') }}",
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