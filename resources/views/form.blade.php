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
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form class="border border-primary" id="my-form" >
                    @csrf
                    <div class="errMessContainer"></div>
                    <div class="form-group row mb-3">                               
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
                            <input type="file" id="file"  name="file" class="form-control" />
                        </div>
                    </div> 
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-md-3">Email</label>
                        <div class="col-md-9">
                            <button type="submit" id="btnSubmit" class="btn btn-success add_student">Save Student Info</button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
        <p class="text-center text-success py-3"><span class="text-secondary" id="output"></span></h1>
    </div>
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
                    },
                    error:function(e){
                        $("#output").text(e.responseText);
                        $("#btnSubmit").prop("disabled", false);
                    }
               });
            });
        });
    </script>
   
</body>
</html>