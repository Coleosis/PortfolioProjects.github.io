"use strict";

//Home page carousel
$(function() {

    var width = 720;
    var animationSpeed = 2000;
    var pause = 5000;
    var currentSlide = 1;

    //DOM
    var $slider = $('#slider');
    var $slideContainer = $slider.find('.slides');
    var $slides = $slideContainer.find('.slide');
    
    var interval;

    //animate
    function startSlider(){
        interval = setInterval(function() {
            $slideContainer.animate({'margin-left': '-='+width}, animationSpeed, function() {
                currentSlide++;
                if (currentSlide === $slides.length) {      //back to first slide
                    currentSlide = 1;
                    $slideContainer.css('margin-left', 0);
                }
            });
        }, pause);
    }
    
    //stop with hover
    //start again when mouseleave
    function stopSlider() {
        clearInterval(interval);
    }

    $slider.on('mouseenter', stopSlider).on('mouseleave', startSlider);

    startSlider();   

});

//Newsletter textbox with regex
$( document ).ready( () => {

    $( "#newsSave" ).click( () => {
        $("span").text("");   // clear any previous error messages
        
        // get values entered by user
        const email = $("#newsEmail").val();

        // REGEX
        const emailPattern = /^[\w\.\-]+@[\w\.\-]+\.[a-zA-Z]+$/;
        
        // check user entries for validity
        let isValid = true;
        if ( email === "" || !emailPattern.test(email) ) {
            isValid = false;
            $("#newsEmail").next().text("Please enter a valid email.").css({color:'red'});
        }
        
        
        if ( isValid ) { 
            alert("Thank you for joining our newletter!")
           
        }   
    });  
});

//Contact Form with regex
$( document ).ready( () => {

    $( "#save" ).click( () => {
        $("span").text("");   // clear any previous error messages
        
        // get values entered by user
        const email = $("#email").val();
        const phone = $("#phone").val();
        const zip = $("#zip").val();


        // regular expressions for validity testing
        const emailPattern = /^[\w\.\-]+@[\w\.\-]+\.[a-zA-Z]+$/;
        const phonePattern = /^\d{3}-\d{3}-\d{4}$/;
        const zipPattern = /^\d{5}(-\d{4})?$/;
        
        // check user entries for validity
        let isValid = true;
        if ( email === "" || !emailPattern.test(email) ) {
            isValid = false;
            $("#email").next().text("Please enter a valid email.").css({color:'red'});
        }
        if ( phone === "" || !phonePattern.test(phone) ) {
            isValid = false;
            $("#phone").next().text("Please enter a phone number in 555-555-5555 format.").css({color:'red'});
        }
        if ( zip === "" || !zipPattern.test(zip) ) {
            isValid = false;
            $("#zip").next().text("Please enter a valid zip code.").css({color:'red'});
        }

        
        if ( isValid ) { 
            alert("Contact information has been sent")
        }
        
        $("#email").focus(); 
    });
    
    // set focus on initial load
    $("#email").focus();
});

//Service page Form
const displayTaskList = tasks => {
    let taskString = "";
    if (tasks.length > 0) {
        // convert stored date string to Date object
        tasks = tasks.map( task => [task[0], new Date(task[1])] );

        tasks.sort( (task1, task2) => {   // sort by date
            const date1 = task1[1]; // get Date object from task1
            const date2 = task2[1]; // get Date object from task2
            if (date1 < date2) { return -1; }
            else if (date1 > date2) { return 1; }
            else { return 0; }
        });

        taskString = tasks.reduce( (prev, curr) => {
            return prev + curr[1].toDateString() + " - " + curr[0] + "\n";
        }, ""); // pass initial value for prev parameter
    }

    $("#task_list").val(taskString);
    $("#task").focus();
};

$(document).ready( () => {
    const taskString = localStorage.E15tasks;
    const tasks = (taskString) ? JSON.parse(taskString) : [];

    $("#add_task").click( () => {
        const task = $("#task").val();
        const dateString = $("#due_date").val();
        const dueDate = new Date(dateString);
        
        if (task && dateString && dueDate != "Invalid Date") {
            const newTask = [task, dateString];  // store dateString
            tasks.push(newTask);
            localStorage.E15tasks = JSON.stringify(tasks);

            $("#task").val("");
            $("#due_date").val("");
            displayTaskList(tasks);
        } else {
            alert("Please fill ALL fields with valid content.");
            $("#task").select();
        }
    });
    
    $("#clear_tasks").click( () => {
        tasks.length = 0;
        localStorage.removeItem("E15tasks");
        $("#task_list").val("");
        $("#task").focus();
    });
    
    displayTaskList(tasks);
});
