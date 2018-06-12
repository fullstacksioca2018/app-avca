<div class="col-md-3 mb-3">
  <h5 class="font-weight-bold text-info text-uppercase">{{ $title }}</h5>
  @foreach($permisos as $p)
    <div class="form-group">
      <ul class="list-unstyled">
        <li>
          <label>
            {{ Form::checkbox('permissions[]', $p->id, null) }}
            {{ $p->name }}
            {{--<em>({{ $p->description ? : 'N/A' }})</em>--}}
          </label>
        </li>
      </ul>
    </div>
  @endforeach
</div>