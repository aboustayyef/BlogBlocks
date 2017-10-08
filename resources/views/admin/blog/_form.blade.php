{{csrf_field()}}

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="control-label">Name</label>
    <input class="form-control" name="name" type="text" id="name" value="{{old('name', $blog->name)}}">
    <small class="text-danger">{{ $errors->first('name') }}</small>
</div>

<div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
    <label for="nickname" class="control-label">Nickname (One Word That is Unique to the Blog, used to identify and for url)</label>
    <input class="form-control" name="nickname" type="text" id="nickname" value="{{old('nickname', $blog->nickname)}}">
    <small class="text-danger">{{ $errors->first('nickname') }}</small>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="control-label">Description</label>
    <input class="form-control" name="description" type="text" id="description" value="{{old('description', $blog->description)}}">
    <small class="text-danger">{{ $errors->first('description') }}</small>
</div>

<div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
    <label for="url" class="control-label">Blog's Homepage</label>
    <input class="form-control" name="url" type="text" id="url" value="{{old('url', $blog->url)}}">
    <small class="text-danger">{{ $errors->first('url') }}</small>
</div>

<div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
    <label for="author" class="control-label">Author</label>
    <input class="form-control" name="author" type="text" id="author" value="{{old('author', $blog->author)}}">
    <small class="text-danger">{{ $errors->first('author') }}</small>
</div>

<div class="form-group{{ $errors->has('twitter') ? ' has-error' : '' }}">
    <label for="twitter" class="control-label">Twitter Username (without @)</label>
    <input class="form-control" name="twitter" type="text" id="twitter" value="{{old('twitter', $blog->twitter)}}">
    <small class="text-danger">{{ $errors->first('twitter') }}</small>
</div>

<div class="form-group{{ $errors->has('rss') ? ' has-error' : '' }}">
    <label for="rss" class="control-label">Rss Feed</label>
    <input class="form-control" name="rss" type="text" id="rss" value="{{old('rss', $blog->rss)}}">
    <small class="text-danger">{{ $errors->first('rss') }}</small>
</div>
