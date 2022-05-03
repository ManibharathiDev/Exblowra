@include('inc/header')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Project</a></li>
    <li class="breadcrumb-item active" aria-current="page">View Project</li>
  </ol>
</nav>
<div class="page-title">                    
                    <h2><a href="javascript:history.back()"><span class="fa fa-arrow-circle-o-left"></span></a> Project Detail</h2>
   </div>
   <div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<table class='table table-bordered'>
							<tr>
								<td><strong>Project</strong></td>
								<td>{{$projectresult->project_name}}</td><strong>
							</tr>
							<tr>
								<td><strong>Client</strong></td>
								<td>{{$projectresult->client_name}}</td>
							</tr>
							<tr>
								<td><strong>Contact Person</strong></td>
								<td>{{$projectresult->contact_person}}</td>
							</tr>
							<tr>
								<td><strong>Location</strong></td>
								<td>{{$projectresult->location}}</td>
							</tr>
							<tr>
								<td><strong>Phone Number</strong></td>
								<td>{{$projectresult->phone_number}}</td>
							</tr>
							<tr>
								<td><strong>Normal Hours</strong></td>
								<td>{{$projectresult->normal_hours}}</td>
							</tr>
							<tr>
								<td><strong>Status</strong></td>
								<td>
									<?php
										if($projectresult->isActive == 1)
											echo "Active";
										else
											echo "Inactive";
									?>
								</td>
							</tr>
					</table>

					<div class="line"></div>
                        <div class="page-title">                    
                    <h2>Job wise price details</h2>
                    <table class="table table-bordered">
                    	<thead class="">
                            <tr>
                              <th rowspan="2">Job</th>
                              <th rowspan="2">Start Date</th>
                              <th colspan="3">Price/hour</th>
                              
                            </tr>
                            <tr>
                              <th>Normal</th>
                              <th>Over Time</th>
                              <th>Holday OT</th>
                            </tr>
                          </thead>
                          <tbody>
                          	@foreach($projectpriceresult as $index => $projectresult)
                          	<tr>
                          		<td>{{$projectresult->job_name}}</td>
                          		<td>{{$projectresult->start_date}}</td>
                          		<td>{{$projectresult->price_nt}}</td>
                          		<td>{{$projectresult->price_ot}}</td>
                          		<td>{{$projectresult->price_hot}}</td>
                          	</tr>
                          	@endforeach
                          </tbody>
                    </table>
                </div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('inc/footer')