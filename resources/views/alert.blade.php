<div class="">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close pl-2" data-dismiss="alert">×</button>
        <i class="fa fa-check"></i> {{ $message }}
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block" style="padding-right: 30px;">
        <button type="button" class="close pl-2" data-dismiss="alert">×</button>
        <i class="fa fa-ban"></i> {{ $message }}
    </div>
    @endif

    @if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <button type="button" class="close pl-2" data-dismiss="alert">×</button>
        <i class="fa fa-exclamation-triangle"></i> {{ $message }}
    </div>
    @endif

    @if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close pl-2" data-dismiss="alert">×</button>
        <i class="fa fa-info"></i> {{ $message }}
    </div>
    @endif

    @if ($message = Session::get('delete'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close pl-2" data-dismiss="alert">×</button>
        <i class="fa fa-info"></i> {{ $message }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close pl-2" data-dismiss="alert">×</button>
        <i class="fa fa-ban"></i> Please check the form below for errors
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>