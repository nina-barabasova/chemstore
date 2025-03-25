<!-- resources/views/chemicals/show.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        <!-- Render Breadcrumbs -->
        @if($request)
        <h1 class="h1-screen">Request Details</h1>
            @if ( $allowApproval )
                @if ( $request->state_id == 1 || $request->state_id == 2 ) <!-- initial -->
                <form action="{{ route('request.approve') }}" method="POST"
                      style="display:inline;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $request->id }}">
                    <button type="submit" class="button-add-item">Approve Request</button>
                </form>
                @endif
                @if ( $request->state_id == 3 )  <!-- approved -->
                <form action="{{ route('request.process') }}" method="POST"
                      style="display:inline;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $request->id }}">
                    <button type="submit" class="button-submit">Process Request</button>
                </form>
                @endif
                @if ( $request->state_id == 3 || $request->state_id == 1 || $request->state_id == 4) <!-- approved or initial -->
                <form action="{{ route('request.cancel') }}" method="POST"
                      style="display:inline;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $request->id }}">
                    <button type="submit" class="button-delete">Cancel Request</button>
                </form>
                @endif
            @endif
        <div class="div-full">
            <p class="mt-2"><strong>Requested By: </strong>{{ $request->requestedBy->username }}</p>
            <p class="mt-2"><strong>State: </strong>{{ $request->state->name_en }}</p>
            <p class="mt-2"><strong>Experiment: </strong>{{ $request->experiment->name_en }}</p>
            <p class="mt-2"><strong>Experiment Date: </strong>{{ $request->localDate($request->experiment_date) }}</p>
            <p class="mt-2"><strong>Note: </strong>{{ $request->note }}</p>
            <p class="mt-2"><strong>Teacher Note: </strong>{{ $request->teacher_note }}</p>
            <p class="mt-2"><strong>Resolved Date: </strong>{{ $request->localDate($request->resolved_date) }}</p>
            <p class="mt-2"><strong>Resolved By: </strong>{{ $request->resolvedBy?->username }}</p>


{{--            <p class="mt-2"><strong>Description (EN):</strong> {{ $chemical->description_en }}</p>--}}
{{--            <p class="mt-2"><strong>Description (SK):</strong> {{ $chemical->description_sk }}</p>--}}
{{--            <p class="mt-2"><strong>Created At:</strong> {{ $chemical->created_at }}</p>--}}
{{--            <p class="mt-2"><strong>Updated At:</strong> {{ $chemical->updated_at }}</p>--}}

            <p class="mt-2"><strong>Chemicals Requested:</strong></p>
            <ul>
                @if($request->chemicals->isEmpty())
                    <li>No chemicals added on this request.</li>
                @else
                    @foreach($request->chemicals as $chemical)
                        <li class="mt-2"> {{ $chemical->pivot->quantity }} {{ $chemical->measureUnit->name ?? 'N/A'}}
                            <strong>of</strong> {!! $chemical->visualizeChemicalFormula($chemical->chemical_formula) !!}
                            ({{ $chemical->chemical_name_en }} / {{ $chemical->chemical_name_sk }} ) </li>
                    @endforeach
                @endif
            </ul>
        </div>
        @else
            <p>No Request found.</p>
        @endif
        <a href="{{ route('requests.index') }}" class="button-submit">Back to List</a>
    </div>
@endsection
