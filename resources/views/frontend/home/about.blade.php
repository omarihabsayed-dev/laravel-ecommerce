@php
$about = App\Models\About::first();
$multiImages = App\Models\MultiImage::get();
@endphp
<section id="aboutSection" class="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <ul class="about__icons__wrap">
                    @php
                    $multiImages = App\Models\MultiImage::get();
                    @endphp

                    @forelse($multiImages as $image)
                    @if(is_array($image->multi_image))
                    @foreach($image->multi_image as $imgPath)
                    <li>
                        <img src="{{ asset('storage/' . $imgPath) }}" alt="About Image"
                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                    </li>
                    @endforeach
                    @endif
                    @empty

                    <li>
                        <img class="light" src="{{ asset('/frontend/assets/img/icons/xd_light.png') }}" alt="XD">
                        <img class="dark" src="{{ asset('/frontend/assets/img/icons/xd.png') }}" alt="XD">
                    </li>
                    @endforelse
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="about__content">
                    <div class="section__title">
                        <span class="sub-title">01 - About me</span>
                        <h2 class="title">{{ $about->title }}</h2>
                    </div>
                    <div class="about__exp">
                        <div class="about__exp__icon">
                            <img src="{{ asset('/frontend/assets/img/icons/about_icon.png') }}" alt="">
                        </div>
                        <div class="about__exp__content">
                            <p>{{ $about->short_title }}</p>
                        </div>
                    </div>
                    <p class="desc">{{ $about->short_description }}</p>
                    <a href="about.html" class="btn">Download my resume</a>
                </div>
            </div>
        </div>
    </div>
</section>