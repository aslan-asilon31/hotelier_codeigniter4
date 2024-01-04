<?= $this->extend('layouts/backend') ?>

<?= $this->section('content') ?>

    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!--fullcalendar plugin files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    

    <style>
        .highlight-event {
    background-color: #ffeeba; /* Set your desired highlight color */
    border-color: #ffeeba;
    color: #856404;
}
    </style>
    <!-- for plugin notification -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <!-- card -->
    <div class="report-card">
        <div class="card">
            <div class="card-body flex flex-col">
                
                <!-- top -->
                <div class="flex flex-row justify-between items-center">
                    <div class="h6 text-indigo-700 fad fa-shopping-cart"></div>
                    <span class="rounded-full text-white badge bg-teal-400 text-xs">
                        12%
                        <i class="fal fa-chevron-up ml-1"></i>
                    </span>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>items sales</p>
                </div>                
                <!-- end bottom -->
    
            </div>
        </div>
        <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>
    <!-- end card -->


    <!-- card -->
    <div class="report-card">
        <div class="card">
            <div class="card-body flex flex-col">
                
                <!-- top -->
                <div class="flex flex-row justify-between items-center">
                    <div class="h6 text-red-700 fad fa-store"></div>
                    <span class="rounded-full text-white badge bg-red-400 text-xs">
                        6%
                        <i class="fal fa-chevron-down ml-1"></i>
                    </span>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>new orders</p>
                </div>                
                <!-- end bottom -->
    
            </div>
        </div>
        <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>
    <!-- end card -->


    <!-- card -->
    <div class="report-card">
        <div class="card">
            <div class="card-body flex flex-col">
                
                <!-- top -->
                <div class="flex flex-row justify-between items-center">
                    <div class="h6 text-yellow-600 fad fa-sitemap"></div>
                    <span class="rounded-full text-white badge bg-teal-400 text-xs">
                        72%
                        <i class="fal fa-chevron-up ml-1"></i>
                    </span>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>total Products</p>
                </div>                
                <!-- end bottom -->
    
            </div>
        </div>
        <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>
    <!-- end card -->


    <!-- card -->
    <div class="report-card">
        <div class="card">
            <div class="card-body flex flex-col">
                
                <!-- top -->
                <div class="flex flex-row justify-between items-center">
                    <div class="h6 text-green-700 fad fa-users"></div>
                    <span class="rounded-full text-white badge bg-teal-400 text-xs">
                        150%
                        <i class="fal fa-chevron-up ml-1"></i>
                    </span>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>new Visitor</p>
                </div>                
                <!-- end bottom -->
    
            </div>
        </div>
        <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>
    <!-- end card -->


      
    <div class="card-header flex flex-row justify-between" style="width:600px;background-color:white;">

        <div class="flex flex-row justify-center items-center" >
          <div id="calendar"></div>
          <a href="">
                <i class="fad fa-ellipsis-v"></i>
            </a>

        </div>

    </div>

    


<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <label for="bookingTitle">Event Title:</label>
        <input type="text" id="bookingTitle">
        <label for="startDate">Start Date:</label>
        <input type="datetime-local" id="startDate">
        <label for="endDate">End Date:</label>
        <input type="datetime-local" id="endDate">
        <button onclick="submitEvent()">Submit</button>
    </div>
</div>


      
<script>
  var site_url = "<?= site_url() ?>";
</script>


<script>
$(document).ready(function() {

    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: site_url + "/booking",
        displayEventTime: false,
        eventRender: function(event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDay) {
            openModal();
        },
    
        eventDrop: function(event, delta) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
    
            $.ajax({
                url: site_url + '/bookingAjax',
                data: {
                    title: event.title,
                    start: start,
                    end: end,
                    id: event.id,
                    type: 'update'
                },
                type: "POST",
                success: function(response) {
    
                    displayMessage("booking Updated Successfully");
                }
            });
        },
        eventClick: function(event) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: site_url + '/bookingAjax',
                    data: {
                        id: event.id,
                        type: 'delete'
                    },
                    success: function(response) {
    
                        calendar.fullCalendar('removeEvents', event.id);
                        displayMessage("booking Deleted Successfully");
                    }
                });
            }
        }
    
    });



    function openModal() {
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];

        // Display the modal
        modal.style.display = "block";

        // Close the modal if the user clicks on the "x"
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Close the modal if the user clicks outside the modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }




});
</script>

  

<script>
    
    function submitEvent() {
        var title = document.getElementById("bookingTitle").value;
        var startDate = document.getElementById("startDate").value;
        var endDate = document.getElementById("endDate").value;

        if (title && startDate) {
            var start = startDate;
            var end = endDate;

            $.ajax({
                url: site_url + "/bookingAjax",
                data: {
                    title: title,
                    start: start,
                    end: end,
                    type: 'add'
                },
                type: "POST",
                success: function(data) {
                    displayMessage("booking Created Successfully");

                    calendar.fullCalendar('renderEvent', {
                        id: data.id,
                        title: title,
                        start: start,
                        end: end,
                    }, true);

                    highlightDateRange(start, end);

                    
                    calendar.fullCalendar('unselect');
                }
            });

            // Close the modal after submission
            closeModal();

            // Countdown refresh in 5 seconds
            var countdown = 5; // Set the countdown time in seconds
            var countdownInterval = setInterval(function() {
                countdown--;

                if (countdown < 0) {
                    // Reload the window after the countdown
                    clearInterval(countdownInterval);
                    window.location.reload();
                }
            }, 1000);

        }
    }

    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }

    function displayMessage(message) {
        toastr.success(message, 'Event');
    }

    function highlightDateRange(startDate, endDate) {
    // Iterate through the calendar's events
    $('#calendar').fullCalendar('clientEvents', function(event) {
        // Check if the event falls within the specified range
        if (
            (event.start >= startDate && event.start <= endDate) ||
            (event.end >= startDate && event.end <= endDate)
        ) {
            // Add a custom class to highlight the event
            $(`#calendar .fc-event[data-event-id=${event.id}]`).addClass('highlight-event');
        } else {
            // Remove the custom class if the event is outside the range
            $(`#calendar .fc-event[data-event-id=${event.id}]`).removeClass('highlight-event');
        }
    });
}
    
</script>


<?= $this->endSection() ?>