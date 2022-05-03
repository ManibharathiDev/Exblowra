@include('inc/header')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">All Project</li>
  </ol>
</nav>

<div class="">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive" style="
    overflow: scroll;
">
                                        <!-- <table id="example" class="table datatable table-striped table-bordered dt-responsive nowrap"> -->
                                            <table id="projectTable" class="datatable table table-bordered table-striped dataTable" style="width: 100%;">

                                        	<thead class="">
                                                <tr class="thead">
                                                	<th></th>
                                                    <th class="select-filter">Project</th>
                                                    <th class="select-filter">Client</th>
                                                    <th></th>
                                                    <th class="select-filter">Phone Number</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                	<th>#</th>
                                                	<th>Project</th>
                                                	<th>Client</th>
													<th>Contact Person</th>
													<th>Phone Number</th>
													<th>Location</th>
													<th>Normal Hours</th>
													<th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i=1;
                                                ?>
                                                @foreach ($results as $index =>$result)                                            
                                                <tr id="<?php echo $result->project_id ?>">
                                                    <td><?php echo $i++;?></td>
                                                    <td><strong><a href="viewproject/{{ $result->project_id }}">{{ $result->project_name }}</a></strong></td>
                                                    <td>{{ $result->client_name }}</td>
                                                    <td>{{ $result->contact_person }}</td>
                                                      <td>{{ $result->phone_number }}</td>
                                                      <td>{{ $result->location }}</td>
                                                      <td>{{ $result->normal_hours }}</td>
                                                      <td>
                                                      	{{csrf_field()}}
                                                            <button class="btn btn-default btn-rounded btn-condensed btn-sm">
                                                    <a href="editproject/<?php echo $result->project_id ?>"><span class="fa fa-pencil"></span></a></button>
                                                        <input type="hidden" name="project_no" value="{{$result->project_id}}">
                                                        <button class="btn btn-danger btn-rounded btn-condensed btn-sm deleteRow" id="delete-{{$result->project_id}}"><span class="fa fa-times"></span></button>
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


<div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Project</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to remove this Project?</p>                    
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

    $('#projectTable tr.thead th').each( function () {
        var title = $(this).text();
        if(title != ''){
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    }
    } );

    // DataTable
    var table = $('#projectTable').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: false
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
                url: 'delete_project',
                type: 'POST',
                data: {'project_no' : row, '_token':$('input[name=_token]').val()},
                dataType: 'json',

                success: function( data ) {

                    table.row('.selected').remove().draw( false );
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