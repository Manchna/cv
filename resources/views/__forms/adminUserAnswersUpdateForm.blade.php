<form action="{{ route('adminCvUpdate', ['id' => $data['user']->id] ) }}" method="post">
    <div class="form-group">
        @foreach($data['answers'] as $answer)
            <div class="form-group"  {{ $errors->has('answer.*') ? ' has-error' : '' }}>
                <label for="sel1">{{$answer->question->text}}</label>
                <input class="form-control"  name="answer[{{$answer->question->id}}]" id="{{$answer->id}} " value="{{$answer->text}}" type="text">
                @if ($errors->has('answer.*'))
                    <p class="text-danger">{{ $errors->first('answer.*') }}</p>
                @endif
            </div>
        @endforeach
    </div>

    {{ csrf_field() }}
    <button type="submit" class="btn btn-default btn-lg btn-block btn btn-primary">update</button>
</form>