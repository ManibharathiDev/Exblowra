@include('inc/header')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">All Job</li>
  </ol>
</nav>



<div class="">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive" style="
    overflow: hidden;
">
                                        <!-- <table id="example" class="table datatable table-striped table-bordered dt-responsive nowrap"> -->
                                            <table id="jobTable" class="datatable table table-bordered table-striped dataTable" style="width: 100%;">

                                        	<thead class="">
                                                <tr class="thead">
                                                	<th></th>
                                                    <th class="select-filter">Job</th>
                                                   
                                                    <th></th>
                                                    
                                                </tr>
                                                <tr>
                                                	<th>#</th>
                                                	<th>Job</th>
													<th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i=1;
                                                ?>
                                                @foreach ($results as $index =>$result)                                            
                                                <tr id="<?php echo $result->job_id ?>">
                                                    <td><?php echo $i++;?></td>
                                                    <td><strong>{{ $result->job_name }}</strong></td>
                                                    
                                                      
                                                      <td>
                                                      	{{csrf_field()}}
                                                            <button class="btn btn-default btn-rounded btn-condensed btn-sm">
                                                    <a href="editjob/<?php echo $result->job_id ?>"><span class="fa fa-pencil"></span></a></button>
                                                        <input type="hidden" name="job_no" value="{{$result->job_id}}">
                                                        <button class="btn btn-danger btn-rounded btn-condensed btn-sm deleteRow" id="delete-{{$result->job_id}}"><span class="fa fa-times"></span></button>
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

    $('#jobTable tr.thead th').each( function () {
        var title = $(this).text();
        if(title != ''){
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    }
    } );

    // DataTable
    var table = $('#jobTable').DataTable( {
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
                url: 'delete_job',
                type: 'POST',
                data: {'job_no' : row, '_token':$('input[name=_token]').val()},
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