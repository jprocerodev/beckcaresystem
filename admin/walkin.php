<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>BPMS || Walk-In</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<!-- <script src="js/jquery-1.11.1.min.js"></script> -->
<script src="js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->

<link rel="stylesheet" href="./schedule/fullcalendar/lib/main.min.css">
<script src="./schedule/fullcalendar/lib/main.min.js"></script>
<script src="./schedule/js/jquery-3.6.0.min.js"></script>

<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.4/dayjs.min.js"></script>

</head> 
<style>
    body {
        background-color: #fdd3d7;
    }
    .sidebar{
        all:unset;
    }
    .form-container {
        background-color: white;
        border-radius: 1rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-header {
        color: #f56c6c;
    }
    .form-label {
        color: #333;
    }
    .form-input {
        border: 1px solid #ddd;
        border-radius: 0.5rem;
        padding: 0.75rem;
    }
    .form-button {
        background-color: #f56c6c;
        color: white;
        border-radius: 0.5rem;
        padding: 0.75rem 1.5rem;
        transition: background-color 0.3s;
    }
    .form-button:hover {
        background-color: #e75c5c;
    }
</style>
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--left-fixed -navigation-->
		 <?php include_once('includes/sidebar.php');?>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		 <?php include_once('includes/header.php');?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
            <div class="form-container w-full  p-8">
                <h2 class="text-4xl font-bold text-center mb-6 form-header">Beckcare Appointment Form</h2>

                <!-- Appointment Form -->
                <form action="../appointment_processor.php" method="POST" id="appointmentForm">
                    <input type="hidden" name="selectedDate" id="selectedDate">

                    <!-- User Information Fields -->
                    <div class="mb-6">
                        <div class="mb-4">
                            <label for="name" class="block text-lg font-medium form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-input w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-lg font-medium form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-input w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="phoneNumber" class="block text-lg font-medium form-label">Phone Number</label>
                            <input type="tel" name="phoneNumber" id="phoneNumber" class="form-input w-full" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Calendar Section -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex justify-between items-center mb-4">
                                <button type="button" id="prevMonth" class="text-xl font-bold text-pink-600 transition hover:text-pink-800">&lt;</button>
                                <h3 id="currentMonth" class="text-2xl font-bold text-pink-600"></h3>
                                <button type="button" id="nextMonth" class="text-xl font-bold text-pink-600 transition hover:text-pink-800">&gt;</button>
                            </div>
                            <div class="grid grid-cols-7 gap-2 text-center text-lg font-semibold text-pink-600">
                                <div>Sun</div>
                                <div>Mon</div>
                                <div>Tue</div>
                                <div>Wed</div>
                                <div>Thu</div>
                                <div>Fri</div>
                                <div>Sat</div>
                                <div id="calendarDays" class="col-span-7 grid grid-cols-7 gap-2"></div>
                            </div>
                        </div>

                        <!-- Services and Time Slots Section -->
                        <div>
                            <div class="mt-6">
                                <h4 class="text-2xl font-bold text-pink-600 mb-4">Select Services and Time Slots</h4>
                                <?php
                                include('includes/dbconnection.php');

                                $sql = "SELECT * FROM tblservices";
                                $result = mysqli_query($con, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo '<div class="mb-4">';
                                        echo '<label class="block text-lg font-medium form-label mb-2">';
                                        echo '<input type="radio" class="service-checkbox h-4 w-4 text-pink-600 border-gray-300 rounded mr-2" name="services[]" value="' . $row['ID'] . '">';
                                        echo $row['ServiceName'] . ' - ₱' . $row['Cost'];
                                        echo '</label>';
                                        
                                        // Aesthetician selection dropdown
                                        echo '<div class="aesthetician-container hidden" data-service-id="' . $row['ID'] . '">';
                                        echo '<label>Select Aesthetician</label>';
                                        echo '<select name="aestheticians[' . $row['ID'] . ']" class="aesthetician-select form-input w-full">';
                                        echo '<option value="">Select an Aesthetician</option>';
                                        echo '</select>';
                                        echo '</div>';

                                        // Time slot selection dropdown
                                        echo '<div class="time-slots-container hidden" data-service-id="' . $row['ID'] . '">';
                                        echo '<label>Select a Time Slot</label>';
                                        echo '<select name="timeSlots[' . $row['ID'] . ']" class="form-input w-full">';
                                        echo '<option value="">Select a Time Slot</option>';
                                        echo '</select>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo "<p class='text-lg text-gray-600'>No services found.</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Remark Field -->
                    <div class="mt-6">
                        <label for="remark" class="block text-lg font-medium form-label">Remark</label>
                        <textarea name="remark" id="remark" rows="4" class="form-input w-full"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6 text-center">
                        <button type="submit" class="form-button w-full">Submit Appointment</button>
                    </div>
                </form>
            </div>
			</div>
		</div>
		<!--footer-->
		 <?php include_once('includes/footer.php');?>
        <!--//footer-->
	</div>
	<!-- Classie -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.js"> </script>
</body>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>
<script src="./schedule/js/script.js"></script>
<script>
    // Initialize dayjs with the current date
    let currentDate = dayjs();
    let selectedDate = null;
    let selectedDateElement = null;

    // Function to render the calendar
    function renderCalendar(date) {
        const startOfMonth = date.startOf('month').day(); // Day of the week the month starts on
        const daysInMonth = date.daysInMonth(); // Number of days in the month
        const currentMonth = date.format('MMMM YYYY'); // Current month and year

        // Update the calendar header
        document.getElementById('currentMonth').textContent = currentMonth;

        // Get the calendar days container
        const calendarDays = document.getElementById('calendarDays');
        calendarDays.innerHTML = '';

        // Add empty days for the previous month
        for (let i = 0; i < startOfMonth; i++) {
            const emptyDiv = document.createElement('div');
            calendarDays.appendChild(emptyDiv);
        }

        // Add days of the current month
        for (let i = 1; i <= daysInMonth; i++) {
            const dayDiv = document.createElement('div');
            dayDiv.textContent = i;
            dayDiv.className = 'p-2 cursor-pointer bg-white rounded-lg hover:bg-pink-100 transition';
            dayDiv.addEventListener('click', () => selectDate(date.date(i), dayDiv));
            calendarDays.appendChild(dayDiv);
        }
    }

    // Function to check for booked time slots
    async function getBookedSlots(date, serviceId, aestheticianId) {
        const response = await fetch(`../getBookedSlots.php?date=${date}&serviceId=${serviceId}&aestheticianId=${aestheticianId}`);
        const bookedSlots = await response.json();
        return bookedSlots;
    }

    // Function to fetch aesthetician availability
    async function getAvailabilityForAesthetician(aestheticianId) {
        const response = await fetch(`../getAvailability.php?aestheticianId=${aestheticianId}`);
        const availability = await response.json();
        return availability; // Expecting availability to be in a format like ['12:00 PM - 1:00 PM', '1:00 PM - 2:00 PM']
    }

    // Function to fetch available aestheticians for the selected service
    async function getAestheticiansForService(serviceId) {
        const response = await fetch(`../getAestheticians.php?serviceId=${serviceId}`);
        const aestheticians = await response.json();
        return aestheticians;
    }

    // Function to render aesthetician dropdown for a specific service
    async function renderAestheticiansForService(serviceId) {
        const availableAestheticians = await getAestheticiansForService(serviceId);
        
        const aestheticianSelect = document.querySelector(`.aesthetician-container[data-service-id="${serviceId}"] .aesthetician-select`);
        aestheticianSelect.innerHTML = '<option value="">Select an Aesthetician</option>'; // Clear previous options

        availableAestheticians.forEach(aesthetician => {
            const option = document.createElement('option');
            option.value = aesthetician.id;
            option.textContent = aesthetician.name;
            aestheticianSelect.appendChild(option);
        });
    }

    // Function to render time slots for the selected aesthetician on a specific service
    async function renderTimeSlotsForAesthetician(date, serviceId, aestheticianId) {
        const { bookedSlots, pendingSlots } = await getBookedSlots(date.format('YYYY-MM-DD'), serviceId, aestheticianId);
        const availability = await getAvailabilityForAesthetician(aestheticianId);

        const timeSlotSelect = document.querySelector(`.time-slots-container[data-service-id="${serviceId}"] .form-input`);
        timeSlotSelect.innerHTML = '<option value="">Select a Time Slot</option>'; // Clear previous options

        availability.forEach(slot => {
            const isBooked = bookedSlots.includes(slot);
            const isPending = pendingSlots.includes(slot);
            const option = document.createElement('option');
            option.value = slot;
            option.textContent = slot;

            if (isBooked) {
                option.disabled = true;
                option.textContent += ' (Booked)';
            } else if (isPending) {
                option.disabled = true;
                option.textContent += ' (This schedule is already pending)';
            }

            timeSlotSelect.appendChild(option);
        });
    }

    // Function to handle date selection
    function selectDate(date, element) {
        selectedDate = date.format('YYYY-MM-DD');
        document.getElementById('selectedDate').value = selectedDate;

        // Highlight selected date
        if (selectedDateElement) {
            selectedDateElement.classList.remove('bg-pink-500', 'text-white');
            selectedDateElement.classList.add('hover:bg-pink-100');
        }
        element.classList.add('bg-pink-500', 'text-white');
        element.classList.remove('hover:bg-pink-100');
        selectedDateElement = element;

        // Update time slots for all selected services and aestheticians
        document.querySelectorAll('.service-checkbox:checked').forEach(checkbox => {
            const serviceId = checkbox.value;
            const aestheticianSelect = document.querySelector(`.aesthetician-container[data-service-id="${serviceId}"] .aesthetician-select`);
            const aestheticianId = aestheticianSelect.value;

            if (aestheticianId) {
                renderTimeSlotsForAesthetician(date, serviceId, aestheticianId);
            }
        });
    }

    // Handle previous and next month navigation
    document.getElementById('prevMonth').addEventListener('click', () => {
        currentDate = currentDate.subtract(1, 'month');
        renderCalendar(currentDate);
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
        currentDate = currentDate.add(1, 'month');
        renderCalendar(currentDate);
    });

    // Event listener for service checkbox change
    document.addEventListener('DOMContentLoaded', () => {
        const radioButtons = document.querySelectorAll('.service-checkbox');
        
        radioButtons.forEach(radio => {
            radio.addEventListener('change', async function() {
                const serviceId = this.value;
                const aestheticianContainers = document.querySelectorAll('.aesthetician-container');
                const timeSlotContainers = document.querySelectorAll('.time-slots-container');

                // Hide all containers before showing the selected one
                aestheticianContainers.forEach(container => container.classList.add('hidden'));
                timeSlotContainers.forEach(container => container.classList.add('hidden'));

                const aestheticianContainer = document.querySelector(`.aesthetician-container[data-service-id="${serviceId}"]`);
                const timeSlotContainer = document.querySelector(`.time-slots-container[data-service-id="${serviceId}"]`);

                if (this.checked) {
                    aestheticianContainer.classList.remove('hidden');
                    await renderAestheticiansForService(serviceId);

                    // Add event listener for aesthetician selection change
                    const aestheticianSelect = document.querySelector(`.aesthetician-container[data-service-id="${serviceId}"] .aesthetician-select`);
                    aestheticianSelect.addEventListener('change', function() {
                        const aestheticianId = this.value;
                        if (selectedDate && aestheticianId) {
                            timeSlotContainer.classList.remove('hidden');
                            renderTimeSlotsForAesthetician(dayjs(selectedDate), serviceId, aestheticianId);
                        } else {
                            timeSlotContainer.classList.add('hidden');
                        }
                    });

                    if (selectedDate) {
                        // Automatically render time slots if the date was already selected
                        const aestheticianId = aestheticianSelect.value;
                        if (aestheticianId) {
                            timeSlotContainer.classList.remove('hidden');
                            renderTimeSlotsForAesthetician(dayjs(selectedDate), serviceId, aestheticianId);
                        }
                    }
                }
            });
        });
    });

    // Initial render
    renderCalendar(currentDate);
</script>
</html>
<?php }  ?>