@extends('templates.index')

@section('content')
<div class="general-agileits-w3l">
  <div class="w3l-medile-movies-grids">
    <!-- /movie-browse-agile -->
      <div class="movie-browse-agile">
          <!--/browse-agile-w3ls -->
          <div class="browse-agile-w3ls general-w3ls">
            <div class="tittle-head">
              @if ($genreFilm !== null)
                      <h4 class="latest-text">Movies Of Genre {{ $genreFilm->name }}</h4>
                    @else
                      <h4 class="latest-text">List Of Movies</h4>
                    @endif
              <div class="container">
                <div class="agileits-single-top">
                  <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('movies') }}">Movies</a></li>
                    @if ($genreFilm !== null)
                      <li class="active">Genre {{ $genreFilm->name }}</li>
                    @else
                      <li class="active">All Movies</li>
                    @endif
                  </ol>
                </div>
              </div>
            </div>
            <div class="container">
              <div class="browse-inner">
              @for ($data = 0; $data < $films->count(); $data++)
              <div class="col-md-2 w3l-movie-gride-agile">
                <a href="{{ route('movies.show', $films[$data]->id) }}" class="hvr-shutter-out-horizontal"><img src="{{ asset($films[$data]->poster) }}" title="album-name" alt=" " />
                  <div class="w3l-action-icon">
                    <i class="fa fa-play-circle" aria-hidden="true"></i>
                  </div>
                </a>
                <div class="mid-1">
                  <div class="w3l-movie-text">
                    <h6><a href="{{ route('movies.show', $films[$data]->id) }}">{{ $films[$data]->title }}</a></h6>

                    {{-- FITUR BARU: tombol suka film --}}
                    <button type="button" class="btn-like" data-id="{{ $films[$data]->id }}" aria-label="Suka film">
                      <i class="fa fa-heart-o" aria-hidden="true"></i>
                    </button>
                  </div>
                  <div class="mid-2">
                    <p>{{ $films[$data]->year }}</p>
                    <div class="block-stars">
                      <ul class="w3l-ratings">
                            <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                          <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                          <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                          <li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
                          <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                            
                  
                      </ul>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
                @if ($films[$data]->year == now()->year)
                <div class="ribben two">
                  <p>NEW</p>
                </div>
                @endif
              </div>
                @endfor
              <div class="clearfix"> </div>
            </div>
              </div>
          </div>
      <!--//browse-agile-w3ls -->
          <div class="blog-pagenat-wthree">
            @if ($films->hasPages())
                <nav>
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($films->onFirstPage())
                            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                <span class="frist" aria-hidden="true">&lsaquo; Prev</span>
                            </li>
                        @else
                            <li>
                                <a class="frist" href="{{ $films->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo; Prev</a>
                            </li>
                        @endif
                        {{-- <Number Page --}}
                        @for ($numberPage = 1; $numberPage <= $films->lastPage(); $numberPage++)
                          @if ($numberPage == $films->currentPage())
                            <li class="disabled" aria-disabled="true" >
                              <span class="frist" aria-hidden="true">{{ $numberPage }}</span>
                            </li>
                          @else
                            <li><a href="?page={{ $numberPage }}" class="frist">{{ $numberPage }}</a></li>
                          @endif
                        @endfor
                        {{-- Number Page/> --}}
                        {{-- Next Page Link --}}
                        @if ($films->hasMorePages())
                            <li>
                                <a class="frist" href="{{ $films->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next &rsaquo;</a>
                            </li>
                        @else
                            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                <span class="frist" aria-hidden="true">Next &rsaquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
          </div>
        </div>
    <!-- //movie-browse-agile -->
    </div>	
  </div>
<!-- //w3l-medile-movies-grids -->
</div>

{{-- FITUR BARU: gaya dan skrip tombol suka film --}}
<style>
  .btn-like {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
    color: #f58a1f;
    padding: 0;
    margin-top: 4px;
  }
  .btn-like.liked i {
    color: #e91e63;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var liked = JSON.parse(localStorage.getItem('likedFilms') || '[]');

    document.querySelectorAll('.btn-like').forEach(function (btn) {
      var id = btn.dataset.id;
      var icon = btn.querySelector('i');

      function tampil() {
        var suka = liked.indexOf(id) !== -1;
        btn.classList.toggle('liked', suka);
        icon.className = suka ? 'fa fa-heart' : 'fa fa-heart-o';
      }

      tampil();

      btn.addEventListener('click', function () {
        var i = liked.indexOf(id);
        if (i === -1) {
          liked.push(id);
        } else {
          liked.splice(i, 1);
        }
        localStorage.setItem('likedFilms', JSON.stringify(liked));
        tampil();
      });
    });
  });
</script>
@endsection