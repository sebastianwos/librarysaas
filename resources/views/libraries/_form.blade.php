{!! csrf_field() !!}
<!-- Library_name Form Input -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : null  }}">
    <label for="name">Library Name:</label>
    <input type="text" name="name" value="{{ old('name', isset($library) ? $library->name : null) }}" class="form-control"/>
    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>
<!--  Form Input -->
<div class="form-group">
    <input type="submit" name="submit" value="{{ isset($library) ? 'Update' : 'Save' }}" class="btn btn-primary"/>
</div>