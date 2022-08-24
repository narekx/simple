<div class="service-item">
  <div class="service-item__img" style="background-image: url({{$image}})">
    <button class="service-item__like"></button>
  </div>
  <div class="service-item__content">

    <div class="d-flex justify-content-between align-items-start">
      <div class="">
          <a href="{{ route('users.show', ['id' => $user_id]) }}"><h4>{{$title}}</h4></a>
        <div class="service-item-location d-flex align-items-center">
          <img src="{{asset('static/img/icons/pin-fill.svg')}}" width="24" alt="">
          <span>{{$location}}</span>
        </div>
        <ul class="service-item-rating">
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
        </ul>
      </div>
      <img src="{{$category_icon}}" width="28" alt="">
    </div>

      <a href="{{ route('services.show', ['id' => $service_id]) }}"><h5>{{$job}}</h5></a>
    <p>{{ $description ?? ' ' }}</p>

    <div class="d-flex justify-content-end align-items-center service-item-contact">
      <a class="me-3" href="/">
        <img src="{{asset('static/img/icons/phone.svg')}}" width="18" alt="">
      </a>
      <a href="mailto://www.google.com" target="_blank">
        <img src="{{asset('static/img/icons/email.svg')}}" width="18" alt="">
      </a>
    </div>

  </div>
</div>
