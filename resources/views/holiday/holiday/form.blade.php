@extends('layouts.master')
@push('css')
    <link href="{{ asset('plugins/components/calendar/dist/fullcalendar.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .filter_inputs_btns_wrapper .filter_btns_parent { display: flex; align-items: end; }
    </style>
@endpush
@section('content')
    <section class="calender">
        <div class="white-box  position-relative">
            <div class="clearfix"></div>
            <br>
            <div class="container-fluid d-block">
                <div class="row">
                    <div class="col-md-12 p-2">
                        <div class="inner">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <button id="saveDates" class="btn btn-primary">Save Dates</button>
        </div>
    </section>
@endsection
@push('js')
    <script src="{{ asset('plugins/components/calendar/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/components/moment/moment.js') }}"></script>
    <script src="{{ asset('plugins/components/calendar/dist/fullcalendar.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            var selectedDates = {!! isset($selectedDates) ? json_encode($selectedDates) : '[]' !!};
            $('#calendar').fullCalendar({
                @if(App\CommonSetting::first()->calendar == 1)
                firstDay: 1,
                @elseif(App\CommonSetting::first()->calendar == 2)
                hiddenDays: [0, 6],
                @elseif(App\CommonSetting::first()->calendar == 3)
                firstDay: 0,
                @endif
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,agendaDay'
                },
                defaultView: 'month',
                selectable: true,
                selectHelper: true,
                views: {
                    month: {
                        showNonCurrentDates: false,
                        fixedWeekCount: false
                    }
                },
                select: function(start) {
                    var dateString = moment(start).format('YYYY-MM-DD');
                    var dateCell = $('td[data-date="' + dateString + '"]');

                    if (selectedDates.includes(dateString)) {
                        selectedDates = selectedDates.filter(date => date !== dateString);
                        dateCell.css('background-color', '');
                    } else {
                        selectedDates.push(dateString);
                        dateCell.css('background-color', '#74C911');
                    }

                    $('#calendar').fullCalendar('unselect');
                },
                dayRender: function(date, cell) {
                    var dateString = moment(date).format('YYYY-MM-DD');

                    if (selectedDates && selectedDates.includes(dateString)) {
                        cell.css('background-color', '#74C911');
                    }
                }
            });
            $('#calendar').on('click', 'td.fc-day', function() {
                var dateString = $(this).data('date');
                if (selectedDates.includes(dateString)) {
                    selectedDates = selectedDates.filter(date => date !== dateString);
                    $(this).css('background-color', '');
                } else {
                    selectedDates.push(dateString);
                    $(this).css('background-color', '#74C911');
                }
            });
            $('#saveDates').on('click', function() {
                var name = 'Holiday Name';
                var status = '1';
                $.ajax({
                    url: '/holiday/holiday',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        status: status,
                        date: selectedDates.join(',')
                    },
                    success: function(response) {

                        // console.log("Response received:", response);
                        window.location.href = '/holiday/holiday';
                    },
                    error: function(xhr) {
                    }
                });
            });
        });
    </script>
@endpush