<div class="modal fade" id="scheduleEmailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Schedule Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="scheduleEmailForm" method="POST" action="{{url('subContractorRecurringEmail/sub-contractor-recurring-email')}}">
                @csrf
                <input type="hidden" name="subcontractor_id" id="emailSubcontractorId">
                <input type="hidden" name="insurance_type" id="emailInsuranceType">
                <input type="hidden" name="expiry_date" id="emailExpiryDate">

                <div class="modal-body">
                    <div id="scheduleItemsContainer">
                        @if($data->count() > 0)
                            @foreach($data as $index => $schedule)
                                <div class="schedule-item mb-3 border p-3">
                                    <input type="hidden" name="schedule[{{ $index }}][id]" value="{{ $schedule->id }}">
                                    <div class="mb-3">
                                        <label class="form-label">No. of Days Before</label>
                                        <input class="form-control" type="number" min="1"
                                               name="schedule[{{ $index }}][days_before]"
                                               value="{{ $schedule->no_of_days_before }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email Template</label>
                                        <select class="form-control select_modals_global_initialize" data-placeholder="Select Email Template" name="schedule[{{ $index }}][email_template]" required>
                                            @foreach($emailTemplates as $template)
                                                <option value="{{ $template->id }}" {{ $schedule->email_template_id == $template->id ? 'selected' : '' }}>
                                                    {{ $template->title ?? '' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger remove_schedule_email  delete-scheduled-email {{ $loop->first && $data->count() <= 1 ? 'd-none' : '' }}" data-id="{{$schedule->id}}">Remove</button>
                                </div>
                            @endforeach
                        @else
                        <div class="schedule-item mb-3 border p-3">
                            <div class="mb-3">
                                <label class="form-label">No. of Days Before</label>
                                <input class="form-control" type="number" min="1" name="schedule[0][days_before]" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Template</label>
                                <select class="form-control select_modals_global_initialize" data-placeholder="Select Email Template" name="schedule[0][email_template]" required>
                                    @foreach($emailTemplates as $template)
                                        <option value="{{$template->id}}">{{$template->title??''}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" class="btn btn-sm btn-danger remove_schedule_email remove-item d-none">Remove</button>
                        </div>
                        @endif
                    </div>

                    <button type="button" id="addMoreSchedule" class="btn add_schedule_email btn-sm btn-primary mt-2 mb-2">Add More</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary save_email_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@php
    $emailTemplates = App\EmailTemplate::all();
@endphp
<script>
    window.emailTemplates = @json($emailTemplates);
</script>
<script>
    $(document).ready(function() {

        $('.select_modals_global_initialize').select2({
            allowClear: true,
            placeholder: function(){
                return $(this).data('placeholder') || '';
            },
            dropdownParent: $('#scheduleEmailModal')
        });

        let itemCount = {{$data->count()}}; // Start from 1 since we already have one item

        function getTemplateOptions() {
            let options = '<option value=""></option>';
            window.emailTemplates.forEach(template => {
                options += `<option value="${template.id}">${template.title}</option>`;
            });
            return options;
        }

        // Add more schedule items
        $('#addMoreSchedule').click(function() {
            if(itemCount == 0){
                itemCount = 1;
            }
            const newItem = `
            <div class="schedule-item mb-3 border p-3">
                <div class="mb-3">
                    <label class="form-label">No. of Days Before</label>
                    <input class="form-control" type="number" min="1" name="schedule[${itemCount}][days_before]" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email Template</label>
                    <select class="form-control select_modals_global_initialize" data-placeholder="Select Email Template" name="schedule[${itemCount}][email_template]" required>
                        <option value="" selected disabled>Select Email Template</option>
                        ${getTemplateOptions()}
                        <!-- Add your template options here -->
            </select>
            </div>
            <button type="button" class="btn btn-sm btn-danger remove_schedule_email remove-item">Remove</button>
            </div>
            `;

            $('#scheduleItemsContainer').append(newItem);
            itemCount++;

            if (itemCount > 1) {
                $('.schedule-item .remove-item').removeClass('d-none');
            }
            $('.select_modals_global_initialize').select2({
                allowClear: true,
                placeholder: function(){
                    return $(this).data('placeholder') || '';
                },
                dropdownParent: $('#scheduleEmailModal')
            });
        });

        $(document).on('click', '.remove-item', function() {
            $(this).closest('.schedule-item').remove();
            itemCount--;

            if (itemCount <= 1) {
                $('.schedule-item .remove-item').addClass('d-none');
            }

            $('.schedule-item').each(function(index) {
                $(this).find('input, select').each(function() {
                    const name = $(this).attr('name').replace(/\[\d+\]/, '[' + index + ']');
                    $(this).attr('name', name);
                });
            });
        });
        $(document).on('click', '.delete-scheduled-email', function() {
            var id = $(this).data('id');
            var $item = $(this).closest('.schedule-item');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url("delete_recurring_email_schedule") }}',
                        method: 'GET',
                        data: { id: id },
                        success: function(response) {
                            if(response.message === 'success') {
                                Swal.fire('Deleted!', 'The schedule has been removed', 'success');
                                $item.remove();
                                itemCount--;

                                if (itemCount <= 1) {
                                    $('.schedule-item .remove-item').addClass('d-none');
                                }

                                $('.schedule-item').each(function(index) {
                                    $(this).find('input, select').each(function() {
                                        const name = $(this).attr('name').replace(/\[\d+\]/, '[' + index + ']');
                                        $(this).attr('name', name);
                                    });
                                });
                            } else {
                                Swal.fire('Error!', 'Something Went Wrong', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
