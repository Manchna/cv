<form  action="{{ route('adminSendProfession') }}" method="post">
    <div class="form-group {{ $errors->has('profession') ? ' has-error' : '' }}" >
        <label for="title">profession:</label>
        <input type="text" class="form-control"  name="profession" id="profession">
        @if ($errors->has('profession'))
            <p class="text-danger">{{ $errors->first('profession') }}</p>
        @endif
    </div>
    {{csrf_field()}}
    <button type="submit"  class="btn btn-default btn-lg btn-block btn btn-primary">Send</button>
</form>