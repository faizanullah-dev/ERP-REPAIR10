<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('year') ? 'has-error' : ''}}">
            <label for="year" class="control-label">{{ 'Year' }}</label>
                <select class="form-control select2 borderRadius" name="year" required>
                    <option value="">None</option>
                    @foreach($yearEstimations as $yearEstimation)
                        <option value="{{$yearEstimation->year}}" @if(isset($advertisement) && $yearEstimation->year == $advertisement->year) selected @endif>{{$yearEstimation->year}}</option>
                    @endforeach
                </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('year') ? 'has-error' : ''}}">
            <label for="year" class="control-label">{{ 'Months' }}</label>
                <select class="form-control select2 borderRadius month" name="month" required>
                    <option value="" selected>None</option>
                    <option value="january" {{ isset($advertisement) && $advertisement->month == 'january' ? 'selected' : '' }}>January</option>
                    <option value="february" {{ isset($advertisement) && $advertisement->month == 'february' ? 'selected' : '' }}>February</option>
                    <option value="march" {{ isset($advertisement) && $advertisement->month == 'march' ? 'selected' : '' }}>March</option>
                    <option value="april" {{ isset($advertisement) && $advertisement->month == 'april' ? 'selected' : '' }}>April</option>
                    <option value="may" {{ isset($advertisement) && $advertisement->month == 'may' ? 'selected' : '' }}>May</option>
                    <option value="june" {{ isset($advertisement) && $advertisement->month == 'june' ? 'selected' : '' }}>June</option>
                    <option value="july" {{ isset($advertisement) && $advertisement->month == 'july' ? 'selected' : '' }}>July</option>
                    <option value="august" {{ isset($advertisement) && $advertisement->month == 'august' ? 'selected' : '' }}>August</option>
                    <option value="september" {{ isset($advertisement) && $advertisement->month == 'september' ? 'selected' : '' }}>September</option>
                    <option value="october" {{ isset($advertisement) && $advertisement->month == 'october' ? 'selected' : '' }}>October</option>
                    <option value="november" {{ isset($advertisement) && $advertisement->month == 'november' ? 'selected' : '' }}>November</option>
                    <option value="december" {{ isset($advertisement) && $advertisement->month == 'december' ? 'selected' : '' }}>December</option>
                </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('year') ? 'has-error' : ''}}">
            <label for="year" class="control-label">{{ 'Monthly Budget' }}</label>
            <input class="form-control monthly_budget" name="monthly_budget" type="text" value="{{ $advertisement->monthly_budget ?? '' }}" readonly>
        </div>
    </div>
</div>
<div id="dynamicRows">
    @if(isset($advertisement) && $advertisement)
            @foreach($advertisement->monthlyAdvertisement as $index => $month)
            <div id="dynamicRows">
                <div class="row" >
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="control-label">{{ 'Referral Source' }}</label>
                            <select class="form-control  borderRadius select2" name="referral_source[id][]" required>
                                @foreach($referral_sources as $referral_source)
                                    <option value="{{ $referral_source->id }}" @if(isset($month) && $referral_source->id == $month->referral_source_id) selected @endif>{{ $referral_source->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="control-label">{{ 'Price' }}</label>
                            <input class="form-control month_price" min="0" name="referral_source[price][]" type="number" value="{{ $month->price ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="form-group">
{{--                                @if($index === 0)--}}
{{--                                    <button class="btn btn-primary addRowBtn" type="button"><i class="fa-solid fa-plus"></i> {{ __('Add') }}</button>--}}
{{--                                @else--}}

                                    <button class="btn btn-danger removeRowBtn" Advertisement-Id={{ $month->id }} type="button"><i class="fa fa-minus"></i> Remove</button>

                            {{--                                @endif--}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    @else
        <div id="dynamicRows">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label">{{ 'Referral Source' }}</label>
                        <select class="form-control  borderRadius select2" name="referral_source[id][]" required>
                            <option value="">None</option>
                            @foreach($referral_sources as $referral_source)
                                <option value="{{$referral_source->id}}" >{{$referral_source->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label">{{ 'Price' }}</label>
                            <input class="form-control month_price" min="0" name="referral_source[price][]" type="number" value="{{ $referral_source->price ?? '' }}" required>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <div class="form-group">
{{--                            <button class="btn btn-primary addRowBtn" type="button"><i class="fa-solid fa-plus"></i> Add</button>--}}
                            <button class="btn btn-danger removeRowBtn" type="button" disabled><i class="fa fa-minus"></i> Remove</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary addRowBtn" type="button"><i class="fa fa-plus"></i> Add</button>
    </div>
    <div class="col-md-12 mt-3 d-flex justify-content-center">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#advertisement_form').validate({
                rules: {
                    year: "required",
                    month: "required",
                    'referral_source[id][]': "required",
                    'referral_source[price][]': "required"
                },
                messages: {
                    month: "Please select month",
                    year: "Please select year",
                    'referral_source[id][]': "Please select the referral source",
                    'referral_source[price][]': "Please enter price"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            $('.addRowBtn').click(function() {
                var newRow =
                    '<div class="row">' +
                    '<div class="col-md-5">' +
                    '<div class="form-group">' +
                    '<label class="control-label">{{ 'Referral Source' }}</label>' +
                    '<select class="form-control  borderRadius select2" name="referral_source[id][]" required>' +
                    '<option value="">None</option>' +
                    '@foreach($referral_sources as $referral_source)' +
                    '<option value="{{$referral_source->id}}">{{$referral_source->name}}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-5">' +
                    '<div class="form-group">' +
                    '<label class="control-label">{{ 'Price' }}</label>' +
                    '<input class="form-control month_price" min="0" name="referral_source[price][]" type="number" value="{{ $advertisement->price ?? '' }}" required>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-2 d-flex align-items-end">' +
                    '<div class="form-group">' +
                    '<button class="btn btn-danger removeRowBtn" type="button"><i class="fa fa-minus"></i> Remove</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $('#dynamicRows').append(newRow);
                $('#advertisement_form').validate();
                updateBtnRemoveState();
            });
            function updateBtnRemoveState() {
                if (newRow === 1) {
                    $('#dynamicRows .removeRowBtn').prop('disabled', false);
                } else {
                    $('#dynamicRows .removeRowBtn').prop('disabled', true);
                }
            }
            $(document).on('click', '.removeRowBtn', function() {
                var row = $(this).closest('.row');
                // var referral_id = $(this).attr('Advertisement-Id');
                {{--if (referral_id) {--}}
                {{--    $.ajax({--}}
                {{--        url: "{{ url('delete_monthly_advertisement') }}",--}}
                {{--        type: "POST",--}}
                {{--        data: {--}}
                {{--            _token: "{{ csrf_token() }}",--}}
                {{--            referral_id: referral_id--}}
                {{--        },--}}
                {{--        success: function(response) {--}}
                {{--            row.remove();--}}
                {{--            updateMonthlyBudget();--}}
                {{--        },--}}
                {{--        error: function(xhr, status, error) {--}}
                {{--            console.error(xhr.responseText);--}}
                {{--        }--}}
                {{--    });--}}
                {{--} else {--}}
                {{--    --}}
                {{--    updateMonthlyBudget();--}}
                {{--}--}}
                    row.remove();
                    updateMonthlyBudget();
            });
            $(document).on('input', '.month_price', function() {
                updateMonthlyBudget();
            });
            function updateMonthlyBudget() {
                var total = 0;
                $('.month_price').each(function() {
                    total += parseFloat($(this).val() || 0);
                });
                $('.monthly_budget').val(total.toFixed(2));
            }//end of updateMonthlyBudget
            $('.month_price').trigger('input');
            var monthlyBudget = "{{ $advertisement->monthly_budget ?? '' }}";
            if (monthlyBudget !== '') {
                $('.monthly_budget').val(monthlyBudget);
            } else {
                $('.monthly_budget').val('');
            }
        });
    </script>


    <script>
        // Get all input elements of type number
        const numberInputs = document.querySelectorAll('input[type=number]');

        // Iterate over each input element
        numberInputs.forEach(input => {
            // Add event listener for input change
            input.addEventListener('input', function() {
                // Check if the input value is negative
                if (this.value < 0) {
                    // If negative, set the value to empty
                    this.value = '';
                }
            });
        });
    </script>
@endpush
