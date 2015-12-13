<form method="post" action="{{route('user.friends.delete')}}" class="<?php echo (isset($class) ? '' : 'pull-right') ?>">
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <input type="hidden" name="username" value="{{ ($user) ? $user->username : '' }}" >
    <button type="submit" class="btn btn-default">{{$btnName}}</button>
</form>