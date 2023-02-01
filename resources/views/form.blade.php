<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Creation </title>
    <link rel="stylesheet" href="{{asset('/')}}assets/css/all.css">
<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('/')}}assets/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>

</head>
<body>

<header>
        <section class="py-2" style="background-color: #A3D2BE;">
            <div class="container">
                <div class="row text-secondary ">
                    <div class="col-md-6">
                        <ul class="nav">
                            <li class=" border-end pe-3 border-white"><a href=""><img  src="{{asset('/')}}assets/img/logo.png" alt="logo" style="height:50px;"> </a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="nav float-end" >
                            <li class="nav-item py-2"> 
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#studentModal">
                                    Add a New Student
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
</header>
<span id="output"></span>
<section>
    <div class="container">
        <h2 class="pt-3 text-center">This is All student Info</h2>
        <hr/>
        <table class="table table-striped table-hover" id="student-table">
            <thead>
                <tr>
                    <th scope="col">SI NO</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->email}}</td>
                        <td><img src="{{asset($student->image)}}" alt="{{$student->name}}" height="70"width="110"/></td>
                        <td>
                            <a href="" 
                            id="edit"
                            class="btn btn-outline-success editStudenForm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editModal"
                            data-id = "{{ $student->id }}"
                            data-name = "{{ $student->name }}"
                            data-email = "{{ $student->email }}"
                            data-image = "{{ $student->image }}">
                                <i class='fas fa-user-edit'></i>
                            </a>
                            <a href="" data-id ="{{$student->id}}" class="btn btn-outline-danger deleteData" ><i class="fa fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>



<!-- Model Start -->

<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="text-center text-primary" id="addModalLabel">Student Form</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form id="my-form">
            @csrf
            <div class="modal-body">
                <div class="errMessContainer"></div>
                <div class="form-group row mb-3">                                <div class="form-group row mb-3">
                    <label class="col-form-label col-md-3">Name</label>
                    <div class="col-md-9">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-form-label col-md-3">Email</label>
                    <div class="col-md-9">
                        <input type="email" id="email"  name="email" class="form-control" placeholder="Enter Email" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-form-label col-md-3">Image</label>
                    <div class="col-md-9">
                        <input type="file" id="image" name="image" class="form-control" />
                    </div>
                </div>
            </div>
        </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="btnSubmit" class="btn btn-success add_student">Save Student Info</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal End -->

<!-- Edit Model Include start -->
@include('edit');
<!-- Edit Model Include End -->

    <script src="{{asset('/')}}assets/js/bootstrap.bundle.min.js"></script>
  
    <script>
        $(document).ready(function(){
            $("#my-form").submit(function(event){
                event.preventDefault();
               var form = $("#my-form")[0];
               var data =  new FormData(form); 
               $("#btnSubmit").prop("disabled", true);

               $.ajax({
                    type: "POST",
                    url:"{{route('addStudent')}}",
                    data: data,
                    processData:false,
                    contentType:false,
                    success:function(data){
                        $("#output").text(data.res);
                        $("#btnSubmit").prop("disabled", false);
                        $("input[type = 'text']").val('');
                        $("input[type = 'email']").val('');
                        $("input[type = 'file']").val('');
                        $("#studentModal").modal('hide');
                        $('.table').load(location.href+' .table');
                    },
                    error:function(e){
                        $("#output").text(e.responseText);
                        $("#btnSubmit").prop("disabled", false);
                        $("input[type = 'text']").val('');
                        $("input[type = 'email']").val('');
                        $("input[type = 'file']").val('');
                    }
               });
            });

            $(document).on('click','.deleteData', function(ev){
                ev.preventDefault();
                // alert($(this).attr("data-id"));
                if(confirm('Are you sure delete this student !!')){
                    var student_id = $(this).attr("data-id");
                    var obj = this;
                    $.ajax({
                        type:"POST",
                        url:"{{route('delete.Student')}}",
                        data:{id:student_id}
                        success:function(data){
                            if(data = 'success'){
                                $(obj).parent().parent().remove();
                                $("#output").text(data.result);
                            }
                            else{
                                $("#output").html("Somethis Error");
                            }
                        },
                        error:function(err){
                            console.log(err.responseText);
                        }
                    });
                }
                
            }); 
          

          
        });

    </script>
   
</body>
</html>