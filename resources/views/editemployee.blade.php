@include('inc/header')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Employee</li>
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
                    <h2><a href="javascript:history.back()"><span class="fa fa-arrow-circle-o-left"></span></a>  Edit Employee - {{$results->emp_no}}</h2>
                </div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form class="form-horizontal" action="{{url()->current().'/save'}}" method="post" id="needs-validation" role="form" class="needs-validation" name="registration" novalidate> 
                                   {{ csrf_field() }}   
						<div class="form-group row">
                      <label class="col-sm-2 form-control-label">Employee Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="employeeName" value="{{$results->emp_name}}" id="employeeName" class="form-control" required>
                        <div class="invalid-feedback">  
                          Please enter employee name.  
                        </div> 
                        
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                       <div class="form-group row">
                      <label class="col-sm-4 form-control-label">Passport Number</label>
                      <div class="col-sm-8">
                        <input type="text" name="passportNumber" value="{{$results->passport_no}}" class="form-control" required>
                        <div class="invalid-feedback">  
                          Please enter passport number.  
                        </div>
                      </div>
                    </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                      <label class="col-sm-4 form-control-label">Passport Expiry Date</label>
                      <div class="col-sm-8">
                        <div class="input-group">
                            <div class="input-group-prepend" id="expiryButton">
                              
                              <i class="fa fa-calendar btn btn-primary" aria-hidden="true"></i>
                            </div>

                            <?php
                              $passportExpiry = strtr($results->pass_expiry, '-', '/');
                              $passportExpiry=date('d/m/Y',strtotime($passportExpiry));
                            ?>

                            <input type="text" autocomplete="off"  name="passportExpiry" id="passExpiry" value="{{$passportExpiry}}"  class="form-control" required>
                            <div class="invalid-feedback">  
                          Please enter passport expiry date.  
                        </div>
                          </div>
                       
                      </div>
                    </div>
                      </div>
                    </div>

                     <div class="row">
                      <div class="col-md-6">
                       <div class="form-group row">
                      <label class="col-sm-4 form-control-label">ID Number</label>
                      <div class="col-sm-8">
                        <input type="text" value="{{$results->id_no}}"  name="idNumber" class="form-control" required>
                        <div class="invalid-feedback">  
                          Please enter ID number.  
                        </div>
                      </div>
                    </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                      <label class="col-sm-4 form-control-label">ID Expiry Date</label>
                      <div class="col-sm-8">
                         <div class="input-group">
                            <div class="input-group-prepend" id="idExpiryButton">
                              
                              <i class="fa fa-calendar btn btn-primary" aria-hidden="true"></i>
                            </div>
                            <?php
                              $idExpiry = strtr($results->id_expiry, '-', '/');
                              $idExpiry=date('d/m/Y',strtotime($idExpiry));
                            ?>
                            <input type="text" autocomplete="off"  value="{{$idExpiry}}"  id="idExpiry"   name="idExpiry" class="form-control" required>
                            <div class="invalid-feedback">  
                          Please enter ID expiry date.  
                        </div>
                          </div>
                      </div>
                    </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">First Entry Date</label>
                      <div class="col-sm-10">
                         <div class="input-group">
                            <div class="input-group-prepend" id="entryExpiryButton">
                              
                              <i class="fa fa-calendar btn btn-primary" aria-hidden="true"></i>
                            </div>
                            <?php
                              $firstEntryDate = strtr($results->first_entry_date, '-', '/');
                              $firstEntryDate=date('d/m/Y',strtotime($firstEntryDate));
                            ?>
                            <input type="text" value="{{$firstEntryDate}}" id="fentryDate" autocomplete="off" name="entryDate" class="form-control" required> 
                            <div class="invalid-feedback">  
                          Please enter first entry date.  
                        </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Nationality</label>
                      <div class="col-sm-10">


                        <select name="nationality" class="form-control" required>
                            <option value="">Select Nationality</option>
                        @foreach ($nationality as $index =>$resultNational)
                            <?php
                            if($resultNational->id == $results->nationalityID)
                            {
                              ?>
                              <option value="{{$resultNational->id}}" selected>{{$resultNational->name}}</option>
                            <?php
                            }
                            else{
                              ?>
                              <option value="{{$resultNational->id}}">{{$resultNational->name}}</option>
                            <?php  
                            }
                            ?>
                            
                         @endforeach
                         </select>
                        <div class="invalid-feedback">  
                          Please enter nationality.  
                        </div>
                      </div>
                    </div>

                    

                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Phone Number</label>
                      <div class="col-sm-10">
                        <input type="text" name="phoneNumber" value="{{$results->phone_number}}" class="form-control only-numeric" required>
                        <div class="invalid-feedback">  
                          Please enter phone number.  
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Home Number</label>
                      <div class="col-sm-10">
                        <input type="text" name="homeNumber" value="{{$results->home_number}}" class="form-control only-numeric">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Camp Number</label>
                      <div class="col-sm-10">
                        <input type="text" name="camp" value="{{$results->camp}}" class="form-control" required>
                        <div class="invalid-feedback">  
                          Please enter camp number.  
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Employee Status</label>
                      <div class="col-sm-10">
                        <select name="empStatus" class="form-control" required>
                            <option value="">Select Status</option>
                        @foreach ($empstatus as $index =>$resultstatus)
                        <?php
                          if($resultstatus->id == $results->empStatus){
                            ?>
                            <option value="{{$resultstatus->id}}" selected>{{$resultstatus->status}}</option>
                          <?php
                          }
                          else{
                            ?>
                            <option value="{{$resultstatus->id}}">{{$resultstatus->status}}</option>
                          <?php
                          }
                        ?>
                            
                         @endforeach
                         </select>
                        <div class="invalid-feedback">  
                          Please enter nationality.  
                        </div>
                      </div>
                    </div>

                    <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <button type="button" class="btn btn-secondary cancelForm">Cancel</button>
                        <button type="click" id="employeeAdd" class="btn btn-primary">Update</button>
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
                    
                      $(':input[type="submit"]').prop('disabled', true);
                    }
                    form.classList.add('was-validated'); 

                }, false);  
            }, false);  
        })();  
    
      
  /*});*/

  $(document).ready(function(){
    $('#expiryButton').click(function(){
      $('#passExpiry').datepicker('show');
    });

    $('.cancelForm').on('click',function(){
      location.href = "{{url('/employee')}}";
    });

    $('#passExpiry').datepicker({
    startDate: '-3d',
    format: 'dd/mm/yyyy',
    autoclose: true
});

    $('#idExpiryButton').click(function(){
      $('#idExpiry').datepicker('show');
    });

    $('#idExpiry').datepicker({
    startDate: '-3d',
    format: 'dd/mm/yyyy',
    autoclose: true
});

    $('#entryExpiryButton').click(function(){
      $('#fentryDate').datepicker('show');
    });

    $('#fentryDate').datepicker({
    startDate: '-3d',
    format: 'dd/mm/yyyy',
    autoclose: true
});

    $('#exitExpiryButton').click(function(){
      $('#fexitDate').datepicker('show');
    });

    $('#fexitDate').datepicker({
    startDate: '-3d',
    format: 'dd/mm/yyyy',
    autoclose: true
});
  });
</script>