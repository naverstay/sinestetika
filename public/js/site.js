$(function () {
  var prevent_hide_nav = false;
  var busy = false;
  var $html = $('html');
  var didScroll;
  var boardGrid;
  var lastScrollTop = 0;
  var delta = 5;

  function fixWebkitStyle() {
    var css = '.b-project:hover .b-project-info{opacity: 1;}' +
      'a:hover,a:focus{text-decoration:none;color: #0000fe;}' +
      '.p-project-section .v-controls .v-controls-bar .v-volume:hover .v-volume-bar {display: inline-block;}' +
      'a.b-tags-item:hover,a.b-tags-item:active, a.b-tags-item:focus{color: #fff;}' +
      'a.b-tags-item:hover:before,a.b-tags-item:active:before,a.b-tags-item:focus:before {border-width: 2px;}' +
      // '.__anim_wave .navbar-circle { -webkit-transform: scale(80); -ms-transform: scale(80); transform: scale(80);}.__anim_wave .__skip-circle .navbar-circle { -webkit-animation-name: none !important; animation-name: none !important; -webkit-transform: scale(0) !important; -ms-transform: scale(0) !important; transform: scale(0) !important; opacity: 0; -webkit-box-shadow: none !important; box-shadow: none !important; }' +
      '.intro-arrow:hover{padding-top: 35px;padding-bottom: 25px;}',
      head = document.head || document.getElementsByTagName('head')[0],
      style = document.createElement('style');

    style.type = 'text/css';
    if (style.styleSheet) {
      style.styleSheet.cssText = css;
    } else {
      style.appendChild(document.createTextNode(css));
    }

    head.appendChild(style);

    setTimeout(function () {
      $(style).text('.b-project:hover .b-project-info{opacity:1;}' +
        'a:hover,a:focus{text-decoration:none;color:#0000fe;}' +
        '.p-project-section .v-controls .v-controls-bar .v-volume:hover .v-volume-bar {display:inline-block;}' +
        'a.b-tags-item:hover,a.b-tags-item:active,a.b-tags-item:focus{color:#fff;}' +
        'a.b-tags-item:hover:before,a.b-tags-item:active:before,a.b-tags-item:focus:before {border-width:2px;}' +
        // '.__anim_wave .navbar-circle { -webkit-transform:scale(80); -ms-transform:scale(80);transform:scale(80);}.__anim_wave .__skip-circle .navbar-circle {-webkit-animation-name:none !important; animation-name:none !important; -webkit-transform:scale(0) !important;-ms-transform: scale(0) !important; transform:scale(0) !important; opacity:0; -webkit-box-shadow:none !important;box-shadow:none !important; }' +
        '.intro-arrow:hover{padding-top:35px;padding-bottom: 25px;}');
    }, 10);
  }


  // trigger only for homepage
  // that's why it's outside onPageLoaded
  homePreloader();

  fixWebkitStyle();

  // detect mobile devices

  function hasTouch() {
    return 'ontouchstart' in document.documentElement || navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;
  }

  function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
      "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
  }

  $html
    .toggleClass('is-mobile', /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
    .toggleClass('touchscreen', hasTouch());

  function animatePageLoad() {
    var projects = $('.loadedProject');

    if (!$('body').hasClass('__from-next') && projects.length > 0) {
      var wnd = $(window), wndH = wnd.height();

      projects.each(function () {
        var prj = $(this), css = 'scale(.91) translate3d(0,' +
          Math.min(200, (Math.max(0, wndH - prj.offset().top) + 10)) + 'px,0)';

        this.style.MozTransform = css;
        this.style.WebkitTransform = css;
        this.style.OTransform = css;
        this.style.MsTransform = css;
        this.style.transform = css;
      });
    }

    $('.__prevent_anim img').on('load', function (e) {
      $(this).parent().removeClass('__prevent_anim');
    }).each(function () {
      var img = $(this);
      img.attr('src', img.attr('src') + '?load=true');
    });

    if (!$html.hasClass('__hide_page')) {
      console.log('normal load');
      $html.addClass('_page_loaded');
    }

    setTimeout(function () {
      $html.removeClass('__anim_wave');

      // $html.addClass('__anim_wave_back');
      // $('.navbar-circle').removeClass('__anim');
      // $('body').removeClass('__skip-circle');
    }, 10);

    setTimeout(function () {
      console.log('delay load');

      $html.removeClass('__hide_page').addClass('_page_loaded');
      $('body').removeClass('__skip-circle');
    }, 300);

    // setTimeout(function () {
    //   $html.removeClass('__anim_wave_back __anim_wave');
    // }, 1000);

  }

  function homePreloader(skip_logo) {
    var $start_logo = $('.start-logo');

    // console.log(window.location.pathname === "/", $start_logo.length);

    if (window.location.pathname === "/" && $start_logo.length) {
      // if (skip_logo) {
      //   $('.start-logo').addClass('is-finnised');
      //   $('.brand-heading').addClass('__anim');

      $start_logo.addClass('is-started');
      // $('.intro').addClass('__anim');

      setTimeout(function () {
        $start_logo.addClass('is-finnised').hide();
      }, 3000);

    } else {
      console.log('skip start logo');
      // setTimeout(function () {
      $start_logo.addClass('is-finnised').hide();
      // $('.intro').addClass('__anim');
      // }, 1000);
    }
  }

  function onPageLoaded() {

    throttle(onScrollResize, 100);

    $('.p-project-section .p-project-section-slider:not(.slick-initialized)').each(function () {
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

    animatePageLoad();

    initBoard();
  }

  function checkHeader() {
    // Hide Header on scroll down
    var nb = $('.navbar');
    var st = getScrollTop();
    var navbarHeight = nb.outerHeight();

    if (prevent_hide_nav) {
      console.log(nb, prevent_hide_nav);
      nb.addClass('nav-down').removeClass('nav-up');
      prevent_hide_nav = false;
      return;
    }

    // setInterval(function () {
    if (didScroll) {
      hasScrolled();
      didScroll = false;
    }

    // }, 250);

    function hasScrolled() {
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

  function onScrollResize(hide_nav) {
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

    checkHeader(hide_nav);
  }

  var pages = {};

  function loadPage(path, hash) {
    if (pages.hasOwnProperty(path) == false) {
      pages[path] = $.get(path);
    }
    return pages[path];
  }

  function scrollToHash(hash) {
    if (hash) {
      var $hashEl = $(hash);
      if ($hashEl.length > 0) {

        $('html, body').animate({
          scrollTop: $hashEl.offset().top - 100
        }, 400);
      }
    }
  }

  function animationHandler(event) {
    if (event) {
      var $trg = $(event.target);
      var $project = $trg.hasClass('p-project-next') ? $trg : $trg.closest('.p-project-next');
      var $surf = $trg.hasClass('surfAnimate') ? $trg : $trg.closest('.surfAnimate');
      var $filter = $trg.hasClass('filterLink') ? $trg : $trg.closest('.filterLink');
      var anim_type = 'simple', fade_in_nav = null, skip_start = $surf.hasClass('surfAnimate');
      var delay = 450;

      // delay = 15000;

      if ($project.length > 0) { // переход с проекта на следующий проект
        anim_type = 'next';
        $project.addClass('__start_anim');
        $('.navbar-custom').addClass('__invis');

        setTimeout(function () {
          $project.addClass('__anim');
          $('body').addClass('__anim_next');

          // $('html, body').animate({
          //   scrollTop: 0
          // }, 0);
        }, 700);
      }

      if ($filter.length > 0) {
        anim_type = 'filter';
        delay = 0;
      }

      if ($surf.length > 0) { // переход на проект с главной
        var anim = $surf.attr('data-surf-animation');

        if (anim && anim.length && $surf.find(anim).length) {
          $('body').addClass('__fade_in_nav');

          // $('.navbar-custom.nav-down').addClass('__invis');

          $surf.addClass('__animate');

          fade_in_nav = true;
          anim_type = 'main';
          delay = 1200;
        }
      }

      if (anim_type === 'next') {
        delay = 1000;

        // nextAnim()
      } else {
        if (!($surf.length > 0 || $filter.length > 0)) {
          $html.addClass('__anim_wave __hide_page');
          // $('.navbar-circle').addClass('__anim');
        }
        if (anim_type !== 'filter') {
          $('body').removeClass('home').addClass('__intro' + (anim_type === 'main' ? '' : ' __leave'));
        }
      }
      return {
        fade_in_nav: fade_in_nav,
        delay: delay,
        anim_type: anim_type
      };
    }
  }

  function showPage(path, hash, event, is_back) {
    console.log('ajax', (busy ? 'busy' : 'start'));

    if (busy) return;

    busy = true;
    is_back = (typeof is_back === 'boolean' ? is_back : false);

    // console.log('showPage', path, hash, window.location.pathname);

    // if (path === window.location.pathname) {
    //   scrollToHash(hash);
    // } else {
    var xhr = loadPage(path, hash);
    xhr.done(function (html, state) {
      busy = false;

      console.log('ajax done');
      if (state === 'success') {
        var delay = 0;
        var $b = $('body');

        var animationHandlerCb = animationHandler(event);

        if (!is_back) {
          delay = animationHandlerCb.delay;
        }

        if (animationHandlerCb && animationHandlerCb.anim_type === 'simple') {
          console.log('simple anim_type');

          if ($('.navbar-custom').hasClass('nav-up')) {
            prevent_hide_nav = true;
          }
        }

        // console.log(animationHandlerCb);

        if (animationHandlerCb && animationHandlerCb.anim_type === "next") {
          // переход с проекта на следующий проект
          html = html.replace('navbar-custom', 'navbar-custom __invis').replace('__prevent_anim', '').replace('loadedProject', 'loadedProject __skip_anim');
        }

        if (animationHandlerCb && animationHandlerCb.fade_in_nav) {
          html = html.replace('navbar-custom', 'navbar-custom' + (prevent_hide_nav ? '' : ' __invis'));
        }

        var tit = html.match(/<title>(.*?)<\/title>/);
        var body_cls = html.match(/<body.*?class="(.*?)".*?>/);
        var $new_html = $(html);

        // if (animationHandlerCb && animationHandlerCb.anim_type === "main") {
        //   html = html.replace('navbar-custom', 'navbar-custom __invis').replace('loadedProject', 'loadedProject __prevent_anim');
        // }

        console.log(delay, animationHandlerCb ? animationHandlerCb.anim_type : ('back ' + is_back));

        setTimeout(function () {
          if (!is_back) {
            loadPage(window.location.pathname, window.location.hash);
            history.pushState(null, (tit[1] || null), path + hash);
            if (!(animationHandlerCb && animationHandlerCb.anim_type === "filter")) {
              // console.log('scrollTop 0');
              $('html, body').scrollTop(0);
            }
          }

          // $new_html.find('.navbar-circle').addClass('__anim');

          // console.log(body_cls, $b.attr('class'));

          $b.removeClass($b[0].className);

          if (body_cls && body_cls[1]) {
            var clss = body_cls[1].split(' ');
            for (var i = 0; i < clss.length; i++) {
              var cls = clss[i];
              if (cls !== '') {
                $b.addClass(cls);
              }
            }
          }

          if (animationHandlerCb && animationHandlerCb.anim_type === "next") {
            $b.addClass('__from-next __skip-circle');
          }

          if (animationHandlerCb && animationHandlerCb.anim_type === "main") {
            $b.addClass('__skip-circle');
          }

          if (animationHandlerCb && animationHandlerCb.fade_in_nav) {
            $('body').addClass('__fade_in_nav');
            // return false;
          }

          if (animationHandlerCb && animationHandlerCb.anim_type === "filter") {
            // фильтр проектов

            var $newItems = $($new_html.find('.gridItem'));

            $newItems.find('.b-project').addClass('__visible');

            if (boardGrid) {
              boardGrid.isotope('remove', $('.gridItem'));

              boardGrid.isotope('insert', $newItems);
            } else {
              initBoard();
            }

            $('.p-projects-filter').replaceWith($new_html.find('.p-projects-filter'));

          } else {
            if (animationHandlerCb && animationHandlerCb.anim_type === "next") {

            } else {
            }

            $('.s-page').replaceWith($new_html.filter('.s-page'));

            $('.nav-up').removeClass('nav-up');

            if (prevent_hide_nav) {
              $('.navbar-custom').addClass('nav-down');
            }

            initBoard();

            setTimeout(function () {
              console.log('remove __fade_in_nav');
              $('body').removeClass('__fade_in_nav');
              $('.navbar-custom').removeClass('__invis');

              onPageLoaded();

              scrollToHash(hash);
            }, 200);
          }

        }, delay);
      }
    });
    // }
  }

  function initBoard() {
    if ((boardGrid && boardGrid.length && boardGrid.data() && boardGrid.data('isotope'))) {
      setTimeout(function () {
        boardGrid.isotope('layout');
      }, 200);
    } else if ($('.boardGrid').length) {
      boardGrid = $('.boardGrid').isotope({
        percentPosition: true,
        gutter: 0,
        // main isotope options
        itemSelector: '.gridItem',
        // set layoutMode
        layoutMode: 'packery'
      });
    }
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

  function whichAnimationEvent() {
    var t;
    var el = document.createElement('fakeelement');
    var animations = {
      'animation': 'animationend',
      'OAnimation': 'oAnimationEnd',
      'MozAnimation': 'animationend',
      'WebkitAnimation': 'webkitAnimationEnd'
    };

    for (t in animations) {
      if (el.style[t] !== undefined) {
        return animations[t];
      }
    }
  }

  function onfullscreenchange() {
    $(this).toggleClass('__fs');
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
      var link = $(this);

      if (link.hasClass('scrollTo')) {
        scrollToHash(link.attr('href'));
        return false;
      }

      if (window.location.hostname == this.hostname) {
        if (window.location.pathname != this.pathname || window.location.hash != this.hash) {
          if ($(e.target).parents('.b-menu').length > 0) {
            toggleMenu();
          }

          showPage(this.pathname, this.hash, e);
        }
      }

      return false;
    });

  $(window).on('popstate', function (e) {
    e.preventDefault();
    var state = History.getState();

    // console.log('popstate', state, window.location.host);

    if (state) {
      var rx = new RegExp('.*' + window.location.host);
      var a = $('<a>').attr('href', state.url)[0];
      // console.log(a, rx, a.pathname.replace(rx, ''));
      showPage(a.pathname.replace(rx, ''), a.hash, null, true);
    }
  });

  function MyVideo(video) {
    video.controls = false;

    this.$el = $(video);
    this.$video_block = this.$el.closest('.videoBlock');
    var that = this;

    this.video = video;
    this.video.controls = false;

    that.$el.data('video', this);

    this.$video_block.on("fullscreenchange mozfullscreenchange webkitfullscreenchange", onfullscreenchange);

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
      console.log(e);
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

      if (that.$video_block.hasClass('__fs')) {
        if (document.cancelFullScreen) {
          document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
          document.webkitCancelFullScreen();
        }
      } else {
        if (that.$video_block[0].requestFullscreen) {
          that.$video_block[0].requestFullscreen();
        } else if (that.$video_block[0].mozRequestFullScreen) {
          that.$video_block[0].mozRequestFullScreen();
        } else if (that.$video_block[0].webkitRequestFullscreen) {
          that.$video_block[0].webkitRequestFullscreen();
        }
      }
    };

    this._formatTime = function (sec) {
      var t_min = Math.floor(sec / 60);
      var t_sec = Math.round(sec - (t_min * 60)).toString();
      t_sec = (t_sec.length === 1 ? '0' + t_sec : t_sec);

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

    if (this.video.readyState === 2) {
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
