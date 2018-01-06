
(function($) {
    'use strict';

    $(document).ready(function() {
        // Initializes search overlay plugin.
        // Replace onSearchSubmit() and onKeyEnter() with
        // your logic to perform a search and display results
        $(".list-view-wrapper").scrollbar();

        $('[data-pages="search"]').search({
            // Bind elements that are included inside search overlay
            searchField: '#overlay-search',
            closeButton: '.overlay-close',
            suggestions: '#overlay-suggestions',
            brand: '.brand',
            // Callback that will be run when you hit ENTER button on search box
            onSearchSubmit: function(searchString) {
                console.log("Search for: " + searchString);
            },
            // Callback that will be run whenever you enter a key into search box.
            // Perform any live search here.
            onKeyEnter: function(searchString) {
                console.log("Live search for: " + searchString);
                var searchField = $('#overlay-search');
                var searchResults = $('.search-results');

                /*
                    Do AJAX call here to get search results
                    and update DOM and use the following block
                    'searchResults.find('.result-name').each(function() {...}'
                    inside the AJAX callback to update the DOM
                */

                // Timeout is used for DEMO purpose only to simulate an AJAX call
                clearTimeout($.data(this, 'timer'));
                searchResults.fadeOut("fast"); // hide previously returned results until server returns new results
                var wait = setTimeout(function() {

                    searchResults.find('.result-name').each(function() {
                        if (searchField.val().length != 0) {
                            $(this).html(searchField.val());
                            searchResults.fadeIn("fast"); // reveal updated results
                        }
                    });
                }, 500);
                $(this).data('timer', wait);

            }
        })

        var mainSearchForm = $('.main-search-form');
        $( mainSearchForm ).keyup(function() {
            showSearchListModal();
        });
        $(mainSearchForm).focus(function(e) {
            e.stopPropagation();
            showSearchListModal();
        });

        $(mainSearchForm).on('click', function(e) {
            e.stopPropagation();
            showSearchListModal();
        })
        function showSearchListModal () {
            $('.search-result-mini').show();
            if (mainSearchForm.val() !== '') {
                $('.search-list').show();
                $('.search-list.alt').hide();
                $('.read-more').show();
                $('.read-more .plxKeyword').text(mainSearchForm.val());
                if($('#myUL > li:visible').length === 0) {
                    $('#myUL').hide();
                }
            } else {
                $('.search-list').hide();
                $('.read-more').hide();
                $('.search-list.alt').show();
            }
        }
        $(document).on('click', function(e) {
            var searchResult = $('.search-result-mini');
            if (!searchResult.is(e.target) && searchResult.has(e.target).length === 0) {
                searchResult.hide();
            }
        })
    });



    $('.panel-collapse label').on('click', function(e){
        e.stopPropagation();
    })

    // auto init for parallax sets window as scrollElement.
    // set .page-container as scrollElement for horizontal layouts.
    $('.jumbotron').parallax({
        scrollElement: '.page-container'
    })

    $('.page-container').on('scroll', function() {
        $('.jumbotron').parallax('animate');
    });

    shouldInit();


    $(document).on('click', '.toggleComment', function (e) {
        e.preventDefault();

        var target = $(this).attr('href');
        $(target).toggle();
    });

    $(document).on('click', '.sharePopup', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var target = $(this).attr('href');
        $(target).toggle();
    });
    $(document).on('click', '.btnClose', function (e) {
        e.preventDefault();
        var target = $(this).attr('href');
        $(target).hide();
    });
    //
    $(document).on('click', '.options-dot', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var optionList = $(this).closest('.options').children('.options-list');
        $(optionList).fadeToggle(100);
    });


    $(document).on('click', '.show-list-btn', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var targetList = $(this).closest('.total-likes').children('.like-list');
        $(targetList).toggle();
    })

    $('.loadmore-level').mouseover(function () {
        var targetList = $(this).children('.cu-list-warp');
        $(targetList).show();
    });
    $('.loadmore-level').mouseleave(function () {
        var targetList = $(this).children('.cu-list-warp');
        $(targetList).hide();
    })

    $(document).on('click', function(e) {
        var socialListModal = $('.social-list-modal');
        var optionList = $('.options-list');
        var totalLikes = $('.like-list');
        if (!socialListModal.is(e.target) && socialListModal.has(e.target).length === 0) {
            socialListModal.hide();
        }
        if (!optionList.is(e.target) && optionList.has(e.target).length === 0) {
            optionList.hide();
        }
        if (!totalLikes.is(e.target) && totalLikes.has(e.target).length === 0) {
            totalLikes.hide();
        }
    });

    $('.comment-form').each(function () {
        var input = $(this).children('input[type="text"]');
        var submitBtn =  $(this).children('.submit-btn');
        if (!($(input).val() === '')) {
            $(submitBtn).prop('disabled', false);
        } else {
            $(submitBtn).prop('disabled', true);
        }

        $(input).keyup(function () {
            if (!($(input).val() === '')) {
                $(submitBtn).prop('disabled', false);
            } else {
                $(submitBtn).prop('disabled', true);
            }
        })
    })

    $('.filter-block').each(function () {
        var input = $(this).find('input');
        $(input).on('change', function() {
            $(input).not(this).prop('checked', false);
        });
    })

    plxTab('.sidebar-nav-tab li a', '.tab-item');
    plxTab('.plx__tabs a', '.plx__tabs-item');
    plxTab('.forPost a', '.forPostContent');
    plxTab('.forFollowing a', '.forFollowingContent');

    $('#chat').on('click', '.newConversionForm', function (e) {
        e.preventDefault();
        $('#chat').addClass('push-parrallax');
    });
    $('#chat').on('click', '.closeConversionForm', function (e) {
        e.preventDefault();
        $('#chat').removeClass('push-parrallax');
    })
})(window.jQuery);

function plxTab (action, target) {
    $(document).on('click', action, function (e) {
        e.preventDefault();
        var targetElm = $(this).attr('href');
        $(action).removeClass('active');
        $(this).addClass('active');
        $(target).removeClass('active');
        $(targetElm).addClass('active');
    })
}

function shouldInit() {

    $('.plx__countdown').each(function () {
        var dateTime = $(this).data('date-time');
        $(this).countdown(dateTime, function (e) {
            $(this).html(e.strftime(`
                <span class="number day">%D</span>d :
                <span class="number hour">%H</span>h :
                <span class="number minutes">%M</span>m :
                <span class="number seconds">%S</span>s
            `));
        })
    });
}