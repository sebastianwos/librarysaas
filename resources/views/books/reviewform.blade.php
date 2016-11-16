    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3>Add another review: </h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('reviews.store', ['book' => $book->id ]) }}">
                        {!! csrf_field() !!}
                                <!-- Rating Form Input -->
                        <div class="form-group">
                            <label for="rating">Rating:</label>
                            <select type="text" name="rating" value="{{ old('rating') }}" class="form-control">
                                <option value="1" {{ old('rating') == 1 ? 'selected' : null }}>1</option>
                                <option value="2" {{ old('rating') == 2 ? 'selected' : null }}>2</option>
                                <option value="3" {{ old('rating') == 3 ? 'selected' : null }}>3</option>
                                <option value="4" {{ old('rating') == 4 ? 'selected' : null }}>4</option>
                                <option value="5" {{ old('rating') == 5 ? 'selected' : null }}>5</option>
                            </select>
                        </div>
                        <div class="form-group {{ $errors->has('comment') ? 'has-error' : null  }}">
                            <label for="comment">Comment:</label>
                            <textarea cols="30" rows="10" name="comment" class="form-control" >{{ old('comment') }}</textarea>
                            @if ($errors->has('comment'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('comment') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!--  Form Input -->
                        <div class="form-group">
                            <input type="submit" name="submit" value="Comment" class="btn btn-primary"/>
                            <a class="btn btn-danger" href="/home">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
