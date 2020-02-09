<div class="form-group my-4 {{ $isHorizontal ? 'row' : '' }} {{ ! $errors->isEmpty() ? ($errors->has($name) ? 'has-danger' : 'has-success' ) : '' }} {{ $classes ?? '' }}">
