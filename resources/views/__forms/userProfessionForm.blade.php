<form  action="{{ route('userCreateProfession') }}" method="get">
    <div class="form-group {{ $errors->has('profession') ? ' has-error' : '' }}">

        <select class="form-control" name="profession" id="profession">
            <option value="" disabled selected>Select Profession</option>
            @foreach($data['name'] as $profession)
                 <option value="{{$profession->id}}"> {{$profession->name}} </option>
            @endforeach
        </select>
        @if ($errors->has('profession'))
            <span class="help-block">
                 <strong>{{ $errors->first('profession') }}</strong>
            </span>
        @endif

        <br />
        <button type="submit" name="send" class="btn btn-default btn-lg btn-block btn btn-primary">Select</button>
    </div>
</form>