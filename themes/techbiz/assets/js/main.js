(function($) {
    "use strict";

    /*===========================================
      Table of contents
      01. On Load Function
      02. Preloader
      03. Mobile Menu Active
      04. Sticky fix
      05. Scroll To Top
      06. Set Background Image
      07. Popup Sidemenu
      08. Search Box Popup
      09. Hero Slider Active
      10. Magnific Popup
      11. Filter Menu
      12. Tab Indicator
      13. Form Steps
      14. Quantity Adder
      15. Woocommerce Toggle
      16. Shop Big Image Src Set
    =============================================*/


    /*---------- 01. On Load Function ----------*/
    $(window).on('load', function () {
        $('.preloader').fadeOut();
        // slickFixer();
    });

    // function slickFixer() {
    //     setTimeout(function () {
    //       $('.slick-slider').each(function () {
    //           $(this).slick('refresh');
    //       });
    //   }, 400);
    // }
    // $(window).on('resize', function (){
    //     slickFixer()
    // });

    /*---------- 02. Preloader ----------*/
    if ($('.preloader').length > 0) {
        $('.preloaderCls').each(function() {
            $(this).on('click', function(e) {
                e.preventDefault();
                $('.preloader').css('display', 'none');
            })
        });
    };



    /*---------- 03. Mobile Menu Active ----------*/
    $.fn.vsmobilemenu = function(options) {
        var opt = $.extend({
            menuToggleBtn: '.vs-menu-toggle',
            bodyToggleClass: 'vs-body-visible',
            subMenuClass: 'vs-submenu',
            subMenuParent: 'vs-item-has-children',
            subMenuParentToggle: 'vs-active',
            meanExpandClass: 'vs-mean-expand',
            subMenuToggleClass: 'vs-open',
            toggleSpeed: 400,
        }, options);

        return this.each(function() {
            var menu = $(this); // Select menu

            // Menu Show & Hide
            function menuToggle() {
                menu.toggleClass(opt.bodyToggleClass);

                // collapse submenu on menu hide or show
                var subMenu = '.' + opt.subMenuClass;
                $(subMenu).each(function() {
                    if ($(this).hasClass(opt.subMenuToggleClass)) {
                        $(this).removeClass(opt.subMenuToggleClass);
                        $(this).css('display', 'none')
                        $(this).parent().removeClass(opt.subMenuParentToggle);
                    };
                });
            };

            // Class Set Up for every submenu
            menu.find('li').each(function() {
                var submenu = $(this).find('ul');
                submenu.addClass(opt.subMenuClass);
                submenu.css('display', 'none');
                submenu.parent().addClass(opt.subMenuParent);
                submenu.prev('a').addClass(opt.meanExpandClass);
                submenu.next('a').addClass(opt.meanExpandClass);
            });

            // Toggle Submenu
            function toggleDropDown($element) {
                if ($($element).next('ul').length > 0) {
                    $($element).parent().toggleClass(opt.subMenuParentToggle);
                    $($element).next('ul').slideToggle(opt.toggleSpeed);
                    $($element).next('ul').toggleClass(opt.subMenuToggleClass);
                } else if ($($element).prev('ul').length > 0) {
                    $($element).parent().toggleClass(opt.subMenuParentToggle);
                    $($element).prev('ul').slideToggle(opt.toggleSpeed);
                    $($element).prev('ul').toggleClass(opt.subMenuToggleClass);
                };
            };

            // Submenu toggle Button
            var expandToggler = '.' + opt.meanExpandClass;
            $(expandToggler).each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    toggleDropDown(this);
                });
            });

            // Menu Show & Hide On Toggle Btn click
            $(opt.menuToggleBtn).each(function() {
                $(this).on('click', function() {
                    menuToggle();
                })
            })

            // Hide Menu On out side click
            menu.on('click', function(e) {
                e.stopPropagation();
                menuToggle()
            })

            // Stop Hide full menu on menu click
            menu.find('div').on('click', function(e) {
                e.stopPropagation();
            });

        });
    };

    $('.vs-menu-wrapper').vsmobilemenu();



    /*---------- 04. Sticky fix ----------*/
    var lastScrollTop = '';
    var scrollToTopBtn = '.scrollToTop'

    function stickyMenu($targetMenu, $toggleClass, $parentClass) {
        var st = $(window).scrollTop();
        if ($(window).scrollTop() > 600) {
            var height = $targetMenu.css('height');
            $targetMenu.parent().css('min-height', height).addClass($parentClass);

            if (st > lastScrollTop) {
                $targetMenu.removeClass($toggleClass);
            } else {
                $targetMenu.addClass($toggleClass);
            };
        } else {
            $targetMenu.parent().css('min-height', '').removeClass($parentClass);
            $targetMenu.removeClass($toggleClass);
        };
        lastScrollTop = st;
    };
    $(window).on("scroll", function() {
        stickyMenu($('.sticky-active'), "active", "will-sticky");
        if ($(this).scrollTop() > 500) {
            $(scrollToTopBtn).addClass('show');
        } else {
            $(scrollToTopBtn).removeClass('show');
        }
    });

    /*---------- 05. Scroll To Top ----------*/
    $(scrollToTopBtn).each(function() {
        $(this).on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, lastScrollTop / 3);
            return false;
        });
    })

    /*---------- 06.Set Background Image ----------*/
    if ($('[data-bg-src]').length > 0) {
        $('[data-bg-src]').each(function() {
            var src = $(this).attr('data-bg-src');
            $(this).css({
                'background-image': 'url(' + src + ')'
            });
        });
    };

    if ($('[data-bg-color]').length > 0) {
        $('[data-bg-color]').each(function() {
            var color = $(this).attr('data-bg-color');
            $(this).css({
                'background-color': color
            });
        });
    };


    /*---------- 07. Popup Sidemenu ----------*/
    function popupSideMenu($sideMenu, $sideMunuOpen, $sideMenuCls, $toggleCls) {
        // Sidebar Popup
        $($sideMunuOpen).on('click', function(e) {
            e.preventDefault();
            $($sideMenu).addClass($toggleCls);
        });
        $($sideMenu).on('click', function(e) {
            e.stopPropagation();
            $($sideMenu).removeClass($toggleCls)
        });
        var sideMenuChild = $sideMenu + ' > div';
        $(sideMenuChild).on('click', function(e) {
            e.stopPropagation();
            $($sideMenu).addClass($toggleCls)
        });
        $($sideMenuCls).on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $($sideMenu).removeClass($toggleCls);
        });
    };
    popupSideMenu('.sidemenu-wrapper', '.sideMenuToggler', '.sideMenuCls', 'show');


    /*---------- 08. Search Box Popup ----------*/
    function popupSarchBox($searchBox, $searchOpen, $searchCls, $toggleCls) {
        $($searchOpen).on('click', function(e) {
            e.preventDefault();
            $($searchBox).addClass($toggleCls);
        });
        $($searchBox).on('click', function(e) {
            e.stopPropagation();
            $($searchBox).removeClass($toggleCls);
        });
        $($searchBox).find('form').on('click', function(e) {
            e.stopPropagation();
            $($searchBox).addClass($toggleCls);
        });
        $($searchCls).on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $($searchBox).removeClass($toggleCls);
        });
    };
    popupSarchBox('.popup-search-box', '.searchBoxTggler', '.searchClose', 'show');



    /*----------- 10. Magnific Popup ----------*/
    /* magnificPopup img view */
    $('.popup-image').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    /* magnificPopup video view */
    $('.popup-video').magnificPopup({
        type: 'iframe'
    });

    /*----------- 11. Filter Menu ----------*/
    $('.filter-active').imagesLoaded(function() {
        var $filter = '.filter-active',
            $filterItem = '.filter-item',
            $filterMenu = '.filter-menu-active';

        if ($($filter).length > 0) {
            var $grid = $($filter).isotope({
                itemSelector: $filterItem,
                filter: '*',
                masonry: {
                    // use outer width of grid-sizer for columnWidth
                    columnWidth: $filterItem
                }
            });

            // filter items on button click
            $($filterMenu).on('click', 'button', function() {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });

            // Menu Active Class
            $($filterMenu).on('click', 'button', function(event) {
                event.preventDefault();
                $(this).addClass('active');
                $(this).siblings('.active').removeClass('active');
            });
        };
    });

    /*----------- 12. Tab Indicator ----------*/
    $.fn.indicator = function() {
        var $menu = $(this),
            $linkBtn = $menu.find('a'),
            $btn = $menu.find('button');
        // Append indicator
        $menu.append('<span class="indicator"></span>');
        var $line = $menu.find('.indicator');
        // Check which type button is Available
        if ($linkBtn.length) {
            var $currentBtn = $linkBtn;
        } else if ($btn.length) {
            var $currentBtn = $btn
        }
        // On Click Button Class Remove
        $currentBtn.on('click', function(e) {
            e.preventDefault();
            $(this).addClass('active');
            $(this).siblings('.active').removeClass('active');
            linePos()
        })
        // Indicator Position
        function linePos() {
            var $btnActive = $menu.find('.active'),
                $height = $btnActive.css('height'),
                $width = $btnActive.css('width'),
                $top = $btnActive.position().top + 'px',
                $left = $btnActive.position().left + 'px';
            $line.css({
                top: $top,
                left: $left,
                width: $width,
                height: $height,
            })
        }
        linePos()
    }

    // Call On Load
    if ($('.filter-menu').length) {
        $('.filter-menu').indicator();
    }

    if ($('.product-tab').length) {
        $('.product-tab').indicator();
    }

    /*----------- 15. Woocommerce Toggle ----------*/
    // Woocommerce Rating Toggle
    $('.rating-select .stars a').each(function() {
        $(this).on('click', function(e) {
            e.preventDefault();
            $(this).siblings().removeClass('active');
            $(this).parent().parent().addClass('selected');
            $(this).addClass('active');
        });
    })

    /*----------- 16. Shop Big Image Src Set ----------*/
    if ($('.product-thumb').length) {
        $('.product-thumb').each(function() {
            $(this).on('click', function() {
                var src = $(this).find('img').data('big-img');
                $('.img-fullsize img').attr('src', src);
                $('.img-fullsize .popup-image').attr('href', src);
            })
        })
    }

    $('.product-big-img.vs-carousel').slick({
        dots: true,
        infinite: true,
        arrows: false,
        prevArrow: '<button type="button" class="slick-prev"><i class="far fa-arrow-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="far fa-arrow-right"></i></button>',
        autoplay: true,
        autoplaySpeed: 6000,
        fade: false,
        speed: 1000,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    $('.blog-img-slider').slick({
        dots: false,
        infinite: true,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="far fa-arrow-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="far fa-arrow-right"></i></button>',
        autoplay: true,
        autoplaySpeed: 6000,
        fade: false,
        speed: 1000,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    $(document).on('click', '.quantity-plus,.quantity-minus', function(e) {
        e.preventDefault();
        // Get current quantity values
        var qty = $(this).closest('.product-quantity').find('.qty');
        var val = parseFloat(qty.val());
        var max = parseFloat(qty.attr('max'));
        var min = parseFloat(qty.attr('min'));
        var step = parseFloat(qty.attr('step'));

        // Change the value if plus or minus
        if ($(this).is('.quantity-plus')) {
            if (max && (max <= val)) {
                qty.val(max);
            } else {
                qty.val(val + step);
            }
        } else {
            if (min && (min >= val)) {
                qty.val(min);
            } else if (val > 0) {
                qty.val(val - step);
            }
        }
        $('.cart_table button[name="update_cart"]').prop('disabled', false);
    });


    /*----------- 10. Filter Menu ----------*/
	$('.search-active').imagesLoaded(function() {
		var $filter = '.search-active',
			$filterItem = '.grid-item';

		if ($($filter).length > 0) {
			var $grid = $($filter).isotope({
				itemSelector: $filterItem,
				filter: '*',
				masonry: {
					// use outer width of grid-sizer for columnWidth
					columnWidth: $filterItem
				}
			});
		};
	});
    
    function setPos (element) {
        var indicator = element.siblings('.indicator'),
        btnWidth = element.css('width'),
        btnHiehgt = element.css('height'),
        btnLeft = element.position().left,
        btnTop = element.position().top;
        element.addClass('active').siblings().removeClass('active');
        indicator.css({
            left: btnLeft + 'px',
            top: btnTop + 'px',
            width: btnWidth,
            height: btnHiehgt,
        })
    };

    $('.login-tab a').each(function(){
        var link = $(this);
        if (link.hasClass('active')) setPos(link);
        link.on('mouseover', function(){
            setPos($(this));
        });
    })
    
    function popupSarchBox($searchBox, $searchOpen, $searchCls, $toggleCls) {
        $($searchOpen).on('click', function(e) {
            e.preventDefault();
            $($searchBox).addClass($toggleCls);
        });
        $($searchBox).on('click', function(e) {
            e.stopPropagation();
            $($searchBox).removeClass($toggleCls);
        });
        $($searchBox).find('form').on('click', function(e) {
            e.stopPropagation();
            $($searchBox).addClass($toggleCls);
        });
        $($searchCls).on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $($searchBox).removeClass($toggleCls);
        });
    };
    popupSarchBox('.popup-search-box', '.searchBoxTggler', '.searchClose', 'show');
    
    $('.product-img-slide').slick({
        dots: true,
        infinite: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 6000,
        fade: true,
        speed: 1000,
        slidesToShow: 1,
        slidesToScroll: 1,
    });
    
    $('.related-product-slider').slick({
        dots: false,
        infinite: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 6000,
        fade: false,
        speed: 1000,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 2
            }
        },{
            breakpoint: 767,
            settings: {
                slidesToShow: 1
            }
        }]
    });
    
    
    const tabs = document.querySelectorAll('[data-tab-target]')
    const tabContents = document.querySelectorAll('[data-tab-content]')
  
    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const target = document.querySelector(tab.dataset.tabTarget)
        tabContents.forEach(tabContent => {
          tabContent.classList.remove('active')
        })
        tabs.forEach(tab => {
          tab.classList.remove('active')
        })
        tab.classList.add('active')
        target.classList.add('active')
      })
    })

    $('.logo-img').each(function () {
	    var $img = jQuery(this);
	    var imgID = $img.attr('id');
	    var imgClass = $img.attr('class');
	    var imgURL = $img.attr('src');

	   jQuery.get(imgURL, function (data) {
		   // Get the SVG tag, ignore the rest
		   var $svg = jQuery(data).find('svg');

		   // Add replaced image's ID to the new SVG
		   if (typeof imgID !== 'undefined') {
			   $svg = $svg.attr('id', imgID);
		   }
		   // Add replaced image's classes to the new SVG
		   if (typeof imgClass !== 'undefined') {
			   $svg = $svg.attr('class', imgClass + ' replaced-svg');
		   }

		   // Remove any invalid XML tags as per http://validator.w3.org
		   $svg = $svg.removeAttr('xmlns:a');

		   // Check if the viewport is set, else we gonna set it if we can.
		   if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
			   $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'));
		   }

		   // Replace image with new SVG
		   $img.replaceWith($svg);

	   }, 'xml');
    });

})(jQuery);