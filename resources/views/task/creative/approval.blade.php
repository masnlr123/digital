@extends('layouts.app') @section('content')
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Approval Process - &nbsp;<strong style="color: #FF9800;">{{ $creative_task->task_name }}</strong>
            </h3>
        </div>
    </div>
</div>

<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<div class="kt-portlet">
								<div class="kt-portlet__body kt-portlet__body--fit">

									<form id="approval_form" enctype="multipart/form-data" method="post" action="{{ route('approval_update_creative_task', $task_id) }}">

    @csrf
    {{ method_field('PUT') }}
    <div>
    	@foreach($creatives as $creative)
    	<?php
$creative_name = str_replace('_', ' ', $creative->name);
$creative_name = str_replace('-', ' ', $creative_name);
$creative_name = str_replace('.jpg', ' ', $creative_name);
$creative_name = str_replace('.png', ' ', $creative_name);
$creative_name = str_replace('.gif', ' ', $creative_name);
$creative_name = ucfirst($creative_name);
?>
        <h3 class="creative-head"></h3>
        <section>
        	<h4>{{ $creative_name }}</h4>
			<div class="form-group creative-approval-dis">
				<img src="<?php echo url($creative->location); ?>" alt="Craetives">
				<p class="text-left mt-4"><strong>Re-Approval Notes:</strong> {{ $creative->reapproval_notes? $creative->reapproval_notes : '-- NIL --' }}</p>
			</div>


            @php
            $old_creatives = App\CreativeImages::where('creative_id', $task_id)->where('order_id', $creative->order_id)->where('status', '0')->get();
            @endphp
            @if($old_creatives->count() > 0)
            <hr>
            <div class="col-md-8 offset-2">
            <h4>All Changes Logs</h4>
            @foreach($old_creatives as $old_creative)
            <div class="row mt-4">
                <div class="col-md-3">
                    <a href="{{ url($old_creative->location) }}" target="_blank"><img src="{{ url($old_creative->location) }}" alt="Old Creative" class="img-thumbnail img-fluid" /></a>
                </div>
                <div class="col-md-9">
                    <div class="current_creative_status_2 text-left">
                        <p><strong>Creative Comment:</strong> {{ $old_creative->comment? $old_creative->comment : '-- NIL --' }}</p>
                        <p><strong>Re-Approval Notes:</strong> {{ $old_creative->reapproval_notes? $old_creative->reapproval_notes : '-- NIL --' }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
            @endif
<div class="row">
	<div class="col-md-6">
		<input id="approval_notes_{{ $creative->id}}" type="text" class="form-control approval_review_input" name="{{ $creative->id}}_comment" placeholder="Enter Your Correction Details" style="margin: 15px auto 0;">
	</div>
	<div class="col-md-6">
				<div class="kt-radio-inline approval-buttons">
					<label class="kt-radio">
						<input type="radio" class="btn_approval required" name="id{{ $creative->id}}_approval" value="review_update">Review Update
						<span></span>
					</label>
					<label class="kt-radio">
						<input type="radio" class="btn_approval required" name="id{{ $creative->id}}_approval" value="approved"> Approved
						<span></span>
					</label>
				</div>
	</div>
</div>
        </section>
        @endforeach
    </div>
</form>
								</div>
							</div>
						</div>

						<!-- end:: Content -->
@endsection


@section('header_css')
	<link href="{{ asset('assets/css/steps/jquery.steps.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/steps/main.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('footer_js')
<script>
$('.approval_review_input').hide();
  $(function(){
  $('.btn_approval').click(function(){
    if ($(this).is(':checked'))
    {
      if($(this).val() === 'review_update'){
      	$('.approval_review_input').show();
      	$('.approval_review_input').addClass('required');
      }
      else if($(this).val() === 'approved'){
      	$('.approval_review_input').removeClass('required');
       	$('.approval_review_input').hide();
      }
      else{
       	$('.approval_review_input').hide();
      }
    }
  });
});
	
</script>

 <script src="{{ asset('assets/js/pages/jquery.steps.js') }}" type="text/javascript"></script>

<script type="text/javascript">
var form = $("#approval_form");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        confirm: {
            equalTo: "#password"
        }
    }
});
form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
    	var task_id = <?php echo $task_id; ?>;
        $.ajax(
        {
            url: "{{ url('/task/creative/approval_update/') }}/"+task_id,
            type: 'put', // replaced from put
            dataType: "JSON",
            data: $("#approval_form").serialize(),
            success: function (response)
            {
                swal.fire({
                    title: 'Approved!',
                    text: "The Creative Image has been approved Successfuly!",
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'OK!'
                }).then(function(result) {
                    if (result.value) {
                        window.location = "<?php echo route('task_creative_index'); ?>";
                    }
                });
                
            },
            error: function(xhr) {
                 console.log(xhr.responseText);
            }
        });
        // alert("Submitted!");
    }
});

</script>
@endsection