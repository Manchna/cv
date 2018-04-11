<form  action="{{ route('cvCreate') }}"  method="post">
    <div class="form-group  {{ $errors->has('answer.*') ? ' has-error' : '' }}">
        @foreach($data['questions'] as $question)
            <div class="form-group">
                <label for="sel1">{{$question->text}}</label>
                <input class="form-control"  name="answer[{{$question->id}}]" id="{{$question->id}}" type="text">
                @if ($errors->has('answer.*'))
                    <p class="text-danger">{{ $errors->first('answer.*') }}</p>
                @endif
            </div>
      @endforeach
    </div>

    {{ csrf_field() }}
    <button type="submit" class="btn btn-default btn-lg btn-block btn btn-primary">Save</button>
</form>