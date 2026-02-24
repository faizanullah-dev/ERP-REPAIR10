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
        .save-signature-btn {  margin: 0 auto 20px; }
    </style>
</head>

<body>
<section class="proposal_sec">
    <div class="container-fluid">
        <form action="{{ route('store_contractor_proposal_signature') }}" method="POST" class="row" id="proposalForm">
            @csrf
            <input type="hidden" name="proposal_template_id" value="{{ $proposals->id }}">
            <input type="hidden" name="sub_contractor_id" value="{{ $subContractorProposal->sub_contractor_id }}">
            <input type="hidden" name="lead_id" value="{{ $subContractorProposal->lead_id }}">
            <div class="col-md-12">
                <div class="theme-selection">
                    <div class="proposal-header">
                        <h3>Proposals</h3>
                        @if($subContractorProposal->created_at)
                            @php $daysLeft = 30 - $subContractorProposal->created_at->diffInDays(now(), false); @endphp
                            <p>
                                {!! $daysLeft > 0
                                    ? "Proposal expires in <strong>{$daysLeft} days</strong>"
                                    : "<strong>This proposal has expired.</strong>" !!}
                            </p>
                        @endif
                    </div>
                    <div class="proposal-options">
{{--                        @php--}}
{{--                            $filePath = public_path('website/proposal_template/' . $proposals->description);--}}
{{--                            $content = file_exists($filePath) ? file_get_contents($filePath) : '<p>File not found.</p>';--}}
{{--                        @endphp--}}
{{--                        {!! $content !!}--}}
                        {!! $finalContent !!}
{{--                        {!! $subContractorProposal->description !!}--}}

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
        var description = $('.proposal-options').html();
        $('.customer_description').val(description);
        var signatures = [];

        $('.signature-box').each(function() {
            var signatureBox = $(this);
            var signatureId = signatureBox.attr('data-id');
            var canvas = signatureBox.find('.signature-canvas')[0];

            if (canvas) {
                const dataURL = canvas.toDataURL('image/png'); // Get the signature as PNG
                signatures.push({
                    id: signatureId,
                    image: dataURL
                });
            }
        });

        if (signatures.length > 0) {
            $('#signatureData').val(JSON.stringify(signatures));
            $('#proposalForm').submit();
        } else {
            alert('No signatures found.');
        }
    });

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
