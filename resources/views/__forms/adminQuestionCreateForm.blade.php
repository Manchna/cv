<form  action="{{ route('adminSendQuestion') }}" method="post">
    <div class="form-group ">
        <label for="sel1">Profession:</label>
        <select class="form-control" id="professionSel" name="professions[]">
            <option value="" disabled selected>Select Profession</option>
            <option value="all" >All</option>
            @foreach($professions as $profession)
               <option value="{{$profession->id}}">{{$profession->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group {{ $errors->has('question') ? ' has-error' : '' }}">
        <label for="title">question:</label>
        <input type="text" class="form-control"  name="question" id="question">
        @if ($errors->has('question'))
            <p class="text-danger">{{ $errors->first('question') }}</p>
        @endif
    </div>
    {{csrf_field()}}
    <button type="submit" class="btn btn-default btn-lg btn-block btn btn-primary">Send</button>
</form>