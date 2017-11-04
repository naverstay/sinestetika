$(function() {

  function onPageLoaded() {
    onScrollResize();

    $('.p-project-section .p-project-section-slider').each(function() {
      $(this).slick({
        adaptiveHeight: false,
        lazyLoad: 'progressive',
        arrows: false,
        dots: true,
        infinite: true,
        mobileFirst: true,
        zIndex: 100
      });
    });

    $('.h-floating:not(.__visible)').unveil('2%', function() {
      var $el = $(this);
      $el.addClass('__visible');
      if ($el.hasClass('p-service-section-title')) {
        $el.parents('.p-service-section').addClass('__visible');
      }
    });

    $('video:not(.vid)').each(function() {
      $(this).addClass('vid');
      new MyVideo(this);
    });
  }

  function onScrollResize(e) {
    var wt = $(window).scrollTop();
    var nbh = $('.navbar-custom').outerHeight();
    var nbh2 = (nbh / 2) + (parseInt($('.navbar-custom').css('paddingTop')) / 2) + (parseInt($('.navbar-custom').css('marginTop')) / 2);

    var wh = 0;
    if ($('.blue-bg').length > 0) {
      wh = $('.blue-bg').outerHeight();
    } else {
      wh = $(window).height();
    }

    $('body').toggleClass('__intro', wt <= wh - nbh2);
  }

  var pages = {};

  function loadPage(path, hash) {
    if (pages.hasOwnProperty(path) == false) {
      pages[path] = $.get(path);
    }
    return pages[path];
  }

  function startLogoAnim(event) {
    var anim_type = null;

    var $trg = $(event.target);
    var $el = null;
    if (($el = $trg.parents('.p-project-next')).length > 0) {
      anim_type = 'next';
      $el.addClass('__anim');
      $('body').addClass('__anim_next');
    }

    var delay = 600;

    if (anim_type == 'next') {
      delay = 100000;
    } else {
      $('.navbar-brand').addClass('__anim');
      $('body').removeClass('home').addClass('__intro __leave');
    }
    return delay;
  }

  function showPage(path, hash, event, is_back) {
    is_back = (typeof is_back == 'boolean' ? is_back : false);

    var xhr = loadPage(path, hash);
    xhr.done(function(html, state) {
      if (state == 'success') {
        var delay = 0;
        if (!is_back) {
          delay = startLogoAnim(event);
        }

        var tit = html.match(/<title>(.*?)<\/title>/);
        var body_cls = html.match(/<body.*?class="(.*?)".*?>/);
        //debugger;

        setTimeout(function() {
          if (!is_back) {
            loadPage(window.location.pathname, window.location.hash);
            history.pushState(null, (tit[1] || null), path + hash);
            $('html, body').scrollTop(0);
          }

          $html = $(html);
          var $b = $('body');
          $('.s-page').replaceWith($html.filter('.s-page'));
          $b.removeClass($b[0].className);
          if (body_cls && body_cls[1]) {
            var clss = body_cls[1].split(' ');
            for (var i = 0; i < clss.length; i++) {
              var cls = clss[i];
              if (cls != '') {
                $b.addClass(cls);
              }
            }
          }

          onPageLoaded();

          if (hash) {
            var $hashEl = $(hash);
            if ($hashEl.length > 0) {
              $('html, body').animate({
                scrollTop: $hashEl.offset().top - 100
              }, 400);
            }
          }
        }, delay);
      }
    });
  }

  function toggleMenu(e) {
    var brw = 0;
    if ($('.navbar-custom').hasClass('in')) {
      $('body').removeClass('is-open');
    } else {
      var dw = $(document).width();
      $('body').addClass('is-open');
      var dwh = $(document).width();
      brw = dwh - dw;
    }
    $('body').css('border-right-width', brw + 'px');
    $('.navbar-custom').css('right', brw + 'px').toggleClass('in');
  }

  $(window).on('resize scroll', throttle(onScrollResize, 100) );

  $(document)
    .on('click', '.intro-arrow', function(e) {
      e.preventDefault();

      var wh = $(window).height();
      $('html, body').animate({
        'scrollTop': wh
      }, 460);
    })
    .on('click', '.p-projects-filter-groups .__all.__mobile a', function(e) {
      e.preventDefault();

      var show = $('.p-projects-filter-groups').hasClass('collapse-xs');
      if (show) {
        $('.p-projects-filter-groups').removeClass('collapse-xs').addClass('expand-xs');
      } else {
        $('.p-projects-filter-groups').addClass('collapse-xs').removeClass('expand-xs');
      }
    })
    .on('click', '.navbar-custom .navbar-toggle', toggleMenu)
    .on('click', '.navbar-custom .b-menu-overlay', function() {
      $('.navbar-custom').removeClass('in');
      $('body').removeClass('is-open').css('border-right-width', 0);
      $('.navbar-custom').css('right', 0);
    })
    .on('click', '.p-project-section-slider-item', function() {
      var slider = $(this).parents('.p-project-section-slider').slick('slickNext');
    })
    .on('mouseenter', 'a', function() {
      if (window.location.hostname == this.hostname) {
        loadPage(this.pathname, this.hash);
      }
    })
    .on('click', 'a', function(e) {
      if (window.location.hostname == this.hostname) {
        e.preventDefault();
        if (window.location.pathname != this.pathname || window.location.hash != this.hash) {
          if ($(e.target).parents('.b-menu').length > 0) {
            toggleMenu();
          }
          showPage(this.pathname, this.hash, e);
        }
      }
    });

  $(window).on('popstate', function(e) {
    e.preventDefault();
    var state = History.getState();
    if (state) {
      var a = $('<a>').attr('href', state.url)[0];
      showPage(a.pathname, a.hash, null, true);
    }
  });

  function MyVideo(video) {
    this.$el = $(video);

    var that = this;

    this.video = video;
    this.video.controls = false;

    that.$el.data('video', this);

    this.bigPlayBtn = function() {
      return that.$el.siblings('.v-btn-play-big');
    };
    this.btnPlayPause = function() {
      return that.$el.siblings('.v-controls').find('.v-btn-play');
    };

    this.elTimeCurrent = function() {
      return that.$el.siblings('.v-controls').find('.v-time-current');
    };
    this.elTimeTotal = function() {
      return that.$el.siblings('.v-controls').find('.v-time-total');
    };

    this.btnFullscreen = function() {
      return that.$el.siblings('.v-controls').find('.v-btn-fullscreen');
    };

    this.elVolume = function() {
      return that.$el.siblings('.v-controls').find('.v-volume');
    };
    this.btnVolume = function() {
      return that.$el.siblings('.v-controls').find('.v-btn-volume');
    };
    this.elVolumeBar = function() {
      return that.$el.siblings('.v-controls').find('.v-volume-bar');
    };
    this.elVolumeBarTarget = function() {
      return that.$el.siblings('.v-controls').find('.v-volume-bar-target');
    };
    this.elVolumeBarCurrent = function() {
      return that.$el.siblings('.v-controls').find('.v-volume-bar-current');
    };

    this.elTimeline = function() {
      return that.$el.siblings('.v-controls').find('.v-timeline');
    };
    this.elTimelineCurrent = function() {
      return that.$el.siblings('.v-controls').find('.v-timeline-current');
    };
    this.elTimelineTarget = function() {
      return that.$el.siblings('.v-controls').find('.v-timeline-target');
    };

    this.stopAnotherVideos = function() {
      $('video').each(function() {
        var mv = $(this).data('video');
        if (mv && typeof mv == 'object' && mv instanceof MyVideo) {
          mv.pause();
        }
      });
    };

    this.onBtnPlayPause = function() {
      if (that.video.paused || that.video.ended) {
        that.stopAnotherVideos();
        that.play();
      } else {
        that.pause();
      }
    };

    this.togglePlayPause = function() {
      if (that.video.paused || that.video.ended) {
        that.btnPlayPause().removeClass('pause');
      } else {
        that.btnPlayPause().addClass('pause');
      }
    };

    this.toggleMuted = function(muted) {
      muted = (typeof muted == 'boolean' ? muted : !that.elVolume().hasClass('muted'));

      that.video.muted = muted;
      that.elVolume().toggleClass('muted', muted);
    };
    this.changeVolume = function(e) {
      var x = e.offsetX;
      var w = that.elVolumeBar().width();

      that.toggleMuted(false);
      video.volume = x / w;
      that.updateVolumeUI();
    };
    this.updateVolumeUI = function() {
      var vl = that.video.volume * 100;
      that.elVolumeBarCurrent().css('width', vl + '%');
      that.elVolumeBarTarget().css('left', vl + '%');

      that.btnVolume().toggleClass('small', (vl > 0));
      that.btnVolume().toggleClass('medium', (vl >= 40));
      that.btnVolume().toggleClass('high', (vl >= 80));
    };

    this.pause = function() {
      that.btnPlayPause().removeClass('pause');
      that.video.pause();
    };

    this.play = function() {
      that.btnPlayPause().addClass('pause');
      that.video.play();
    };

    this.changePosition = function(e) {
      var x = e.offsetX;
      var w = that.elTimeline().width();

      var pos = x / w;
      pos = that.video.duration * pos;

      that.video.currentTime = pos;

      that.updateProgress();
    };
    this.updateProgress = function() {
      var value = 0;
      if (that.video.currentTime > 0) {
        value = Math.floor((100 / that.video.duration) * that.video.currentTime);
      }
      that.elTimelineCurrent().css('width', value + "%");
      that.elTimelineTarget().css('left', value + "%");

      that.elTimeCurrent().text(that._formatTime(that.video.currentTime));
    };

    this.requestFullScreen = function() {
      if (that.video.requestFullscreen) {
        that.video.requestFullscreen();
      } else if (that.video.mozRequestFullScreen) {
        that.video.mozRequestFullScreen();
      } else if (that.video.webkitRequestFullscreen) {
        that.video.webkitRequestFullscreen();
      }
    };

    this._formatTime = function(sec) {
      var t_min = Math.floor(sec / 60);
      var t_sec = Math.round(sec - (t_min * 60)).toString();
      t_sec = (t_sec.length == 1 ? '0' + t_sec : t_sec);

      return t_min + ':' + t_sec;
    };

    setInterval(this.updateProgress, 30);
    //this.video.addEventListener("timeupdate", this.updateProgress);
    this.video.addEventListener("play", this.togglePlayPause);
    this.video.addEventListener("ended", this.togglePlayPause);
    this.video.addEventListener("ended", this.updateProgress);
    this.video.addEventListener("pause", this.togglePlayPause);

    var _init = function() {
      that.video.removeEventListener("loadeddata", _init);
      that.elTimeTotal().text(that._formatTime(that.video.duration));
      that.btnVolume().toggleClass('muted', that.video.muted);
      that.updateVolumeUI();
    };

    //btnFullscreen().click();
    this.bigPlayBtn().click(function(e) {
      e.preventDefault();
      $(this).addClass('hidden').siblings('.v-controls').removeClass('hidden');
      that.stopAnotherVideos();
      that.play();
    });
    this.btnPlayPause().click(this.onBtnPlayPause);
    this.btnFullscreen().click(this.requestFullScreen);
    this.btnVolume().click(this.toggleMuted);

    this.elVolumeBar().click(this.changeVolume);
    this.elTimeline().click(this.changePosition);

    this.togglePlayPause();

    if (this.video.readyState == 2) {
      _init();
    } else {
      this.video.addEventListener("loadeddata", _init);
    }
  }

  onPageLoaded();
});

function convertRemToPixels(rem) {
  return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
}


function nextAnim() {
  var $el = $('.p-project-intro-wrapper.__next');
  var $elBg = $('.p-project-intro-wrapper.__next .p-project-intro-bg');
  var $elIntro = $('.p-project-intro-wrapper.__next .p-project-intro');
  var $elIntroBody = $('.p-project-intro-wrapper.__next .p-project-intro-body');
  var $elTitle = $('.p-project-intro-wrapper.__next .p-project-next-title');
  var st = window.pageYOffset || document.documentElement.scrollTop;
  var ph = ($('.p-project-intro-wrapper.__next').offset().top - st) - 30;

  $elBg.transition({
    scale: [1.05, 1]
  }, 300, 'out');

  $elTitle.transition({
    opacity: 0,
    delay: 350
  }, 250, 'out');

  $elBg.css({
    height: $(window).height() + ph + 'px'
  }).transition({
    scale: 1,
    marginTop: (0 - ph) + 'px',
    delay: 300
  }, 1500, 'out');

  $el.transition({
    scale: 1,
    height: '100vh',
    minHeight: '100vh',
    delay: 400,
    y: (0 - ph) + convertRemToPixels(14) + 'px'
  }, 1000, 'in');

  $elIntro.css({
    overflow: 'visible'
  }).transition({
    height: '100vh',
    minHeight: '100vh',
    delay: 400
  }, 750, 'out');

  $elTitle.transition({
    height: 0,
    marginBottom: 0,
    delay: 800
  }, 500, 'out');

  setTimeout(function() {
    $elTitle.remove();
  }, 2000);
}
