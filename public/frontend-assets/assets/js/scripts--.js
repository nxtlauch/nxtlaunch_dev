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
    $(document).on('click', '.leaveComment', function (e) {
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
        const optionList = $(this).closest('.options').children('.options-list');
        $(optionList).fadeToggle(100);
    });
    $(document).on('click', function(e) {
        const socialListModal = $('.social-list-modal');
        const optionList = $('.options-list');
        if (!socialListModal.is(e.target) && socialListModal.has(e.target).length === 0) {
            socialListModal.hide();
        }
        if (!optionList.is(e.target) && optionList.has(e.target).length === 0) {
            optionList.hide();
        }
    });

})(window.jQuery);

function shouldInit() {
    $('.plx__countdown').each(function () {
        let dateTime = $(this).data('date-time');
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