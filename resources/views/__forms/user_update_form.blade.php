<form action="{{ route('user_update',  ['id' => $user->id] ) }}"  method="post">
    <div class="form-group">
        <label for="name">name:</label>
        <input type="text" class="form-control"  name="name" value="{{$user->name}}" id="name">
        @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="title">email:</label>
        <input type="text" class="form-control"  name="email" value="{{$user->email}}" id="email">
        @if ($errors->has('email'))
            <p class="text-danger">{{ $errors->first('email') }}</p>
        @endif
    </div>
    @if($user->password != "")
        <div class="form-group">
            <label for="title">Password:</label>
            <input type="password" class="form-control"  name="password"  id="password">
            @if ($errors->has('password'))
                <p class="text-danger">{{ $errors->first('password') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="title">Confirm Password:</label>
            <input type="password" class="form-control"  name="confirm_password"  id="confirm_password">
            @if ($errors->has('confirm_password'))
                <p class="text-danger">{{ $errors->first('confirm_password') }}</p>
            @endif
        </div>
    @endif
    {{ csrf_field() }}
    <button type="submit" name="send" class="btn btn-default btn-lg btn-block btn btn-primary">Save</button>
</form>