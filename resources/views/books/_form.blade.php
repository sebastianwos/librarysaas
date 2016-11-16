{!! csrf_field() !!}
<!-- Library_name Form Input -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : null  }}">
    <label for="name">Book Name:</label>
    <input type="text" name="name" value="{{ old('name', isset($book) ? $book->name : null) }}" class="form-control"/>
    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>
<div class="form-group {{ $errors->has('author') ? 'has-error' : null  }}">
    <label for="author">Author Name:</label>
    <input type="text" name="author" value="{{ old('author', isset($book) ? $book->author : null) }}" class="form-control"/>
    @if ($errors->has('author'))
        <span class="help-block">
            <strong>{{ $errors->first('author') }}</strong>
        </span>
    @endif
</div>
<!-- Library_name Form Input -->
<div class="form-group {{ $errors->has('period') ? 'has-error' : null  }}">
    <label for="period">Borrowing Period in weeks:</label>
    <select name="period" class="form-control">
        <option value=""> Select Period in Weeks </option>
        @foreach(range(1, 10) as $weeks)
            <option {{ old('period', isset($book) ? $book->period : null) == $weeks ? 'selected' : null }}
                    value="{{ $weeks }}">
                {{ $weeks }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('period'))
        <span class="help-block">
            <strong>{{ $errors->first('period') }}</strong>
        </span>
    @endif
</div>
<!--  Form Input -->
<div class="form-group">
    <input type="submit" name="submit" value="{{ isset($book) ? 'Update' : 'Save' }}" class="btn btn-primary"/>
    <a class="btn btn-danger" href="{{ route('libraries.edit', ['library' => $book->library]) }}">Cancel</a>
</div>