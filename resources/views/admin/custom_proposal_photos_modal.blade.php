<div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Lead Photos</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
    <form method="POST" action="{{url('update_job_insurance_for_lead')}}/{{$lead->id}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                @forelse($photos as $photo)
                    <div class="col-md-6 mb-3">
                        <img data-id={{ $photo->id }} src="{{ asset('website') }}/{{ $photo->name }}" class="w-100 h-100">
                    </div>
                @empty
                    <div class="col-md-12">
                        <p>No photos found</p>
                    </div>
                @endforelse
            </div>
            <div class="col-md-12 m-t-20">
                <div class="form-group  ">
                    <div class="d-flex justify-content-space-between  ">
                        <button class="btn green_btn borderRadius" type="submit">Submit</button>
                        <a class="btn m-l-5 borderRadius btn-close right_canvas_cancelBtn " data-bs-dismiss="offcanvas"  style=" background: none;" aria-label="Close" >Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#insuranceCompany').change(function() {
            var companyId = $(this).val();

            // AJAX request
            $.ajax({
                url: "{{url('get_company_detail')}}", // Replace with your endpoint URL
                method: 'GET',
                data: {
                    companyId: companyId,
                },
                success: function(response) {
                    $('#phone_insurance').val(response.phone ?? '')
                    $('#Email').val(response.email ?? '')
                    $('#contractSignedDate').val(response.insurance_start ?? '')
                    $('#dateLoss').val(response.insurance_expire ?? '')


                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>