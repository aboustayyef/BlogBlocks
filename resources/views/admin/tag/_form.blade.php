{{csrf_field()}}

<div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
    <label for="nickname" class="control-label">Nickname (One Word That is Unique to the tag)</label>
    <input class="form-control" name="nickname" type="text" id="nickname" value="{{old('nickname', $tag->nickname)}}">
    <small class="text-danger">{{ $errors->first('nickname') }}</small>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="control-label">Description</label>
    <input class="form-control" name="description" type="text" id="description" value="{{old('description', $tag->description)}}">
    <small class="text-danger">{{ $errors->first('description') }}</small>
</div>

<div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
    <label for="color" class="control-label">color</label>
    <input class="form-control" name="color" type="text" id="color" value="{{old('color', $tag->color)}}">
    <small class="text-danger">{{ $errors->first('color') }}</small>
</div>
