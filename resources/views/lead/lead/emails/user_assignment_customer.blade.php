<!DOCTYPE html>
<html>
<head></head>
<body>
<p>Your lead is assigned to <strong>{{ $staffName }}</strong>.</p>

<h4>Job Details:</h4>
<p>Stage: {{$lead->getStage->name??'-'}}</p>
<p>Job Name: {{$lead->title}}</p>
<p>Job Id: {{$lead->lead_number}}</p>
<p>Job Start Date: {{$lead->lead_date}}</p>
<p>Category: {{$lead->category->name??'-'}}</p>
<p>Job Address: {{$lead->address}}</p>

<br><br>
<p>Click the button below to view details and next steps:</p>

<a href="{{ $leadUrl }}" class="btn btn-primary">
    View Lead
</a>
</body>
</html>