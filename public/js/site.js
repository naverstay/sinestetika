$(function () {
  var didScroll;
  var lastScrollTop = 0;
  var delta = 5;

  // trigger only for homepage
  // that's why it's outside onPageLoaded
  homePreloader();

  // detect mobile devices
  $('html')
    .toggleClass('is-mobile', /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
    .toggleClass('touchscreen', ('touchstart' in window));

  function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
      "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
  }

  function homePreloader(skip_logo) {
    var $start_logo = $('.start-logo');

    console.log(window.location.pathname === "/", $start_logo.length);

    if (window.location.pathname === "/" && $start_logo.length) {
      // if (skip_logo) {
      //   $('.start-logo').addClass('is-finnised');
      //   $('.brand-heading').addClass('__anim');

      $('.start-logo').addClass('is-started');
      $('.intro').addClass('__anim');

      setTimeout(function () {
        $('.start-logo').addClass('is-finnised');
      }, 3000);

    } else {
      console.log('skip');
      // setTimeout(function () {
        $('.start-logo').hide();
        $('.intro').addClass('__anim');
      // }, 1000);
    }
  }

  function onPageLoaded(skip_logo) {

    onScrollResize();

    $('.p-project-section .p-project-section-slider').each(function () {
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

    $('.h-floating:not(.__visible)').unveil('2%', function () {
      var $el = $(this);
      $el.addClass('__visible');
      if ($el.hasClass('p-service-section-title')) {
        $el.parents('.p-service-section').addClass('__visible');
      }
    });

    $('video:not(.vid)').each(function () {
      $(this).addClass('vid');
      new MyVideo(this);
    });
  }

  function checkHeader() {
    // Hide Header on on scroll down
    var nb = $('.navbar');
    var navbarHeight = nb.outerHeight();

    // setInterval(function () {
    if (didScroll) {
      hasScrolled();
      didScroll = false;
    }

    // }, 250);

    function hasScrolled() {
      var st = $(this).scrollTop();

      // Make sure they scroll more than delta
      if (Math.abs(lastScrollTop - st) <= delta) return;

      // If they scrolled down and are past the navbar, add class .nav-up.
      // This is necessary so you never see what is "behind" the navbar.
      if (st > lastScrollTop && st > navbarHeight) {
        // Scroll Down
        nb.removeClass('nav-down').addClass('nav-up');
      } else {
        // Scroll Up
        if (st + $(window).height() < $(document).height()) {
          nb.removeClass('nav-up').addClass('nav-down');
        }
      }

      lastScrollTop = st;
    }
  }

  function getScrollTop() {
    return window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
  }

  function onScrollResize(e) {
    var $blueSection = $('.blueSection');
    var nb = $('.navbar');
    var wt = getScrollTop();
    var nbh = nb.outerHeight();
    var nbh2 = (nbh / 2) + (parseInt(nb.css('paddingTop')) / 2) + (parseInt(nb.css('marginTop')));
    var wh = 0;
    didScroll = true;

    // console.log('$blueSection', $blueSection.length, wt, wh, nbh2);

    if ($blueSection.length > 0) {
      wh = $blueSection.outerHeight();
    } else {
      wh = $(window).height();
    }

    $('body').toggleClass('__intro', wt <= wh - nbh2);

    checkHeader();
  }

  var pages = {};

  function loadPage(path, hash) {
    if (pages.hasOwnProperty(path) == false) {
      pages[path] = $.get(path);
    }
    return pages[path];
  }

  function animationHandler(event) {
    if (event) {
      var anim_type = null;

      var $trg = $(event.target);
      var $el = null;
      if (($el = $trg.parents('.p-project-next')).length > 0) {
        anim_type = 'next';
        $el.find('.p-project-intro-wrapper').addClass('__anim');
        $('body').addClass('__anim_next');
      }

      var delay = 600;

      if (anim_type == 'next') {
        delay = 800;

        // nextAnim()
      } else {
        $('.navbar-brand').addClass('__anim');
        $('body').removeClass('home').addClass('__intro __leave');
      }
      return data = {
        delay: delay,
        anim_type: anim_type
      };
    }
  }

  function showPage(path, hash, event, is_back, skip_logo) {
    is_back = (typeof is_back === 'boolean' ? is_back : false);
    skip_logo = (typeof skip_logo === 'boolean' ? skip_logo : false);

    var xhr = loadPage(path, hash);
    xhr.done(function (html, state) {
      if (state == 'success') {
        var delay = 0;
        var animationHandlerCb = animationHandler(event);
        if (!is_back) {
          delay = animationHandlerCb.delay;
        }

        var tit = html.match(/<title>(.*?)<\/title>/);
        var body_cls = html.match(/<body.*?class="(.*?)".*?>/);
        // debugger;

        setTimeout(function () {
          if (!is_back) {
            loadPage(window.location.pathname, window.location.hash);
            history.pushState(null, (tit[1] || null), path + hash);
            $('html, body').scrollTop(0);
          }

          var $html = $(html);
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

          if (animationHandlerCb && animationHandlerCb.anim_type == "next") {
            $b.addClass('__from-next');
          }

          onPageLoaded(skip_logo);

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

  function whichTransitionEvent() {
    var t;
    var el = document.createElement('fakeelement');
    var transitions = {
      'transition': 'transitionend',
      'OTransition': 'oTransitionEnd',
      'MozTransition': 'transitionend',
      'WebkitTransition': 'webkitTransitionEnd'
    };

    for (t in transitions) {
      if (el.style[t] !== undefined) {
        return transitions[t];
      }
    }
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

  $(window).on('resize scroll', throttle(onScrollResize, 100));
  // $(window).on('resize scroll', onScrollResize);

  $(document)
    .on('click', '.intro-arrow', function (e) {
      e.preventDefault();

      var wh = $(window).height();
      $('html, body').animate({
        'scrollTop': wh
      }, 460);
    })
    .on('click', '.p-projects-filter-groups .__all.__mobile a', function (e) {
      e.preventDefault();

      var show = $('.p-projects-filter-groups').hasClass('collapse-xs');
      if (show) {
        $('.p-projects-filter-groups').removeClass('collapse-xs').addClass('expand-xs');
      } else {
        $('.p-projects-filter-groups').addClass('collapse-xs').removeClass('expand-xs');
      }
    })
    .on('click', '.navbar-custom .navbar-toggle', toggleMenu)
    .on('click', '.navbar-custom .b-menu-overlay', function () {
      $('.navbar-custom').removeClass('in');
      $('body').removeClass('is-open').css('border-right-width', 0);
      $('.navbar-custom').css('right', 0);
    })
    .on('click', '.p-project-section-slider-item', function () {
      var slider = $(this).parents('.p-project-section-slider').slick('slickNext');
    })
    .on('mouseenter', 'a', function () {
      if (window.location.hostname == this.hostname) {
        loadPage(this.pathname, this.hash);
      }
    })
    .on('click', 'a', function (e) {
      e.preventDefault();

      if (window.location.hostname == this.hostname) {
        var link = $(this);
        if (window.location.pathname != this.pathname || window.location.hash != this.hash) {
          if ($(e.target).parents('.b-menu').length > 0) {
            toggleMenu();
          }
          console.log('pathname', this.pathname, 'hash', this.hash, link.hasClass('skipStartLogo'));

          if (link.hasClass('surfAnimate')) {
            var anim = link.attr('data-surf-animation');

            if (anim && anim.length && link.find(anim).length) {
              var transitionEvent = whichTransitionEvent();

              link.find(anim).on(transitionEvent, function () {
                console.log('Transition complete!', transitionEvent);

                setTimeout(function () {
                  showPage(link[0].pathname, link[0].hash, e, false, link.hasClass('skipStartLogo'));
                }, 500);

              }).end().addClass('__animate');

            } else {
              showPage(this.pathname, this.hash, e, false, link.hasClass('skipStartLogo'));
            }

          } else {
            showPage(this.pathname, this.hash, e, false, link.hasClass('skipStartLogo'));
          }
        }
      }

      return false;
    });

  $(window).on('popstate', function (e) {
    e.preventDefault();
    console.log('popstate');
    var state = History.getState();
    if (state) {
      var a = $('<a>').attr('href', state.url)[0];
      console.log(a);
      showPage(a.pathname, a.hash, null, true);
    }
  });

  function MyVideo(video) {
    this.$el = $(video);

    var that = this;

    this.video = video;
    this.video.controls = false;

    that.$el.data('video', this);

    this.bigPlayBtn = function () {
      return that.$el.siblings('.v-btn-play-big');
    };
    this.btnPlayPause = function () {
      return that.$el.siblings('.v-controls').find('.v-btn-play');
    };

    this.elTimeCurrent = function () {
      return that.$el.siblings('.v-controls').find('.v-time-current');
    };
    this.elTimeTotal = function () {
      return that.$el.siblings('.v-controls').find('.v-time-total');
    };

    this.btnFullscreen = function () {
      return that.$el.siblings('.v-controls').find('.v-btn-fullscreen');
    };

    this.elVolume = function () {
      return that.$el.siblings('.v-controls').find('.v-volume');
    };
    this.btnVolume = function () {
      return that.$el.siblings('.v-controls').find('.v-btn-volume');
    };
    this.elVolumeBar = function () {
      return that.$el.siblings('.v-controls').find('.v-volume-bar');
    };
    this.elVolumeBarTarget = function () {
      return that.$el.siblings('.v-controls').find('.v-volume-bar-target');
    };
    this.elVolumeBarCurrent = function () {
      return that.$el.siblings('.v-controls').find('.v-volume-bar-current');
    };

    this.elTimeline = function () {
      return that.$el.siblings('.v-controls').find('.v-timeline');
    };
    this.elTimelineCurrent = function () {
      return that.$el.siblings('.v-controls').find('.v-timeline-current');
    };
    this.elTimelineTarget = function () {
      return that.$el.siblings('.v-controls').find('.v-timeline-target');
    };

    this.stopAnotherVideos = function () {
      $('video').each(function () {
        var mv = $(this).data('video');
        if (mv && typeof mv == 'object' && mv instanceof MyVideo) {
          mv.pause();
        }
      });
    };

    this.onBtnPlayPause = function () {
      if (that.video.paused || that.video.ended) {
        that.stopAnotherVideos();
        that.play();
      } else {
        that.pause();
      }
    };

    this.togglePlayPause = function () {
      if (that.video.paused || that.video.ended) {
        that.btnPlayPause().removeClass('pause');
      } else {
        that.btnPlayPause().addClass('pause');
      }
    };

    this.toggleMuted = function (muted) {
      muted = (typeof muted == 'boolean' ? muted : !that.elVolume().hasClass('muted'));

      that.video.muted = muted;
      that.elVolume().toggleClass('muted', muted);
    };
    this.changeVolume = function (e) {
      var x = e.offsetX;
      var w = that.elVolumeBar().width();

      that.toggleMuted(false);
      video.volume = x / w;
      that.updateVolumeUI();
    };
    this.updateVolumeUI = function () {
      var vl = that.video.volume * 100;
      that.elVolumeBarCurrent().css('width', vl + '%');
      that.elVolumeBarTarget().css('left', vl + '%');

      that.btnVolume().toggleClass('small', (vl > 0));
      that.btnVolume().toggleClass('medium', (vl >= 40));
      that.btnVolume().toggleClass('high', (vl >= 80));
    };

    this.pause = function () {
      that.btnPlayPause().removeClass('pause');
      that.video.pause();
    };

    this.play = function () {
      that.btnPlayPause().addClass('pause');
      that.video.play();
    };

    this.changePosition = function (e) {
      var x = e.offsetX;
      var w = that.elTimeline().width();

      var pos = x / w;
      pos = that.video.duration * pos;

      that.video.currentTime = pos;

      that.updateProgress();
    };
    this.updateProgress = function () {
      var value = 0;
      if (that.video.currentTime > 0) {
        value = Math.floor((100 / that.video.duration) * that.video.currentTime);
      }
      that.elTimelineCurrent().css('width', value + "%");
      that.elTimelineTarget().css('left', value + "%");

      that.elTimeCurrent().text(that._formatTime(that.video.currentTime));
    };

    this.requestFullScreen = function () {
      if (that.video.requestFullscreen) {
        that.video.requestFullscreen();
      } else if (that.video.mozRequestFullScreen) {
        that.video.mozRequestFullScreen();
      } else if (that.video.webkitRequestFullscreen) {
        that.video.webkitRequestFullscreen();
      }
    };

    this._formatTime = function (sec) {
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

    var _init = function () {
      that.video.removeEventListener("loadeddata", _init);
      that.elTimeTotal().text(that._formatTime(that.video.duration));
      that.btnVolume().toggleClass('muted', that.video.muted);
      that.updateVolumeUI();
    };

    //btnFullscreen().click();
    this.bigPlayBtn().click(function (e) {
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

  // viewport units buggyfill
  viewportUnitsBuggyfill.init({
    force: true,
    refreshDebounceWait: 250
  });

  function hasTouch() {
    return 'ontouchstart' in document.documentElement || navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;
  }

  if (!hasTouch()) { // remove all :hover stylesheets
    try { // prevent exception on browsers not supporting DOM styleSheets properly
      for (var si in document.styleSheets) {
        var styleSheet = document.styleSheets[si];
        if (!styleSheet.rules) continue;

        for (var ri = styleSheet.rules.length - 1; ri >= 0; ri--) {
          if (!styleSheet.rules[ri].selectorText) continue;

          if (styleSheet.rules[ri].selectorText.match(':hover')) {
            styleSheet.deleteRule(ri);
          }
        }
      }
    } catch (ex) {
    }
  }

});

function convertRemToPixels(rem) {
  return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
}

//
// function nextAnim() {
//   var $el = $('.p-project-intro-wrapper.__next');
//   var $elBg = $('.p-project-intro-wrapper.__next .p-project-intro-bg');
//   var $elIntro = $('.p-project-intro-wrapper.__next .p-project-intro');
//   var $elIntroBody = $('.p-project-intro-wrapper.__next .p-project-intro-body');
//   var $elTitle = $('.p-project-intro-wrapper.__next .p-project-next-title');
//   var st = window.pageYOffset || document.documentElement.scrollTop;
//   var ph = ($('.p-project-intro-wrapper.__next').offset().top - st) - 30;
//
//   $elBg.transition({
//     scale: [1.05, 1]
//   }, 300, 'out');
//
//   $elTitle.transition({
//     opacity: 0,
//     delay: 350
//   }, 250, 'out');
//
//   $elBg.css({
//     height: $(window).height() + ph + 'px'
//   }).transition({
//     scale: 1,
//     marginTop: (0 - ph) + 'px',
//     delay: 300
//   }, 1500, 'out');
//
//   $el.transition({
//     scale: 1,
//     height: '100vh',
//     minHeight: '100vh',
//     delay: 400,
//     y: (0 - ph) + convertRemToPixels(14) + 'px'
//   }, 1000, 'in');
//
//   $elIntro.css({
//     overflow: 'visible'
//   }).transition({
//     height: '100vh',
//     minHeight: '100vh',
//     delay: 400
//   }, 750, 'out');
//
//   $elTitle.transition({
//     height: 0,
//     marginBottom: 0,
//     delay: 800
//   }, 500, 'out');
//
//   setTimeout(function() {
//     $elTitle.remove();
//   }, 2000);
// }
