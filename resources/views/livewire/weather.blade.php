<div>
  @if(isset($data))
      <div class="card">
          <div class="card-body">
              <div class="d-flex align-items-center">
                  <h4 class="card-title mb-0">Weather Report</h4>
                  <select class="form-select w-auto ms-auto">
                      <option value="location" {{ $locationType == 'Location' ? 'selected' : '' }}>Location</option>
                      <option value="ip_address" {{ $locationType == 'IP Address' ? 'selected' : '' }}>IP Address</option>
                  </select>
              </div>
              <div class="d-flex align-items-center flex-row mt-4">
                  <div class="p-2 display-5 text-primary">
                      <i><img src="https://openweathermap.org/img/wn/{{ $data['weather']['0']['icon'] ?? '' }}@2x.png" alt="" class="w-50"></i>
                      <span>{{ number_format($data['main']['temp'] - 273.15, 0) ?? '' }}<sup>°</sup>
                      </span>
                  </div>
                  <div class="p-2">
                      <h4 class="mb-0">{{ $day ?? '' }}</h4>
                      <p>{{ $data['name'] ?? '' }}, {{ $data['sys']['country'] ?? '' }}</p>
                  </div>
              </div>
              <table class="table table-borderless">
                  <tbody>
                      <tr>
                          <td>Wind</td>
                          <td class="fw-medium">{{ $this->degreesToCardinal($data['wind']['deg']) ?? '' }} {{ $data['wind']['speed'] ?? '' }} mps</td>
                      </tr>
                      <tr>
                          <td>Humidity</td>
                          <td class="fw-medium">{{ $data['main']['humidity'] ?? '' }}%</td>
                      </tr>
                      <tr>
                          <td>Pressure</td>
                          <td class="fw-medium">{{ $data['main']['pressure'] ?? '' }} mb</td>
                      </tr>
                      <tr>
                          <td>Cloud Cover</td>
                          <td class="fw-medium">{{ $data['clouds']['all'] ?? '' }}%</td>
                      </tr>
                  </tbody>
              </table>
              <hr />
              <ul class="list-unstyled row text-center mb-0">
                  <li class="col">
                    {{-- <i><img src="https://openweathermap.org/img/wn/{{ $data['weather']['0']['icon'] ?? '' }}@2x.png" alt="" class="w-25"></i> --}}
                      <span>Feels Like</span>
                      <h3 class="mb-0 fs-14 lh-base">{{ number_format($data['main']['feels_like'] - 273.15, 1) ?? '' }}<sup>°</sup></h3>
                  </li>
                  <li class="col">
                    {{-- <i><img src="https://openweathermap.org/img/wn/{{ $data['weather']['0']['icon'] ?? '' }}@2x.png" alt="" class="w-25"></i> --}}
                      <span>Min</span>
                      <h3 class="mb-0 fs-14 lh-base">{{ number_format($data['main']['temp_min'] - 273.15, 1) ?? '' }}<sup>°</sup></h3>
                  </li>
                  <li class="col">
                    {{-- <i><img src="https://openweathermap.org/img/wn/{{ $data['weather']['0']['icon'] ?? '' }}@2x.png" alt="" class="w-25"></i> --}}
                      <span>Max</span>
                      <h3 class="mb-0 fs-14 lh-base">{{ number_format($data['main']['temp_max'] - 273.15, 1) ?? '' }}<sup>°</sup></h3>
                  </li>
              </ul>
          </div>
      </div>
  @else
  <div class="card">
    <div class="card-body">
      <div class="d-flex align-items-center">
          <h4 class="card-title mb-0">Loading weather...</h4>
      </div>
    </div>
  </div>
  @endif
</div>
