@include('inc/header')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Project</li>
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
                    <h2><a href="javascript:history.back()"><span class="fa fa-arrow-circle-o-left"></span></a>  Add Project</h2>
                </div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <form class="form-horizontal" action="{{url('/saveproject')}}" method="post" id="needs-validation" role="form" class="needs-validation" name="registration" novalidate>
            {{ csrf_field() }}   
            <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Project Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="projectName" required>
                        <div class="invalid-feedback">  
                          Please enter the project name.  
                        </div> 
                      </div>
                    </div>
            <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Select Client</label>
                      <div class="col-sm-10">
                        <select name="clientName" class="form-control" required>
                            <option value="">Select Client</option>
                        @foreach ($results as $index =>$result)
                            <option value="{{$result->client_id}}">{{$result->client_name}}</option>
                         @endforeach
                         </select>
                        <div class="invalid-feedback">  
                          Please select the client.  
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
                      <label class="col-sm-2 form-control-label">Location</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="location" required>
                        <div class="invalid-feedback">   
                          Please enter the location. 
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

                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Normal Hours</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control only-numeric" name="normalHours" required>
                        <div class="invalid-feedback">  
                          Please enter the normal hours.  
                        </div> 
                      </div>
                    </div>

                      <div class="line"></div>
                        <div class="page-title">                    
                    <h2>Add Price Details</h2>
                </div>

                    <table id="tableJob" class="table table-bordered">
                          <thead class="">
                            <tr>
                              <th rowspan="2">Job</th>
                              <th rowspan="2">Start Date</th>
                              <th colspan="3">Price/hour</th>
                              <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                              <th>Normal</th>
                              <th>Over Time</th>
                              <th>Holday OT</th>
                            </tr>
                          </thead>
                          <tbody id="jobTable">
                            <tr id="1">
                            <td id="topJob">
                              <select class="form-control" name="job[]" required>
                            <option value="">Select Job</option>
                        @foreach ($jobResult as $index =>$result)
                            <option value="{{$result->job_id}}">{{$result->job_name}}</option>
                         @endforeach
                         </select>
                         <div class="invalid-feedback">  
                          Please Select the Job.  
                        </div> 
                       </td>
                            
                            <td>

                              <div class="input-group">
                            <div class="input-group-prepend" id="exitExpiryButton">
                              
                              <i class="fa fa-calendar btn btn-primary" aria-hidden="true"></i>
                            </div>
                            <input type="text" autocomplete="off" id="fexitDate" name="sdate[]" class="form-control startDate"> 
                            <div class="invalid-feedback">  
                          Please enter the project start date.  
                        </div>
                          </div>

                              <!-- <input type="text" class="form-control startDate" name="sdate[]" required>
                              <div class="invalid-feedback">  
                          Please enter the price.  
                        </div> -->


                            </td>
                            <td><input type="text" class="form-control only-numeric-decimal" name="nhour[]" required="">
                              <div class="invalid-feedback">  
                          Please enter the normal hour price.  
                        </div>
                            </td>
                            <td><input type="text" class="form-control only-numeric-decimal" name="ot[]" required>
                              <div class="invalid-feedback">  
                          Please enter the overtime price.  
                        </div>
                            </td>
                            <td><input type="text" class="form-control hot only-numeric-decimal" id="hot-1" name="hot[]" required>
                              <div class="invalid-feedback">  
                              Please enter the holiday overtime price.  
                              </div>
                            </td>
                            <td><!-- <button class="btn btn-danger btn-rounded btn-condensed btn-sm deleteRow"><span class="fa fa-times"></span></button> --></td>
                          </tr>
                          </tbody>
                    </table>

                    <div class="line"></div>
                    <div class="line"></div>

                    <div class="form-group row" style="
    margin-top: 10px;
">
                      <div class="col-sm-4 offset-sm-2">
                        <button type="button" class="btn btn-secondary cancelForm">Cancel</button>
                        <button type="click" id="projectAdd" class="btn btn-primary">Save</button>
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
                      
                      $('#projectAdd').prop('disabled', true);
                    }
                    form.classList.add('was-validated'); 

                }, false);  
            }, false);  
        })();  

        $(document).ready(function()
        {
          //var rowCount = $('#jobTable tr').length;
          rowCount = 1;

/*
          $('#expiryButton').click(function(){
      $('#passExpiry').datepicker('show');
    });

    $('.startDate').datepicker({
    startDate: '-3d',
    format: 'dd/mm/yyyy',
    autoclose: true
});*/

    $(document).on("focus", ".startDate", function() {
      console.log("Supposed to show the datepicker"); //This is working so the datepicker should work too.
      $('.startDate').datepicker({
        format: 'dd/mm/yyyy',
    autoclose: true
      });
      /*$('.startDate').datepicker('show');*/
    });

          $(document).on('keydown', '.hot', function(e) 
          { 

            var id = this.id;
            rowids = id.split("-");
            currentId = rowids[1];
            var id = $('#jobTable tr:last').attr('id');
            //alert(id);
            if(id != currentId)
            {
                //return false;
            }
            else{
            rowCount++;
            var keyCode = e.keyCode || e.which; 
            console.log(keyCode);
            var content ="";
            if (keyCode == 9) 
            { 
              //e.preventDefault(); 
              content += "<tr id='"+rowCount+"'>";
              content += "<td>";
              content += $('#topJob').html();
              content += "</td>";
              content += "<td>";
              content += "<div class='input-group'>";
              content += "<div class='input-group-prepend'>";
              content += "<i class='fa fa-calendar btn btn-primary' aria-hidden='true'></i>";
              content += "</div>";
              content += "<input type='text' autocomplete='off' name='sdate[]' class='form-control startDate'>"; 
              content += "<div class='invalid-feedback'>Please enter the project start date.";  
              content += "</div>";
              content += "</div>";
              content += "</td>";
             
             /* content += "<td><input type='text' class='form-control' name='sdate[]' required>";
              content += "<div class='invalid-feedback'> "; 
              content += "Please enter the price. "; 
              content += "</div>";
              content += "</td>";*/
              content += "<td><input type='text' class='form-control only-numeric-decimal' name='nhour[]' required>";
              content += "<div class='invalid-feedback'>";  
              content += "Please enter the normal hour price.";  
              content += "</div>";
              content += "</td>";
              content += "<td><input type='text' class='form-control only-numeric-decimal' name='ot[]' required>";
              content += "<div class='invalid-feedback'> "; 
              content += "Please enter the overtime price.";  
              content += "</div>";
              content += "</td>";
              hotid = "hot-"+rowCount;
              content += "<td><input type='text' class='form-control hot only-numeric-decimal' id='"+hotid+"' name='hot[]' required>";
              content += "<div class='invalid-feedback'>";  
              content += "Please enter the holiday overtime price.";  
              content += "</div>";
              content += "</td>";
              content += "<td><button id='"+rowCount+"' class='btn btn-danger btn-rounded btn-condensed btn-sm deleteJobRow'><span class='fa fa-times'></span></button></td>";
              content += "</tr>";
              $('#jobTable').append(content);
            } 
          }
          });

          $(document).on('click','.deleteJobRow',function(){
              var id = this.id;
              $('#'+id).remove();
          });

          $(document).on('click','.cancelForm',function(){
            location.href="{{url('/project')}}";
          });

        });
    
      
  /*});*/
</script>