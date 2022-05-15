@if ($message = Session::get('success'))

<div class="alert alert-success alert-block">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

@endif


@if ($message = Session::get('error'))

<div class="alert alert-danger alert-block">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

@endif


@if ($message = Session::get('warning'))

<div class="alert alert-warning alert-block">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

@endif


@if ($message = Session::get('info'))

<div class="alert alert-info alert-block">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

@endif

@if ($errors->any())

<div class="alert alert-danger">
    {{__('Please check the form below for errors')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

@endif