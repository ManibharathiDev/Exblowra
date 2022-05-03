@include('inc/header')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Client</li>
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
                    <h2><a href="javascript:history.back()"><span class="fa fa-arrow-circle-o-left"></span></a>  Add Client</h2>
                </div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form class="form-horizontal" action="{{url('/saveclient')}}" method="post" id="needs-validation" role="form" class="needs-validation" name="registration" novalidate>
            {{ csrf_field() }}   
						<div class="form-group row">
                      <label class="col-sm-2 form-control-label">Client Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="clientName" required>
                        <div class="invalid-feedback">  
                          Please enter client name.  
                        </div> 
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Contact Person</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="contactPerson" required>
                        <div class="invalid-feedback">  
                          Please enter the contact person.  
                        </div> 
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Address</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="address" required>
                        <div class="invalid-feedback">   
                          Please enter the address. 
                        </div> 
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Phone Number</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="phoneNumber" required>
                        <div class="invalid-feedback">  
                          Please enter the phone number.  
                        </div> 
                      </div>
                    </div>

                    <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <button type="button" class="btn btn-secondary cancelForm">Cancel</button>
                        <button type="click" id="clientAdd" class="btn btn-primary">Save</button>
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
                      
                      $('#clientAdd').prop('disabled', true);
                    }
                    form.classList.add('was-validated'); 

                }, false);  
            }, false);  
        })();  
    
      
  /*});*/

  $(document).ready(function(){
    $('.cancelForm').on('click',function(){
      location.href = "{{url('/client')}}";
    });
  });
</script>