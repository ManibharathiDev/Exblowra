@include('inc/header')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add User</li>
  </ol>
</nav>
@if (session('success'))
                 <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <strong>Success!</strong> {{ session('success') }}.
                 </div>
                @endif
                @if (session('Fail'))
                 <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <strong>Fail!</strong> {{ session('Fail') }}.
                 </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    @foreach ($errors->all() as $error)
                         <strong>Fail!</strong>{{ $error }}.
                    @endforeach
                </div>
                @endif
<div class="page-title">                    
                    <h2><a href="javascript:history.back()"><span class="fa fa-arrow-circle-o-left"></span></a>  Add User</h2>
                </div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form class="form-horizontal" action="{{url('/saveuser')}}" method="post" id="needs-validation" role="form" class="needs-validation" name="registration" novalidate>
            {{ csrf_field() }}   
						<div class="form-group row">
                      <label class="col-sm-2 form-control-label">User Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="userName" required>
                        <div class="invalid-feedback">  
                          Please enter the name of the user.  
                        </div> 
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">User Type</label>
                      <div class="col-sm-10">
                      	<select name="userType" class="form-control" required>
                      		<option value=""></option>
                      		<option value="1">Super Admin</option>
                      		<option value="2">Admin</option>
                      		<option value="3">Employee</option>
                      	</select>
                        
                        <div class="invalid-feedback">  
                          Please select the user type.  
                        </div> 
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Login ID</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="loginID" required>
                        <div class="invalid-feedback">  
                          Please enter the login id.  
                        </div> 
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" required>
                        <div class="invalid-feedback">   
                          Please enter the password. 
                        </div> 
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Confirm Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="cPassword" required>
                        <div class="invalid-feedback">   
                          Please enter the Confirm password. 
                        </div> 
                      </div>
                    </div>


                    

                    <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <button type="button" class="btn btn- cancelForm">Cancel</button>
                        <button type="click" id="userAdd" class="btn btn-primary">Save</button>
                      </div>
                    </div>

					</form>
				</div>
			</div>
		</div>
	</div>

</div>
@include('inc/footer')

<script type="text/javascript">
  /*$(document).ready(function(){*/
    
      
        (function () {  
            'use strict';  
            window.addEventListener('load', function () 
            {  
                var form = document.getElementById('needs-validation');  
                form.addEventListener('submit', function (event) {  
                    if (form.checkValidity() === false) 
                    {  
                        event.preventDefault();  
                        event.stopPropagation();  

                    }  
                    else{
                      
                      $('#userAdd').prop('disabled', true);
                    }
                    form.classList.add('was-validated'); 

                }, false);  
            }, false);  
        })();  
    
      
$(document).ready(function(){
  $('.cancelForm').on('click',function(){
      location.href = "{{url('/user')}}";
    });
});

  /*});*/
</script>