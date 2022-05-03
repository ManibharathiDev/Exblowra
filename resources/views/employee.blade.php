@include('inc/header')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Employee</li>
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



<div class="">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive" style="
    overflow: scroll;
">
                                        <!-- <table id="example" class="table datatable table-striped table-bordered dt-responsive nowrap"> -->
                                            <table id="employeeTable" class="datatable table table-bordered table-striped dataTable" style="width: 100%;">

                                        	<thead class="">
                                                <tr class="thead"><th></th>
                                                    <th class="select-filter empNumberSearch">Emp Number</th>
                                                    <th class="select-filter">Name</th>
                                                    <th class="select-filter empNumberSearch">Status</th>
                                                    <th class="select-filter empNumberSearch">Passport</th>
                                                    <th class="select-filter empNumberSearch">ID</th>
                                                    <th></th>
                                                    <th></th>
                                                    <!-- <th></th>
                                                    <th></th>
                                                    <th></th> -->
                                                </tr>
                                                <tr><th>#</th>
                                                    <th>Emp No.</th>
                                                	<th>Name</th>
                                                    <th>Status</th>
													<th>Passport</th>
													<!-- <th>Passport Expiry</th> -->
													<th>ID</th>
													
													<th>Nationality</th>
													<!-- <th>Home Number</th> -->
													<!-- <th>Camp</th> -->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i=1;
                                                ?>
                                                @foreach ($results as $index =>$result)                                            
                                                <tr id="<?php echo $result->emp_no ?>">
                                                    <td><?php echo $i++;?></td>
                                                    <td>{{ $result->emp_no }}</td>
                                                    <td><strong><a href="viewemployee/{{ $result->emp_no }}">{{ $result->emp_name }}</a></strong></td>
                                        <td><span>{{ $result->statusName }}</span><span class="fa fa-pencil editStatus" id="status-{{$result->emp_no}}" style="
    text-align: right;
    float: right;
    padding: 5px;
    background: #c40e28;
    color: #FFF;
    cursor: pointer;
    border-radius: 5px;
"></span></td>
                                                    <td>{{ $result->passport_no }}</td>
                                                    <!-- <td>{{ $result->pass_expiry }}</td> -->
                                                    <td>{{ $result->id_no }}</td>
                                                     <!-- <td>{{ $result->id_expiry }}</td> -->
                                                     <!--  <td>{{ $result->first_entry_date }}</td> -->
                                                       <td>{{ $result->name }}</td>
                                                       <!--  <td>{{ $result->phone_number }}</td>
                                                         <td>{{ $result->home_number }}</td> -->
                                                         <!-- <td>{{ $result->camp }}</td> -->
                                                    <td>
                                                      
                                                            <button class="btn btn-default btn-rounded btn-condensed btn-sm">
                                                    <a href="editemployee/<?php echo $result->emp_no ?>"><span class="fa fa-pencil"></span></a></button>
                                                    <!-- <form id="deleteRow"> -->
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="emp_no" value="{{$result->emp_no}}">
                                                        <button class="btn btn-danger btn-rounded btn-condensed btn-sm deleteRow" id="delete-{{$result->emp_no}}"><span class="fa fa-times"></span></button>
                                                    <!-- </form> -->
                                                    

                                                        
                                                    </td>
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

<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">Change Employee Status</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                          
                          <form class="form-horizontal" action="{{url('/updatestatus')}}" method="post" role="form" class="needs-validation" name="registration">
                            {{ csrf_field() }}   
                            <input type="hidden" name="emp_no" id="status_emp_no">
                            <div class="form-group">
                              <label>Select Status</label>
                              <select name="empStatus" id="empStatus" class="form-control" required>
                            <option value="">Select Status</option>
                        @foreach ($empstatus as $index =>$resultstatus)
                            <option value="{{$resultstatus->id}}">{{$resultstatus->status}}</option>
                         @endforeach
                         </select>
                        <div class="invalid-feedback">  
                          Please select employee current status.  
                        </div>
                            </div>
                            <div class="form-group" id="exitLayout">       
                              <label>Exit Date</label>
                              <input type="text" autocomplete="off" id="fexitDate" name="exitDate" class="form-control"> 
                            <div class="invalid-feedback">  
                          Please enter exit date.  
                        </div>
                          </div>
                            <div class="form-group">       
                              <input type="submit" value="Update" class="btn btn-primary">
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                          
                        </div>
                      </div>
                    </div>
                  </div>


<div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Job</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to remove this Job?</p>                    
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

$(document).ready(function(){
    //$('#employeeTable').DataTable();

    $('#fexitDate').datepicker({
    startDate: '-3y',
    format: 'dd/mm/yyyy',
    autoclose: true
});

    $(document).on('change','#empStatus',function(){
        if($(this).val() == "2"){
            $('#exitLayout').fadeIn();
            $("#fexitDate").prop('required',true);
        }
        else{
            $('#exitLayout').fadeOut();
            $("#fexitDate").prop('required',false);
        }
    });

    $('#employeeTable tr.thead th').each( function () {
        var title = $(this).text();
        if(title != ''){
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    }
    } );

    // DataTable
    var table = $('#employeeTable').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
    /*var table = $('#employeeTable').DataTable();*/
 
    // Apply the search
    $.each($('.select-filter', table.table().header()), function () {
    var column = table.column($(this).index());

    $( 'input', this).on( 'keyup change', function () { 
        if ( column.search() !== this.value ) {
            column
                .search( this.value )
                .draw();

        } else if ( column.search() !== "" ) {
            column
                .draw();
        }
    } );
} );   


    if($(".datatable").length > 0){                



                $(".datatable").dataTable();



                $(".datatable").on('page.dt',function () {



                    //onresize(100);



                });



            }


$(document).on('click','.editStatus',function(){
   /* var id = this.id;
    alert(id);
    status = id.split(" ");
    console.log(status[1]);*/

    var str = this.id;
  var res = str.split("-");
  console.log(res[1]);
    $('#myModal').modal('show');
    $('#status_emp_no').val(res[1]);
});



$(document).on('click','.deleteRow',function(){
    var id = this.id;
    var deleteRow = id.split("-");

    delete_row(deleteRow[1]);
});

function delete_row(row){
        //alert(row);
    /*var table = $('#employeeTable').DataTable();
    table.row('.selected').remove().draw( false );*/

    $('#'+row).addClass('selected');

        var box = $("#mb-remove-row");
        box.addClass("open");
        
        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");
            console.log(row);
            $.ajax({
                url: 'delete_employee',
                type: 'POST',
                data: {'emp_no' : row, '_token':$('input[name=_token]').val()},
                dataType: 'json',

                success: function( data ) {

                    table.row('.selected').remove().draw( false );

                    /*$("#"+row).hide("slow",function()
                    {
                    $(this).remove();
                       });*/

                }       
            })
           
        });

        box.find(".mb-control-close").on("click",function(){
                box.removeClass("open");
                $('#'+row).removeClass('selected');
        });
        
    }

});
    </script>