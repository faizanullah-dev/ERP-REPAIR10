<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addJob">Edit Check In</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="{{ route('update_checkin') }}" method="post" id="clock_form">
                <input type="hidden" name="clock_id" value="{{ $userCheckIn->id??'' }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Date</label>
                            <div class="form-group">
                                <input type="date" name="date" class="form-control" value="{{ $userCheckIn->date??"" }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Check In</label>
                            <div class="form-group">
                                <input type="time" id="check_in" name="check_in" class="form-control" value="{{  \Carbon\Carbon::parse($userCheckIn->check_in ?? '')->format('H:i') }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Check Out</label>
                            <div class="form-group">
                                <input type="time" id="check_out" name="check_out" class="form-control" value="{{  \Carbon\Carbon::parse($userCheckIn->check_out ?? '')->format('H:i') }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Total Hours</label>
                            <div class="form-group">
                                <input type="text" id="total_hours" name="total_hours" class="form-control" value="{{ $userCheckIn->total_hours ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-4 mt-5">
                            <div class="form-group">
                                <div class=" d-flex justify-content-center ">
                                    <button class="btn green_btn borderRadius" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        // Listen for changes in check_in and check_out fields
        $('#check_in, #check_out').on('change', function () {
            calculateTotalHours();
        });

        function calculateTotalHours() {
            const checkInTime = $('#check_in').val();
            const checkOutTime = $('#check_out').val();

            if (checkInTime && checkOutTime) {
                // Convert time strings to Date objects
                const checkInDate = new Date(`1970-01-01T${checkInTime}:00`);
                const checkOutDate = new Date(`1970-01-01T${checkOutTime}:00`);

                // Calculate the difference in milliseconds
                let diffInMs = checkOutDate - checkInDate;

                // Handle cases where check-out is on the next day (e.g., night shift)
                if (diffInMs < 0) {
                    checkOutDate.setDate(checkOutDate.getDate() + 1);
                    diffInMs = checkOutDate - checkInDate;
                }

                // Convert milliseconds to hours, minutes, and seconds
                const diffInSeconds = Math.floor(diffInMs / 1000);
                const hours = Math.floor(diffInSeconds / 3600);
                const minutes = Math.floor((diffInSeconds % 3600) / 60);
                const seconds = diffInSeconds % 60;

                // Format as HH:MM:SS
                const formattedTime = `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;

                // Update the total_hours field
                $('#total_hours').val(formattedTime);
            } else {
                $('#total_hours').val(''); // Clear the field if either time is missing
            }
        }

        // Helper function to pad numbers with leading zeros
        function pad(value) {
            return value < 10 ? `0${value}` : value;
        }
    });
</script>