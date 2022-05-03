@include('inc/header')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Employee</a></li>
    <li class="breadcrumb-item active" aria-current="page">View Employee</li>
  </ol>
</nav>
<div class="page-title">                    
                    <h2><a href="javascript:history.back()"><span class="fa fa-arrow-circle-o-left"></span></a> Employee Details - {{$results->emp_no}}</h2>
   </div>
   <div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<table class='table table-bordered'>
							<tr>
								<td><strong>Name</strong></td>
								<td>{{$results->emp_name}}</td><strong>
							</tr>
							<tr>
								<td><strong>Passport</strong></td>
								<td>{{$results->passport_no}}</td>
							</tr>
							<tr>
								<td><strong>Passport Expiry Date</strong></td>
								<td>
									<?php
                              $passExpiry = strtr($results->pass_expiry, '-', '/');
                              $passExpiry=date('d/m/Y',strtotime($passExpiry));
                            ?>
									{{$passExpiry}}
								</td>
							</tr>
							<tr>
								<td><strong>ID Number</strong></td>
								<td>{{$results->id_no}}</td>
							</tr>
							<tr>
								<td><strong>ID Expiry Date</strong></td>
								<td>
									<?php
                              $idExpiry = strtr($results->id_expiry, '-', '/');
                              $idExpiry=date('d/m/Y',strtotime($idExpiry));
                            ?>
									{{$idExpiry}}</td>
							</tr>
							<tr>
								<td><strong>Entry Date</strong></td>
								<td>
									<?php
                              $fEntryDate = strtr($results->first_entry_date, '-', '/');
                              $fEntryDate=date('d/m/Y',strtotime($fEntryDate));
                            ?>
									{{$fEntryDate}}</td>
							</tr>
							<tr>
								<td><strong>Exit Date</strong></td>
								<td>
									<?php
                              $exitDate = strtr($results->last_exit_date, '-', '/');
                              $exitDate=date('d/m/Y',strtotime($exitDate));
                            ?>
									{{$exitDate}}</td>
							</tr>
							<tr>
								<td><strong>Nationality</strong></td>
								<td>{{$results->name}}</td>
							</tr>
							<tr>
								<td><strong>Phone Number</strong></td>
								<td>{{$results->phone_number}}</td>
							</tr>
							<tr>
								<td><strong>Home Number</strong></td>
								<td>{{$results->home_number}}</td>
							</tr>
							<tr>
								<td><strong>Camp</strong></td>
								<td>{{$results->camp}}</td>
							</tr>
							<tr>
								<td><strong>Status</strong></td>
								<td>
									<?php
										if($results->status == 1)
											echo "Active";
										else
											echo "Inactive";
									?>
								</td>
							</tr>
					</table>

					
                </div>
				</div>
			</div>
		</div>
	</div>

@include('inc/footer')