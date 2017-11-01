$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /* Experts List */

    function ExpertsList(element) {

        var that = this;

        var $el = $(element);
        var $show_more_link = $('.show_more', $el);

        this.total = parseInt($el.data('total'));
        this.spec = null;
        this.industry = null;
        this.phrase = null;

        this.items = [];
        this.currentLast = 0;

        var itemSelector = '.home-expert';

        var tpl = $(itemSelector, $el).eq(0).clone();
        var format = 'desktop';


        this.renderExpert = function(data) {
            var html = tpl.clone();

            var img = $('<img />').attr('class', $('.b-expert-photo img', html).attr('class')).attr('src', data.photo);
            $('.b-expert-photo img', html).replaceWith(img);
            $('.b-expert-title a', html).text(data.name);
            $('.b-expert-status', html).text(data.status);
            $('.b-expert__link', html).attr('href', data.href);
            $('.b-expert-descr', html).text(data.descr);

            return html.hide();
        };

        this.updatePagination = function(total) {
            if(!total) {
                total = this.total;
            }

            var showed = $(itemSelector+':not(:hidden)', $el).length;

            var $link = $('.show_more', $el);

            $link.toggle(showed < total);
        };

        this.setSpec = function(spec_id) {
            spec_id = parseInt(spec_id);
            spec_id = (isNaN(spec_id) || spec_id <= 0 ? null : spec_id);

            if(this.spec != spec_id) {
                this.currentLast = 0;
                this.spec = spec_id;
                this.load();
            }
        };

        this.setIndustry = function(industry_id) {
            industry_id = parseInt(industry_id);
            industry_id = (isNaN(industry_id) || industry_id <= 0 ? null : industry_id);

            if(this.industry != industry_id) {
                this.currentLast = 0;
                this.industry = industry_id;
                this.load();
            }
        };

        this.setPhrase = function(phrase) {
            phrase = (typeof phrase == 'string' && phrase != '' ? phrase : null);
            if(phrase) {
                phrase.replace(/[ ]{2,}/i, ' ');
                phrase.replace(/^ +/i, '');
                phrase.replace(/ +;/i, '');
            }

            if(this.phrase != phrase) {
                this.currentLast = 0;
                this.phrase = phrase;
                this.load();
            }
        };

        this.load = function(more) {
            more = (typeof more == 'boolean' ? more : false);

            var req_data = {
                spec_id: this.spec,
                industry_id: this.industry,
                phrase: this.phrase,
                limit: 8,
                offset: (this.currentLast <= 0 ? (more ? 8 : 0) : this.currentLast)
            };

            $.get('/experts', req_data, function(data) {
                that.onResponse(data, more);
            }, 'json').fail(function() {
                alert('Ошибка сервера');
            });
        };

        this.onResponse = function(data, more) {
            var $cnt = $('.home-experts .list');
            $('.empty-warn', $el).hide();

            if(data && 'total' in data && data.total > 0) {
                this.total = data.total;

                if(more) {
                    if(this.currentLast == 0) {
                        this.currentLast = (format == 'desktop' ? 8 : 3);
                    }
                    this.currentLast += (format == 'desktop' ? 8 : 3);
                } else {
                    this.currentLast = 0;
                    $cnt.empty();
                }

                $row = $('>.row', $cnt).eq(0);
                if($row.length <= 0) {
                    $row = $('<div class="row" />');
                    $cnt.append($row);
                }
                for(var i = 0; i < data.items.length; i++) {
                    $row.append( this.renderExpert(data.items[i]) );
                }

                var _sel = itemSelector+':lt(' + (this.currentLast > 0 ? this.currentLast : (format == 'desktop' ? 8 : 3)) + ')';
                $(_sel, $el).show();
            } else {
                this.total = 0;
                $cnt.empty();
                $('.empty-warn', $el).show();
            }

            this.updatePagination();
        };

        this.showMore = function() {
            var nextCount = (this.currentLast == 0 ? (format == 'desktop' ? 8 : 3) : this.currentLast);
            nextCount += (format == 'desktop' ? 8 : 3);

            var currentCount = $(itemSelector+':not(:hidden)', $el).length;

            if(format == 'mobile') {
                var total = $(itemSelector, $el).length;
                var hiddenCount = $(itemSelector + ':hidden', $el).length;

                if(hiddenCount < 3) {
                    this.load(true);
                } else {
                    $(itemSelector, $el).show().filter(':gt(' + (nextCount - 1) + ')').hide();
                }
            } else {
                this.load(true);
                $(itemSelector, $el).show();
            }
        };

        function detectFormat() {
            if($(window).width() < 576) {
                $('.desktop', $el).hide();
                format = 'mobile';
            } else {
                $('.mobile', $el).hide();
                format = 'desktop';
            }

            $('.'+format, $el).show();

            if(format == 'desktop') {
                $(itemSelector, $el).show();
            } else {
                $(itemSelector).show().filter(':gt(' + ((that.currentLast > 0 ? that.currentLast : 3) - 1) + ')', $el).hide();
            }

            that.updatePagination();
        }

        $(window).resize(detectFormat);
        detectFormat();
    }

    /* /Experts List */

    /* Popup */
    function Popup(element, opts) {
        var that = this;

        var $el = $(element);
        var attached = false;
        var $skeleton = null;

        opts = $.extend({
            className: '',
            show: true
        }, opts);

        opts.className = (typeof opts.className == 'string' ? opts.className : '');

        this.show = function() {
            if(attached) {
                return false;
            }

            closeCurrentPopups();

            $skeleton = $('<div class="b-popup ' + opts.className + '">' +
                '<div class="b-popup-wrapper">' +
                    '<a href="javascript:void(0)" class="b-popup-close b-popup-close__icon"></a>' +
                    '<div class="b-popup-content"></div>' +
                '</div>' +
            '</div>');
            var $content = $('.b-popup-content', $skeleton);

            $content.append($el);
            $skeleton.data('popup', that);
            var dw = $(document).width();
            $('body').append($skeleton).addClass('popup-open');
            var dwh = $(document).width();

            $('.wrapper').css('right', parseInt((dwh-dw)/2)+'px');

            console.log(dw, dwh);
            attached = true;

            if('onShow' in opts && typeof opts.onShow == 'function') {
                opts.onShow();
            }
        };

        function closeCurrentPopups() {
            $('.b-popup').each(function() {
                var p = $(this).data('popup');
                if(p && p instanceof Popup) {
                    p.close();
                }
            })
        }

        this.close = function() {
            if(attached && $skeleton) {
                $skeleton.hide();
                $('.wrapper').removeAttr('style');
                $('body').removeClass('popup-open');
                $('.popups').append($el);
                $('form', $el).each(function() {
                    this.reset();
                });
                $skeleton.remove();
            }
        };

        if(opts.show) {
            this.show();
        }
    }
    /* /Popup */

    /* Become Form/Popup */
    function BecomeForm() {
        var that = this;

        var popup = null;
        var file_changed = false;
        var file_valid = false;

        var mimes = [
            'application/pdf',
            'text/plain',
            'application/excel',
            'application/vnd.ms-excel',
            'application/x-excel',
            'application/x-msexcel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];

        $form = $('.f-become form');

        this.show = function() {
            popup = new Popup('.f-become', { className: 'b-popup-become' });
        };

        this.submit = function(e) {
            e.preventDefault();

            if(file_changed && ! file_valid) {
                alert('Выберите файл допустимого формата.');
                return;
            }

            var data = new FormData($form[0]);

            $('input, select, textarea, button', $form).prop('disabled', true).attr('disabled', 'disabled').addClass('disabled').blur();

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: $form.attr('action'),
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 60000
            })
                .always(function() {
                    $('input, select, textarea, button', $form).prop('disabled', false).removeAttr('disabled', 'disabled').removeClass('disabled');
                })
                .done(function(data) {
                    if(data && typeof data == 'object' && 'success' in data) {
                        if(data.success == true) {
                            (new Popup($('<div class="b-message"><p>Ваша заявка отправлена!</p><a href="javascript:void(0)" class="button b-popup-button b-popup-close">Закрыть</a></div>')))
                        }
                    }
                })
                .fail(function() {
                    alert('error');
                    console.log(arguments);
                    debugger;
                })
            ;
        };

        function onFormReset() {
            $('.b-form-file-current', $form).removeClass('invalid').empty().hide();
        }

        // validate file
        $('input[type=file]').on('change', function() {
            console.log(arguments);

            var file = this.files;
            if(file && file.length > 0) {
                file = file[0];
            }

            $('.b-form-file-current', $form).removeClass('invalid').empty().hide();

            if(file && file instanceof File) {
                file_changed = true;
                file_valid = mimes.indexOf(file.type) != -1;
                $('.b-form-file-current', $form).text(file.name).show();
                if(! file_valid) {
                    $('.b-form-file-current', $form).addClass('invalid');
                }
            } else {
                file_changed = false;
            }
        });
        $form
            .on('submit', this.submit)
            .on('reset', onFormReset)
        ;
    }
    /* /Become Form/Popup */

    /* Order Form/Popup */
    function OrderForm() {
        var that = this;

        var popup = null;

        $form = $('.f-order form');

        this.show = function() {
            popup = new Popup('.f-order', { className: 'b-popup-order' });
        };

        this.submit = function(e) {
            e.preventDefault();

            var data = new FormData($form[0]);

            $('input, select, textarea, button', $form).prop('disabled', true).attr('disabled', 'disabled').addClass('disabled').blur();

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: $form.attr('action'),
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 30000,
                dataType: 'json'
            })
                .always(function() {
                    $('input, select, textarea, button', $form).prop('disabled', false).removeAttr('disabled', 'disabled').removeClass('disabled');
                })
                .done(function(data) {
                    if(data && typeof data == 'object' && 'success' in data) {
                        if(data.success == true) {
                            (new Popup($(data.form), {
                                onShow: function() {
                                    $('#kassa').submit();
                                }
                            }))
                        }
                    }
                })
                .fail(function() {
                    alert('error');
                    console.log(arguments);
                    debugger;
                })
            ;
        };

        $form
            .on('submit', this.submit)
        ;
    }
    /* /Order Form/Popup */

    $('[data-inputmask]').inputmask();

    if(document.getElementById('home-clients')) {
        new Swiper('.home-clients-slider .swiper-container', {
            nextButton: '.home-clients-slider .swiper-button-next.custom-swiper-button',
            prevButton: '.home-clients-slider .swiper-button-prev.custom-swiper-button',
            slidesPerView: 'auto'
        });
    }

    if(document.getElementsByClassName('p-expert-related-swiper').length > 0) {
        new Swiper('.p-expert-related-swiper .swiper-container', {
            nextButton: '.p-expert-related-swiper .swiper-button-next.custom-swiper-button',
            prevButton: '.p-expert-related-swiper .swiper-button-prev.custom-swiper-button',
            slidesPerView: 'auto'
        });
    }

    var experts_list;
    if(document.getElementsByClassName('home-experts').length > 0) {
        experts_list = new ExpertsList('.home-experts');

        $(document)
            .on('change', '.experts-form [name=industry]', function() {
                experts_list.setIndustry($(this).val());
            })
            .on('change', '.experts-form [name=spec]', function() {
                experts_list.setSpec($(this).val());
            })
            .on('click', '.experts-form .experts-form-submit-search', function(e) {
                e.preventDefault();
                experts_list.setPhrase($('.experts-form [name=phrase]').val());
            })
            .on('submit', '.experts-form', function(e) {
                e.preventDefault();
                experts_list.setPhrase($('.experts-form [name=phrase]').val());
            })
            .on('keyup', '.experts-form [name=phrase]', function() {
                $(this).parents('.experts-form-search').toggleClass('has-value', $(this).val() != '');
            })
            .on('click', '.experts-form .experts-form-clear-search', function(e) {
                e.preventDefault();
                $('.experts-form [name=phrase]').val('').trigger('keyup');
                experts_list.setPhrase('');
            })
            .on('click', '.home-experts .show_more', function(e) {
                e.preventDefault();
                experts_list.showMore();
            })
        ;
    }

    $(document)
        .on('click', '.intro-start-btn', function(e) {
            e.preventDefault();
            $('html, body').animate({'scrollTop':$(window).height()}, 700);
        })
        .on('click', 'a[href*="#"]', function(e) {
            var sel = '#' + $(this).attr('href').split('#')[1];
            if(sel.length > 1 && $(sel).length > 0) {
                e.preventDefault();
                $('html, body').animate({'scrollTop':$(sel).offset().top}, 700);
            }
        });
    ;

    var form_become = null;
    if(document.getElementsByClassName('f-become').length > 0) {
        form_become = new BecomeForm();
    }

    var form_order = null;
    if(document.getElementsByClassName('f-order').length > 0) {
        form_order = new OrderForm();
    }

    if(document.getElementsByClassName('f-order_result').length > 0) {
        (new Popup('.f-order_result', {
            'className': 'b-popup-order_result'
        }));
    }

    $(document)
        .on('click', '.b-popup-close', function(e) {
            e.preventDefault();
            var p = $(this).parents('.b-popup').data('popup');
            if(p && p instanceof Popup) {
                p.close();
            }
        })
        .on('click', '#home-become .btn', function(e) {
            e.preventDefault();
            form_become.show();
        })
        .on('click', '.p-expert .b-coop-list__item:not(.muted) .b-coop-list__button', function(e) {
            e.preventDefault();
            form_order.show();
        })
        .on('click', '.js-popup-contacts', function(e) {
            (new Popup('.f-contacts', {
                'className': 'b-popup-contacts'
            }));
        })
        .on('click', '.navbar-toggle', function (e) {
            e.preventDefault();

            var isExpand = $('.navbar-custom .navbar-collapse').hasClass('in');
            if(isExpand) {
                $('.navbar-custom, .navbar-custom .navbar-collapse, .navbar-custom .navbar-toggle').removeClass('in');
                //$('body').addClass('popup-open');
            } else {
                $('.navbar-custom, .navbar-custom .navbar-collapse, .navbar-custom .navbar-toggle').addClass('in');
                //$('body').removeClass('popup-open');
            }
        })
        .on('click', '.navbar-custom .nav li a', function() {
            $('.navbar-custom, .navbar-custom .navbar-collapse, .navbar-custom .navbar-toggle').removeClass('in');
        })
        /*.on('keyup', function(e) {
            if(e.keyCode == 27 && $('.b-popup').length > 0) {
                var p = $('.b-popup').data('popup');
                if(p && p instanceof Popup) {
                    p.close();
                }
            }
        })*/
    ;
});