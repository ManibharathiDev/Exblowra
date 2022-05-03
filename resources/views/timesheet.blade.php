@include('inc/header')
<?php
	$empNumber = "";
	$sel_date = "";
	$month = date('m');
	$year = date('Y');
	$empNumber= "";
	$projectid = "";
	$skillid = "";
	$normaltime = "";
	$overtime = "";
	$hovertime = "";
	
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Timesheet</li>
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
                    <h2><a href="javascript:history.back()"><span class="fa fa-arrow-circle-o-left"></span></a>  Add Timesheet</h2>
                </div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">


							
					

					@if(!empty($results))
								<?php
									$empNumber = $results->emp_no;
									
								?>
							@endif
					<form class="form-horizontal" action="{{url('/addtimesheet')}}/{{$empNumber}}" method="post" id="needs-validation" role="form" class="needs-validation" name="registration" novalidate> 
					<div class="row">
						<div class="col-md-3">
							<label>Employee Number</label>
							
							@if(!empty($results))
								<?php
									$empNumber = $results->emp_no;
									$sel_date = $date;
								?>
							@endif

							<input type="text" class="form-control" value="{{$empNumber}}"  id="empNumber" required/>
							<div class="invalid-feedback">  
                          Please enter the employee number.  
                        </div> 
							{{ csrf_field() }}   
						</div>

						<div class="col-md-4">
							<div>
							<label>Date</label>
							</div>
							<div class="row">
							<div class="col-md-10">
							<div class="input-group">
                            <div class="input-group-prepend" id="selDate">
                              
                              <i class="fa fa-calendar btn btn-primary" aria-hidden="true"></i>
                            </div>
                            <input type="text" autocomplete="off" value="{{$sel_date}}" id="empDate" name="timeSheetDate" class="form-control" required>
                            <div class="invalid-feedback">  
                          		Please select date.  
                        	</div>
                          </div>
						</div>
						<div class="col-md-2">
							<input type="submit" id="getData" class="btn btn-primary" value="Lookup"/>
						</div>
						</div>
						</div>
						@if(!empty($results))
						<div class="col-md-3 text-right ml-auto" style="
    background: #33b35a;
    color: #FFF;
    font-weight: bold;border-left: 5px solid #0459a8;
">
							<div style="
    width: 100%;
    text-align: right;
    /* background: white; */
    border-bottom: 1px solid #FFF;
    font-weight: 500;
"><label>Employee Name</label></div>
							<strong>{{$results->emp_name}}</strong>
						</div>
						@endif

					</div>
					
				</form>


				@if(!empty($results))

				<div class="table-data">

					<?php
						if($sel_date != ""){
							$months = $sel_date;
							$month_split = explode("/",$months);
							$month = $month_split[1];
							$year = $month_split[2];
							$days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
						}
						else
							{
								$days =  date("t");
								
							}
					?>
					<br>
					<form class="form-horizontal" action="{{url('/savetimesheet/')}}/{{$empNumber}}" method="post" id="timesheet-validation" class="timesheet-validation" name="timeSheetRegistration">

						{{ csrf_field() }}   
					<table class="table table-bordered table-striped no-footer dtr-inline">
						<?php
							$j = 1;
						?>
						<tr class="dark-head">
							<td style="
    width: 25px;
">Week {{$j++}}</td>
						
							<td>
								<label><input type="checkbox" id="selHeadProject">&nbsp;&nbsp;Project</label>
									<select class="form-control selHeadProject">
									<option value="">Select Project</option>
									@foreach ($projectresult as $index =>$presult)
									<option value="{{$presult->project_id}}">{{$presult->project_name}}</option>
									@endforeach
								</select>
							</td>
							<td>
								<label><input type="checkbox" id="selHeadSkill">&nbsp;&nbsp;Skill</label>
								<select class="form-control selHeadSkill"></select>
							</td>
							<td>
								<label><input type="checkbox" id="selHeadnHours">&nbsp;&nbsp;N Time</label>
								<input type="text" class="form-control selHeadnHours">
							</td>
							<td>
								<label>
									<input type="checkbox" id="selHeadotHours">&nbsp;&nbsp;Over Time</label>
								<input type="text" class="form-control selHeadotHours">
								</td>
						</tr>
						<?php
							$dayClass = "";
							$vDate = "";
							for($i = 1; $i<=$days; $i++)
							{
								$datelength = strlen((string)$i);
								if($datelength == 1){
									$datelength = "0".$i;
								}
								else
									$datelength	= $i;
								$date = $year."-".$month."-".$datelength;
								$vDate = $datelength."-".$month."-".$year;
								//Get the day of the week using PHP's date function.
								$dayOfWeek = date("l", strtotime($date));
								if($dayOfWeek == "Friday")
									$dayClass = "friday";
								else
									$dayClass = "";
							?>



								@if(!empty($timeresult))
								
								@foreach ($timeresult as $index =>$tresult)
								<?php
								$projectid = "";
								$skillid = "";
								$normaltime = "";
								$overtime = "";
								$hovertime = "";

									if($tresult->date == $date)
									{
										$projectid = $tresult->project_id;
										$skillid = $tresult->job_id;
										$normaltime = $tresult->normal_time;
										$overtime = $tresult->over_time;
										$hovertime = $tresult->hover_time;
										break;
									}

								?>
								@endforeach
							@endif

							<tr id="{{$i}}">

								<input type="hidden" value={{$date}} name="date[]">

							<td class="{{$dayClass}}">
								{{$dayOfWeek}}<br>{{$vDate}}</td>
							<td>
								<select class="form-control selProject" name="project[]" id="project-{{$i}}">
									<option value="">Select Project</option>
									@foreach ($projectresult as $index =>$presult)
									<?php
										if($projectid == $presult->project_id)
										{
											?>
											<option value="{{$presult->project_id}}" selected>{{$presult->project_name}}</option>
										<?php
										}
										else{
											?>
											<option value="{{$presult->project_id}}">{{$presult->project_name}}</option>
										<?php
									}
									?>
									
									@endforeach
								</select>
							</td>
							<td style="
    width: 200px;
"><select class="form-control selSkill" name="skill[]" id="skill-{{$i}}">
								<option value="">Select Skill</option>
								@if(!empty($timeresult))
									@if(!empty($skillresult))
										@foreach($skillresult as $index => $sresult)
											@if($projectid == $sresult->project_id)
												@if($skillid == $sresult->job_id)
												<option value="{{$sresult->job_id}}" selected>{{$sresult->job_name}}</option>
												@else
												<option value="{{$sresult->job_id}}">{{$sresult->job_name}}</option>
												@endif

											@endif
										@endforeach
									@endif
								@endif
							</select></td>
							<td>

								<?php
									if($dayClass == "friday"){
										?>
										<input type="text" class="form-control" value="{{$normaltime}}" name="nhours[]">
									<?php
									}
									else{
										?>
										<input type="text" class="form-control selnHours" value="{{$normaltime}}" name="nhours[]">
									<?php
									}
								?>
								</td>
							<td>

								<?php
									if($dayClass == "friday"){
										?>
										<input type="text" class="form-control" value="{{$overtime}}" name="othours[]">
									<?php
									}
									else{
										?>
										<input type="text" class="form-control selotHours" value="{{$overtime}}" name="othours[]">
									<?php
									}
								?>

								<!-- <input type="text" value="{{$overtime}}" class="form-control selotHours" name="othours[]"> -->
							</td>
							<!-- <td><input type="text" class="form-control selnHours" value="5" name="nhours[]"></td>
							<td><input type="text" class="form-control selotHours" name="othours[]"></td> -->
						</tr>
						<?php
							if($dayOfWeek == "Sunday" && $i != $days)
							{
								?>
								<tr class="dark-head">
							<td style="
    width: 25px;
">Week {{$j++}}</td>
							<td>Project</td>
							<td>Skill</td>
							<td>N Time</td>
							<td>Over Time</td>
						</tr>
							<?php
						}
						?>
						<?php	
							}
						?>
					</table>
					<br>
					<div class="row">
							<div class="col-md-3">
									<div class="form-group">
											<input type="button" id="timesheetUpdate" class="btn btn-primary" value="Submit"/>
									</div>
							</div>
					</div>
				</form>
				</div>
				@endif

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-times"></span> Timesheet <strong>Action</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to do this?</p>                    
                        <p>Press Yes if you sure.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <button class="btn btn-success btn-lg mb-control-yes">Yes</button>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>





@include('inc/footer')
<script type="text/javascript">
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
$(document).ready(function(){


	/*$(document).on('submit','#timesheet-validation',function(e){
		e.preventDefault();
		alert("Form Clicked");

		var data = new FormData(this);
				$.ajax({

					url:$('#timesheet-validation').attr('action'),
					type:'POST',
					data:data,
					dataType:'json',
					contentType:false,
					processData: false,
					success:function(element){
							
					}
				});

		

		
	});*/

	$('.selHeadSkill').prop('disabled',true);


		$("#selHeadnHours").change(function() {
    var ischecked= $(this).is(':checked');
    if(ischecked)
    {
    		$('.selnHours').val($('.selHeadnHours').val());
    		
    }	
    else{
    	$('.selnHours').val("");
    }
}); 

		$(document).on('keyup','.selHeadnHours',function()
		{
			var ischecked= $('#selHeadnHours').is(':checked');
			if(ischecked)
				$('.selnHours').val($('.selHeadnHours').val());

		});

		$("#selHeadotHours").change(function() {
    var ischecked= $(this).is(':checked');
    if(ischecked)
    {
    		$('.selotHours').val($('.selHeadotHours').val());
    		
    }	
    else{
    	$('.selotHours').val("");
    }
}); 

		$(document).on('keyup','.selHeadotHours',function()
		{
			var ischecked= $('#selHeadotHours').is(':checked');
			if(ischecked)
				$('.selotHours').val($('.selHeadotHours').val());
		
		});


	$("#selHeadProject").change(function() 
	{
    var ischecked= $(this).is(':checked');
    if(ischecked)
    {
    		$('.selProject').val($('.selHeadProject').val());
    		$('.selSkill').html($('.selHeadSkill').html());
    }	
    else{
    	$('.selProject').val("");
    }



}); 

	$('.selHeadProject').on('change',function()
	{
		var ischecked= $('#selHeadProject').is(':checked');
		if(ischecked){
			$('.selProject').val($('.selHeadProject').val());
    		$('.selSkill').html($('.selHeadSkill').html());
		}
		else{
			$('.selProject').val("");
		}

		if($('.selHeadProject').val() != ""){
			$('.selHeadSkill').prop('disabled',false);
		}
		else{
			$('.selHeadSkill').prop('disabled',true);
		}

	});

	$("#selHeadSkill").change(function() {

		

		if($('.selHeadSkill').val() != "" && $('.selHeadSkill').html() != "") 
		{
			var ischecked= $(this).is(':checked');
		    if(ischecked)
		    {
		    		
		    		$('.selSkill').html($('.selHeadSkill').html());
		    		$('.selSkill').val($('.selHeadSkill').val());
		    }	
		    else{
		    	$('.selSkill').val("");
		    }
		}
		else{
			$('.selSkill').val("");
			$("#selHeadSkill").prop('checked',false);
		}

    
}); 

	$('.selHeadSkill').on('change',function(){
		var ischecked= $('#selHeadSkill').is(':checked');
		if(ischecked){
			$('.selSkill').html($('.selHeadSkill').html());
    		$('.selSkill').val($('.selHeadSkill').val());
		}
		else{
			$('.selSkill').val("");
		}
	});

	$('#empNumber').on('blur',function()
	{

		var timesheet = "addtimesheet/"+$('#empNumber').val();
		var baseURL = window.location.href;
		var str = baseURL.substr(baseURL.lastIndexOf('/') + 1) + '$';
    	var currentURL = baseURL.replace( new RegExp(str), '' );
    	var action = "";
    	if(currentURL.indexOf("addtimesheet") != -1){
    				action = currentURL+$('#empNumber').val();
		}
		else
			action = currentURL+timesheet;
		console.log(currentURL);

		$('#needs-validation').attr('action', action);
	});




	$('#selDate').click(function(){
      $('#empDate').datepicker('show');
    });

    $('#empDate').datepicker({
    startDate: '-12m',
    format: 'dd/mm/yyyy',
    autoclose: true
});

    $(document).on('change','.selHeadProject',function(){
    	

    	var selValue = $(this).val();

    	var data = {_token : document.getElementsByName("_token")[0].value,projectid:selValue};
        $.ajax({

          url:'{{url("/getjobbyproject")}}',
          type:'POST',
          data:data,
          dataType:'json',
          success:function(element){
              if(element.success == 1)
              {
              	var data = element.data;
              	var content = "";
              		$.each(data, function(index, job) 
                    {
                    		content += "<option value='"+job.job_id+"'>";
                    		content += job.job_name;
                    		content += "</option>";
                    })
                    $('.selHeadSkill').html(content);
              }
              else{
              		var html = "";
              		$('#selHeadSkill').prop('checked',false);
              		 $('.selHeadSkill').html(html);
              }
          }
        });

    });

    $(document).on('change','.selProject',function(){
    	var selId = this.id;
    	selId = selId.split("-");
    	selId = selId[1];

    	var selValue = $(this).val();

    	var data = {_token : document.getElementsByName("_token")[0].value,projectid:selValue};
        $.ajax({

          url:'{{url("/getjobbyproject")}}',
          type:'POST',
          data:data,
          dataType:'json',
          success:function(element){
              if(element.success == 1)
              {
              	var data = element.data;
              	var content = "";
              	content +="<option value=''>Select Skill</option>";
              		$.each(data, function(index, job) 
                    {
                    		content += "<option value='"+job.job_id+"'>";
                    		content += job.job_name;
                    		content += "</option>";
                    })
                    $('#skill-'+selId).html(content);
              }
              else{
              	var content = "";
              	content +="<option value=''>Select Skill</option>";
					$('#skill-'+selId).html(content);
              }
          }
        });

    });

    $('#timesheetUpdate').click(function(){
    	
    	$('#mb-remove-row').show();
    });

    $('.mb-control-yes').click(function(){
    	$('#timesheet-validation').submit();
    	$('#mb-remove-row').hide();
    });

    $('.mb-control-close').click(function(){
    	$('#mb-remove-row').hide();
    });


    

});
</script>

