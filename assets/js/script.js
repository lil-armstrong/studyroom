$(document).ready(function(){
    // Add smooth scrolling to all links in navbar + footer link

    $('a.in-link').on('click', function(event) {

        // Prevent default anchor click behavior
        event.preventDefault();

        // Store hash
        var hash = this.hash;

        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
                                    scrollTop: $(hash).offset().top}, 900, function(){
            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = $(hash);
        });
    });

   /* //instantiate new carousel object
    var slideshow = new Carousel;
    //add the class active
    slideshow.addCurrentClass();
    slideshow.addBoxClass();

    slideshow.next.addEventListener( 'click', function (ev) {
        slideshow.navigate(1);
    } );
    slideshow.prev.addEventListener( 'click', function (ev) {
        slideshow.navigate(-1);
    } );

    //Loop through slides
    setInterval(function(){slideshow.navigate(1);}, 5000);*/
});

/*
//Using Constructor Paradigm
function Carousel()
{
    //Select the slide container
    this.box = document.querySelector('.carousel');
    //Get the list of slides
    this.slide = this.box.querySelectorAll ('.panes li');
    //set amount to the length of the slides
    this.amount = this.slide.length;
    //Select the nav buttons
    this.next = this.box.querySelector('.next');
    this.prev = this.box.querySelector('.prev');
    //Set counter to 0
    this.counter = Number(0);
    //Set the current to first item
    this.current = this.slide[0];
    //Add EventListeners to the nav buttons

    this.removeBoxClass();
    this.removeCurrentClass();
    this.navigate(0);
    this.addBoxClass();
    this.addCurrentClass();
}
/*

//Using Prototype Paradigm
Carousel.prototype.addCurrentClass = function ()
{
    this.current.classList.add('current');
};
Carousel.prototype.removeCurrentClass = function ()
{
    this.current.classList.remove('current');
};

Carousel.prototype.removeBoxClass = function ()
{
    this.box.classList.remove('active');
};

Carousel.prototype.addBoxClass = function ()
{
    this.box.classList.add('active');
};

Carousel.prototype.navigate = function (direction)
{
    this.removeCurrentClass();
    this.counter = Number(this.counter + direction);
    //Check that counter !< 0
    if (direction == -1 && this.counter < 0)
    {
        this.counter = this.amount - 1;
    }
    //Check that counter !> amount
    if (direction == 1 && this.counter >= this.amount)
    {
        this.counter = 0;
    }
    this.current = this.slide[this.counter];
    this.addCurrentClass();

};


/!*

function carouselbox(){

    //Select the slide container
    var box = document.querySelector('.carouselbox');
    //Get the list of slides
    var slide = box.querySelectorAll ('.content li');
    //set amount to the length of the slides
    var amount = slide.length;
    //Select the nav buttons
    var next = box.querySelector('.next');
    var prev = box.querySelector('.prev');

    //Set counter to 0
    var counter = 0;
    //Set the current to first item
    var current = slide[0];
    current.classList.add('current');
    //Add a class 'active' to the slide container
    box.classList.add('active');
    //Add EventListeners to the nav buttons
    next.addEventListener('click', function(ev)
    {
        navigate(1);
    });
    prev.addEventListener('click', function(ev)
    {
        navigate(-1);
    });
    //Define the navigation button
    function navigate(direction)
    {
        current.classList.remove('current');
        counter += direction;
        //Check that counter !< 0
        if (direction == -1 && counter < 0)
        {
            counter = amount - 1;
        }
        //Check that counter !> amount
        if (direction == 1 && counter >= amount)
        {
            counter = 0;
        }
        current = slide[counter];
        current.classList.add('current');

    }
}*!/
*/
