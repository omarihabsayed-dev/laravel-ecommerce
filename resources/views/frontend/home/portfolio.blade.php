@php
$portfolio = \App\Models\Portfolio::first();
@endphp
<section class="portfolio">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="section__title text-center">
                    <span class="sub-title">04 - Portfolio</span>
                    <h2 class="title">All creative work</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content" id="portfolioTabContent">
        <div class="tab-pane show active" id="all" role="tabpanel" aria-labelledby="graphic-tab">
            <div class="container">
                <div class="row gx-0 justify-content-center">
                    <div class="col">
                        <div class="portfolio__active">
                            <div class="portfolio__item">
                                <div class="portfolio__thumb">
                                    <img src="{{ asset('storage/' . $portfolio->image) }}" alt="">
                                </div>
                                <div class="portfolio__overlay__content">
                                    <span>{{ $portfolio->name }}</span>
                                    <h4 class="title"><a href="{{ route('portfolio.show') }}">{{ $portfolio->title
                                            }}</a></h4>
                                    <a href="{{ route('portfolio.show') }}" class="link">Case Study</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>