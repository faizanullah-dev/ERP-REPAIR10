<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Rajdhani-Semibold';
            src: url('../../../../../website/fonts/rajdhani/Rajdhani-SemiBold.ttf');
        }

        /* .proposal_sec .ui-draggable { pointer-events: none; }*/
        /*.proposal_sec .signature-box {pointer-events:auto;}*/
        .green_btn { background-color: #74c911; color: #fff; border: none !important; display: flex; padding: 10px 20px; justify-content: center; align-items: center; gap: 10px; border-radius: 4px; box-shadow: 0px 2px 25px 0px rgba(0, 0, 0, 0.05); width: fit-content; font-size: 14px; font-family: "Rajdhani-Semibold"; }
        .save-signature-btn { margin: 0 auto 20px; }
    </style>
</head>

<body>
<section class="proposal_sec">
    <div class="container-fluid">
        <form action="{{ route('store_customer_proposal_signature') }}" method="POST" class="row" id="proposalForm">
            @csrf
            <input type="hidden" name="proposal_id" value="{{ $proposals->id }}">
            <input type="hidden" name="proposal_template_id" value="{{ $proposals->proposal_template_id }}">
            <input type="hidden" name="lead_id" value="{{ $proposals->lead_id }}">

            <div class="col-md-12">
                <div class="theme-selection">
                    <div class="proposal-header">
                        <h3>Proposals</h3>
                        @if($proposals->created_at)
                            @php $daysLeft = 30 - $proposals->created_at->diffInDays(now(), false); @endphp
                            <p>
                                {!! $daysLeft > 0
                                    ? "Proposal expires in <strong>{$daysLeft} days</strong>"
                                    : "<strong>This proposal has expired.</strong>" !!}
                            </p>
                        @endif
                    </div>
                    <div class="proposal-options">
                        {{--                        @php--}}
                        {{--                            $filePath = public_path('website/' . $proposals->description);--}}
                        {{--                            $content = file_exists($filePath) ? file_get_contents($filePath) : '<p>File not found.</p>';--}}
                        {{--                        @endphp--}}
                        {{--                        {!! $content !!}--}}
                        @php
                            $customerPath = public_path('website/' . $proposals->description);
                            $subcontractorPath = public_path('website/proposal_template/' . $proposals->description);

                            Log::info('Customer Path: ' . $customerPath);
                            Log::info('Subcontractor Path: ' . $subcontractorPath);

                            $customerContent = file_exists($customerPath) ? file_get_contents($customerPath) : '<p>Customer file not found.</p>';
                            $subcontractorContent = file_exists($subcontractorPath) ? file_get_contents($subcontractorPath) : '<p>Subcontractor file not found.</p>';
                        @endphp

                        @if(request()->route()->getName() == 'customer_proposal_view' && request()->route('id') == $proposals->id)
                            {!! $customerContent !!}
                        @else
                            {!! $subcontractorContent !!}
                        @endif
                    </div>
                    <input type="hidden" name="signatureData" value="" id="signatureData">
                    <input type="hidden" name="description" class="customer_description">
                    <div class="bottom_btns">
                        <button type="submit" class="btn green_btn save-signature-btn">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('.remove-btn').remove();
        $('.ui-resizable-handle').remove();
        $('*').removeClass('ui-draggable ui-draggable-handle ui-resizable');
        $('[contenteditable]').removeAttr('contenteditable');
        $('.edit_image').remove();

        // Flash message handling with Swal
        @if(session()->has('flash_message'))
        Swal.fire({
            title: "{{ ucwords(preg_replace('/(?<!\ )[A-Z]/', ' $0', session()->get('flash_message')))}}",
            icon: "{{ session()->get('type') ?? 'success' }}",
            timer: 2000,
            showConfirmButton: false,
        });
        @endif

        $('.checkbox-container input[type="checkbox"]').prop('disabled', false);
        if ($('.signature-canvas').length) {
            $('.signature-canvas').each(function () {
                initializeCanvas(this);
            });
        }
    });

    function initializeCanvas(canvas) {
        const ctx = canvas.getContext('2d');
        canvas.width = canvas.clientWidth;  // Use clientWidth for better consistency
        canvas.height = canvas.clientHeight; // Use clientHeight for better consistency

        // Check if there's an existing signature and set it as the background image of the canvas
        const signatureImage = "{{ asset('website/customer_proposal_signature') }}/{{ $proposal->signature ?? '' }}";
        if (signatureImage !== "{{ asset('website/customer_proposal_signature') }}/") {
            const img = new Image();
            img.src = signatureImage;
            img.onload = function () {
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);  // Draw the image on the canvas
            };
        }

        let isDrawing = false;
        let lastX = 0;
        let lastY = 0;

        function startDrawing(e) {
            isDrawing = true;
            [lastX, lastY] = [e.offsetX, e.offsetY];
        }

        function stopDrawing() {
            isDrawing = false;
        }

        function draw(e) {
            if (!isDrawing) return;
            ctx.strokeStyle = '#000';
            ctx.lineWidth = 2;
            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();
            [lastX, lastY] = [e.offsetX, e.offsetY];
        }

        // Event listeners for signature drawing
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mousemove', draw);
    }

    $(document).on('click', '.clear-signature-btn', function() {
        const canvas = $(this).siblings('.signature-canvas')[0];
        if (canvas) {
            const ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }
    });

    $(document).on('click', '.save-signature-btn', function(e) {
        e.preventDefault();

        // Save proposal description
        var description = $('.proposal-options').html();
        $('.customer_description').val(description);

        // Collect all signature canvases
        var signatures = [];

        $('.signature-canvas').each(function(index) {
            var canvas = this;
            var signatureBox = $(this).closest('.signature-box'); // Parent container with data-id
            var signatureId = signatureBox.data('id') || `signature_${index}`; // Fallback ID

            if (canvas && canvas.toDataURL) {
                if (!isCanvasBlank(canvas)) {
                    var dataURL = canvas.toDataURL('image/png');
                    signatures.push({
                        id: signatureId,
                        image: dataURL
                    });
                }
            }
        });

        // Submit if at least one signature exists
        if (signatures.length > 0) {
            $('#signatureData').val(JSON.stringify(signatures));
            $('#proposalForm').submit();
        } else {
            alert('No valid signatures found.');
        }
    });


    // Helper function to check if canvas is blank
    function isCanvasBlank(canvas) {
        const blank = document.createElement('canvas');
        blank.width = canvas.width;
        blank.height = canvas.height;
        return canvas.toDataURL() === blank.toDataURL();
    }


    // Checkbox handling
    $(document).on('change', '.custom-checkbox', function() {
        console.log('Checkbox clicked');
        if ($(this).prop('checked')) {
            $(this).attr('checked', 'true');
        } else {
            $(this).removeAttr('checked');
        }
        console.log('Checked:', $(this).prop('checked'));
        console.log('Data Attribute:', $(this).attr('checked'));
    });

</script>
</body>
</html>
