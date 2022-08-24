<form class="search-box" action="{{ route('services.search') }}">
  <img src="{{asset('static/img/icons/search.svg')}}" width="32" alt="">
  <input type="text" name="title" placeholder="Որոնել ծառայություն" value="{{ $title ?? '' }}">

  <img src="{{asset('static/img/icons/pin.svg')}}" width="28" alt="">

  <div class="dropdown me-4">
{{--    <button class="btn btn-custom btn-sm dropdown-toggle px-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--      Ընտրել վայրը--}}
{{--    </button>--}}
{{--    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">--}}
{{--      <li><a class="dropdown-item" href="#">Boston</a></li>--}}
{{--      <li><a class="dropdown-item" href="#">New York</a></li>--}}
{{--      <li><a class="dropdown-item" href="#">Chicago</a></li>--}}
{{--      <li><a class="dropdown-item" href="#">Austin</a></li>--}}
{{--    </ul>--}}
      <select name="cities" id="">
          <option value="">Ընտրել վայրը</option>
          @if(!empty($cities) && $cities)
              @foreach($cities as $city)
                  <option value="{{ $city->id }}">{{ $city->name }}</option>
              @endforeach
          @endif
      </select>
  </div>

{{--  <button class="btn btn-primary btn-sm">Որոնում</button>--}}
    <input type="submit" class="btn btn-primary btn-sm" value="Որոնում">
</form>
