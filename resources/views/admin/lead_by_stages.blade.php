@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box lead_lead_page my_lead_parent">
                    <h5>Leads ({{ $stage->name ?? '' }})</h5>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table aligned_table" class="myTable" id="myTable">
                            <thead>
                                <tr>
                                    <th class="image">image</th>
                                    <th>Lead Number</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Customer</th>
                                    <th>Representative</th>
                                    <th>Category</th>
                                    <th>Address</th>
                                    <th>Lead Status</th>
                                    <th class="action">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($leadByStages as $item)
                                    <tr class="lead_check">

                                        <td class="aligning_table_images">
                                            {{--                                        @php --}}
                                            {{--                                            $totalDocuments = count($item->getphotoandDocument->getDocuments); --}}
                                            {{--                                            $displayed = 0; --}}
                                            {{--                                        @endphp --}}
                                            {{--                                        @if ($totalDocuments == 0) --}}
                                            {{--                                            <img src="{{ asset('/website/images').'/by_default_two.png' }} " style="width: 80px; height: 80px; border-radius: 50%;"> --}}
                                            {{--                                        @else --}}
                                            {{--                                            @foreach ($item->getphotoandDocument as $photoAndDocument) --}}
                                            {{--                                                @foreach ($photoAndDocument->getDocuments as $document) --}}
                                            {{--                                                    @if ($displayed < 1) --}}
                                            {{--                                                        @if (isset($document->name) && in_array(array_reverse(explode('.', $document->name))[0], ['jpg', 'jpeg', 'pjpeg', 'png', 'x-png', 'gif', 'x-shockwave-flash'])) --}}
                                            {{--                                                            <img src="{{ asset('website') }}/{{$document->name}}" style="width: 80px; height: 80px; border-radius: 50%;"> --}}
                                            {{--                                                        @elseif(isset($document->name) && in_array(array_reverse(explode('.', $document->name))[0], ['pdf'])) --}}
                                            {{--                                                            <img src="{{ asset('/website/images').'/pdf.png' }}" style="width: 80px; height: 80px; border-radius: 50%;"> --}}
                                            {{--                                                        @elseif(isset($document->name) && in_array(array_reverse(explode('.', $document->name))[0], ['doc', 'docx', 'txt'])) --}}
                                            {{--                                                            <img src="{{ asset('/website/images').'/Word-Logo.png' }}" style="width: 80px;"> --}}
                                            {{--                                                        @else --}}
                                            {{--                                                            <img src="{{ asset('/website/images').'/user_profile.png' }} " style="width: 80px; height: 80px; border-radius: 50%;"> --}}
                                            {{--                                                        @endif --}}
                                            {{--                                                        @php $displayed++; @endphp --}}
                                            {{--                                                    @endif --}}
                                            {{--                                                @endforeach --}}
                                            {{--                                            @endforeach --}}

                                            {{--                                            @if ($totalDocuments > 1) --}}
                                            {{--                                                +{{ $totalDocuments - $displayed }} --}}
                                            {{--                                            @endif --}}
                                            {{--                                        @endif --}}
                                            @php
                                                $totalDocuments = 0;
                                                foreach ($item->getphotoandDocument as $photoAndDocument) {
                                                    $totalDocuments += count($photoAndDocument->getDocuments);
                                                }
                                                $displayed = 0;
                                            @endphp

                                            @if ($totalDocuments == 0)
                                                <img src="{{ asset('/website/images') . '/by_default_two.png' }} "
                                                    style="width: 80px; height: 80px; border-radius: 50%;">
                                            @else
                                                @foreach ($item->getphotoandDocument as $photoAndDocument)
                                                    @foreach ($photoAndDocument->getDocuments as $document)
                                                        @if ($displayed < 1)
                                                            @php $fileExtension = strtolower(array_reverse(explode('.', $document->name))[0]); @endphp

                                                            @if (isset($document->name) &&
                                                                    in_array($fileExtension, ['jpg', 'jpeg', 'pjpeg', 'png', 'x-png', 'gif', 'x-shockwave-flash']))
                                                                <img src="{{ asset('website') }}/{{ $document->name }}"
                                                                    style="width: 80px; height: 80px; border-radius: 50%;">
                                                            @elseif(isset($document->name) && $fileExtension == 'pdf')
                                                                <img src="{{ asset('/website/images') . '/pdf.png' }}"
                                                                    style="width: 80px; height: 80px; border-radius: 50%;">
                                                            @elseif(isset($document->name) && in_array($fileExtension, ['doc', 'docx', 'txt']))
                                                                <img src="{{ asset('/website/images') . '/Word-Logo.png' }}"
                                                                    style="width: 80px;">
                                                            @else
                                                                <img src="{{ asset('/website/images') . '/user_profile.png' }} "
                                                                    style="width: 80px; height: 80px; border-radius: 50%;">
                                                            @endif

                                                            @php $displayed++; @endphp
                                                        @endif
                                                    @endforeach
                                                @endforeach



                                                @if ($totalDocuments > 1)
                                                    +{{ $totalDocuments - $displayed }}
                                                @endif
                                            @endif

                                        </td>
                                        <td>{{ $item->lead_number ?? '000' }}</td>
                                        <td>{{ $item->title ?? 'Not Available' }}</td>
                                        <td>{!! substr($item->description, 0, 50), '...' !!}</td>
                                        <td>{{ $item->customer->name ?? 'Not Available' }}</td>
                                        <td>{{ $item->representative->name ?? 'Not Available' }}</td>
                                        <td>{{ $item->category->name ?? 'Not Available' }}</td>
                                        <td>{{ substr($item->address, 0, 50), '...' }} {{-- {{ $item->address??"" }} --}}</td>
                                        <td>
                                            @if ($item->lead_status == 'won')
                                                <badge class='badge badge-success'>WON</badge>
                                            @elseif($item->lead_status == 'lost')
                                                <badge class='badge badge-danger'>LOST</badge>
                                            @elseif($item->lead_status == 'pending')
                                                <badge class='badge badge-warning'>PENDING</badge>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn_td">
                                                @can('view-' . str_slug('Lead'))
                                                    <a href="{{ url('view_lead/' . $item->id) }}"
                                                        title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead') }}">
                                                        <button class="btn green_btn btn-sm">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </button>
                                                    </a>
                                                @endcan
                                                @can('delete-' . str_slug('Lead'))
                                                    <form method="POST" id="delete-form-{{ $item->id }}"
                                                        action="{{ url('/lead/lead' . '/' . $item->id) }}"
                                                        accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="button" class="btn green_btn btn-sm delete-btn"
                                                            data-id="{{ $item->id }}"
                                                            title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead') }}">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            No Record Available
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Delete button click handler
            $('.delete-btn').on('click', function(e) {
                e.preventDefault();

                const leadId = $(this).data('id');
                const form = $('#delete-form-' + leadId);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
