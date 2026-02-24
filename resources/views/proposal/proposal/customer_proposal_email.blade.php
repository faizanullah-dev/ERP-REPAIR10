<!DOCTYPE html>
<html>
<head>
    <title>Customer Report Link</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <style>
        .signature-card {
            max-width: 600px;
            background: #ffffff;
            display: flex;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .left-section {
            background: #1b365d;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 35%;
        }
        .left-section img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid #ffffff;
        }
        .right-section {
            padding: 20px;
            width: 65%;
        }
        .name {
            font-size: 20px;
            font-weight: bold;
            color: #000;
        }
        .position {
            color: #0073b1;
            font-size: 14px;
            font-weight: bold;
        }
        .info {
            font-size: 14px;
            color: #555;
            margin: 5px 0;
        }
        .info a {
            text-decoration: none;
            color: #0073b1;
        }
        .social-icons {
            margin-top: 10px;
        }
        .social-icons a {
            color: #1b365d;
            font-size: 18px;
            margin-right: 10px;
            text-decoration: none;
        }

        /* Email client compatibility fixes */
        @media only screen and (max-width: 600px) {
            .signature-card {
                flex-direction: column;
            }
            .left-section, .right-section {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div style="background-color: #f7f7f7; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #444; max-width: 600px; margin: 20px auto; border: 1px solid #d4d4d4; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">

    <div style="text-align: center; margin-bottom: 20px;">
        <img src="https://leadup.thebackendprojects.com/website/images/logo.png" alt="Logo" style="max-width: 100px;">
    </div>

    <p>Leadup has created the proposal.</p>

    <p>In order to complete the process, please review the information (photo and video, if applicable) through the link below.</p>

    <p>After reviewing, please read and sign the required proposal to finalized Authorization documents.
        <br><br><a href="{{ $link ?? '' }}" style="color: blue">Click here to access the proposal for review.</a><br><br></p>

    <hr style="margin: 20px 0;">

    <p>For any questions or concerns regarding your report, please contact your representative.</p>

    @include('proposal.proposal.sign')

</div>
</body>
</html>