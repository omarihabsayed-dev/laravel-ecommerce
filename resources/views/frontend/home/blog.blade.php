@php
$blogs = App\Models\Blog::latest()->limit(3)->get();
@endphp
<section class="blog">
    <div class="container">
        <div class="row gx-0 justify-content-center">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6 col-sm-9">
                <div class="blog__post__item">
                    <div class="blog__post__thumb">
                        <a href="{{ route('blog.show', $blog) }}"><img src="{{ asset('storage/' . $blog->image) }}"
                                alt=""></a>
                        <div class="blog__post__tags">
                            <a href="{{ route('blog.posts', $blog->blog_category_id) }}">{{ $blog->category->category
                                }}</a>
                        </div>
                    </div>
                    <div class="blog__post__content">
                        <span class="date">{{ $blog->created_at->diffForHumans() }}</span>
                        <h3 class="title"><a href="{{ route('blog.show', $blog) }}">{{ $blog->title }}</a></h3>
                        <a href="{{ route('blog.show', $blog) }}" class="read__more">Read more</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="blog__button text-center">
            <a href="blog.html" class="btn">more blog</a>
        </div>
    </div>
</section>