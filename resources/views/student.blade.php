<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Single Page Application</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
  <div class="container mt-3">
    <h3>Modal Example</h3>
    <p id="respanel">Click on the button to open the modal.</p>
    
    <button type="button" class="btn btn-primary newModal" data-bs-toggle="modal" data-bs-target="#myModal">
      Open modal
    </button>
  </div>

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Employee</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="container mt-3">
            <form id="submitForm">

              <div class="mb-3 mt-3">
                <input type="hidden" name="id" id="id">
                <label for="first_name">first_Name:</label>
                <input type="first_name" class="form-control" id="first_name" placeholder="Enter first name" name="first_name">
              </div>
              <div class="mb-3 mt-3">
                <input type="hidden" name="id" id="id">
                <label for="last_name">last_name:</label>
                <input type="last_name" class="form-control" id="last_name" placeholder="Enter last_name" name="last_name">
              </div>
              <div class="mb-3 mt-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
              </div>
              <div class="mb-3">
                <label for="gender">gender:</label>
                <input type="gender" class="form-control" id="gender" placeholder="Enter gender" name="Gender">
              </div>
              <div class="form-check mb-3">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="remember"> Remember me
                </label>
              </div>
              <button type="submit" class="btn btn-success">Submit</button>
            </form>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
  <div class="container">
    <div class="row justify-content-center mt-5">

      <table class="table table-striped table-hover table-bordered   ">
        <thead class="table-success">
          <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">gender</th>
            <th colspan="2" align="center">Action</th>

          </tr>
        </thead>
        <tbody id="student_data">

        </tbody>
      </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
      $(document).ready(function() {
        $(".newModal").on('click', function() {
          $('#submitForm')[0].reset();
          $("#id").val('');

        });
        $('#submitForm').on('submit', function(e) {
          e.preventDefault();

          var data = $('#submitForm').serialize();

          $.ajax({
            url: "{{route('createStudent')}}",
            method: 'POST',
            data: {
              "_token": "{{csrf_token()}}",
              data: data,
            },
            success: function(response) {
              $("#respanel").html(response);
              $("#submitForm")[0].reset();
              $("#myModal").modal('hide');
              fetchrecords();

            }
          })
        });
        $(document).on('click', '.btn-warning', function(e) {
          e.preventDefault();
          var id = $(this).val();
          $.ajax({
            url: "{{ route('editStudent') }}",
            type: "post",
            data: {
              "_token": "{{ csrf_token() }}",
              "id": id,
            },
            success: function(response) {
              $("#submitForm")[0].reset();
              $("#id").val(response.id);
              $("#first_name").val(response.first_name);
              $("#last_name").val(response.last_name);
              $("#email").val(response.email);
              $("#phone").val(response.phone);
              $('.btn-success').text('update');
              $('.modal-title').text('Edit Student');

              $("#myModal").modal('show');

            }
          });
        });
        //Delete Students

        $(document).on('click', '.btn-danger', function(e) {
          e.preventDefault();
          var id = $(this).val();
          $.ajax({
            url: "{{ route('deleteStudent') }}",
            type: "post",
            data: {
              "_token": "{{ csrf_token() }}",
              "id": id,
            },
            success: function(response) {
              $("#respanel").html(response);
              fetchrecords();
            }
          });
        });


        function fetchrecords() {
          $.ajax({
            url: "{{route('getStudent')}}",
            type: "get",
            success: function(response) {
              //  console.log(response);
              var tr = "";
              for (var i = 0; i < response.length; i++) {
                var id = response[i].id;
                var first_name = response[i].first_name;
                var last_name = response[i].last_name;
                var email = response[i].email;
                var phone = response[i].gender;

                tr += '<tr>';
                tr += '<td>' + id + '</td>';
                tr += '<td>' + first_name + '</td>';
                tr += '<td>' + last_name + '</td>';
                tr += '<td>' + email + '</td>';
                tr += '<td>' + phone + '</td>';

                tr += '<td><button type="button" class="btn btn-warning" value="' + id + '">Edit</button></td>';
                tr += '<td><button type="button" class="btn btn-danger" value="' + id + '">Delete</button></td>';
                tr += '</tr>';
              }
              $('#student_data').html(tr);

            }
          });
        }
        fetchrecords();
      });
    </script>

</body>

</html>