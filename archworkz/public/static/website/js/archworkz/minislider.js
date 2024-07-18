

var subu;
var subuUl;
var subuUlLi;
var countChildren;
var countLastEntry;
var totalWidth;
var imageWidth;
var imageHeight;
var b;
var newi = 0;
var currCount = 1;
var marleft;
var marRight;

var auroInterval = 2500;
var sliderInterval = 1500;
var counterClick = 0;
var clickedx = 1;

(function($) {
    jQuery.fn.minislider = function() {

        //set duration time; 
        window.setInterval(setDuration, auroInterval);
        function setDuration() {
            if (currCount === countChildren) {
                if (counterClick === 1) {
                    counterClick = 0;
                }
                else {
                    subuSlsiderFirst();
                }
            }
            else {
                if (counterClick === 1) {
                    counterClick = 0;
                }
                else {
                    $(subuSliderNext);
                }
            }
        }

        subu = $(this).attr('id');
        subuUl = $("#" + subu + ' ul');
        subuUlLi = $("#" + subu + ' ul li');
        countChildren = $("#" + subu + ' ul').children().length; //count total li
        countLastEntry = countChildren - 1;
        imageWidth = $("#" + subu).width();
        totalWidth = imageWidth * countChildren;
        subuUl.width(totalWidth);

        altTextPrint();
        function altTextPrint() {
            var setValue = subuUl.find('li.subuActive').find('img').attr("alt");
            if (setValue !== 0)
            {
                subuUl.find('li.subuActive').append('<div class="slider-title">');
                $('.slider-title').html(setValue).animate({'top': 44 + '%'}, 1000);
            }
        }
        ;
        function subuSliderNext() {
            if (clickedx) {
                $('.slider-title').remove();
                if (currCount === countChildren) {
                    return false;
                }
                else {
                    marleft = imageWidth * currCount;
                    var activeItem = subuUl.find('li.subuActive');

                    activeItem.next().addClass('subuActive');

                    activeItem.removeClass('subuActive');
                    subuUl.animate({'marginLeft': -marleft + 'px'}, sliderInterval, function(){
                        altTextPrint();
                    });

                    $('#sliderBulet').children('div').removeClass('bulletactive');
                    ++newi;
                    $(bulArr[newi]).addClass('bulletactive');
                    currCount++;
                    counterClick = 1;
                }
            }
            clickedx = 0;
            setTimeout(function() {
                clickedx = 1;
            }, 700);
        }
        ;
        function subuSlsiderPreview() {
            if (clickedx) {
                $('.slider-title').remove();
                if (currCount === 1) {
                    return false;
                }
                else {
                    marRight = marleft - imageWidth;
                    marleft = marRight;
                    var activeItem = subuUl.find('li.subuActive');
                    activeItem.prev().addClass('subuActive');

                    activeItem.removeClass('subuActive');
                    subuUl.animate({'marginLeft': -marRight + 'px'}, sliderInterval, function(){
                        altTextPrint();
                    });

                    $('#sliderBulet').children('div').removeClass('bulletactive');
                    --newi;
                    $(bulArr[newi]).addClass('bulletactive');

                    currCount--;
                    counterClick = 1;
                }
            }
            clickedx = 0;
            setTimeout(function() {
                clickedx = 1;
            }, 700);
        }
        ;
        function subuSlsiderFirst() {
            $('.slider-title').remove();
            marleft = 0;
            var activeItem = subuUl.find('li.subuActive');
            subuUlLi.first().addClass('subuActive');

            activeItem.removeClass('subuActive');
            subuUl.animate({'marginLeft': 0 + 'px'}, 1500, function(){
                altTextPrint();
            });
            currCount = 1;

            $('#sliderBulet').children('div').removeClass('bulletactive');
            newi = 0;
            $(bulArr[newi]).addClass('bulletactive');
        }
        ;

        $('#' + subu).append('<a id="subuprev">', '<a id="subunext">');
        $("#subunext").on("click", function(e) {
            e.preventDefault();
            subuSliderNext();
        });
        $("#subuprev").on("click", function(e) {
            e.preventDefault();
            subuSlsiderPreview();
        });

        $('#' + subu).append('<div id="sliderBulet">');
        for (newk = 0; newk < countChildren; newk++)
        {
            var vChildDiv = $('<div>', {'id': 'b' + newk});
            $('#sliderBulet').append(vChildDiv);
        }

        var bulArr = [];
        $("#sliderBulet div").each(function() {
            bulArr.push(this);
        });

        var c = subuUlLi.first().show();
        $(bulArr[newi]).addClass('bulletactive');

        $("#sliderBulet div").on("click", function() {
            if (clickedx) {
                var clickId = $(this).attr('id').replace('b', '');
                var currentId = $(bulArr[newi]).attr('id').replace('b', '');

                if (clickId > currentId) {
                    $('.slider-title').remove();
                    var serMargin = clickId * imageWidth;
                    marleft = serMargin;
                    slideSpeed = clickId * sliderInterval
                    subuUl.animate({'marginLeft': -serMargin + 'px'}, slideSpeed, function(){
                        altTextPrint();
                    });

                    $('#sliderBulet').children('div').removeClass('bulletactive');
                    $(bulArr[clickId]).addClass('bulletactive');

                    subuUlLi.removeClass('subuActive');
                    subuUlLi.eq(clickId).addClass('subuActive');

                    newi = clickId;
                    currCount = clickId;
                    currCount++;
                    counterClick = 1;
                }
                else if (clickId < currentId) {
                    if (clickId == 0) {
                        counterClick = 1;
                        subuSlsiderFirst();
                    } else {
                        $('.slider-title').remove();
                        var serMargin = clickId * imageWidth;
                        marleft = serMargin;
                        slideSpeed = clickId * sliderInterval

                        subuUl.animate({'marginLeft': -serMargin + 'px'}, slideSpeed, function(){
                            altTextPrint();
                        });

                        $('#sliderBulet').children('div').removeClass('bulletactive');

                        subuUlLi.removeClass('subuActive');
                        subuUlLi.eq(clickId).addClass('subuActive');

                        $(bulArr[clickId]).addClass('bulletactive');
                        newi = clickId;
                        //newi++
                        currCount = clickId;
                        currCount++;
                        counterClick = 1; 
                    }

                }
                else {
                    //
                }
            }
            clickedx = 0;
            setTimeout(function() {
                clickedx = 1;
            }, 1000);
        });

    };
})(jQuery);





