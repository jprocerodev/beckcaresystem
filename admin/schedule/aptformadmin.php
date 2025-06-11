<?php
session_start();
include('dbconnection.php');

 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user ID from the session
    $userId = $_SESSION['user_id'];

    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $selectedDate = $_POST['selectedDate'];
    $services = $_POST['services'];
    $timeSlots = $_POST['timeSlots'];
    $remark = $_POST['remark'];

    // Generate a unique appointment number
    $aptNumber = generateAppointmentNumber($con);

    $status = 'Pending'; // Set default status
    $success = true;

    foreach ($services as $serviceId) {
        // Calculate the cost for each service
        $sql = "SELECT ServiceName, Cost FROM tblservices WHERE ID='$serviceId'";
        $result = mysqli_query($con, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $serviceName = $row['ServiceName'];
            $cost = $row['Cost'];
            $timeSlot = $timeSlots[$serviceId];

            // Insert appointment into the database
            $insertSql = "INSERT INTO tblappointment (user_id, AptNumber, Name, Email, PhoneNumber, AptDate, AptTime, Services, TotalCost, Remark, Status)
                          VALUES ('$userId', '$aptNumber', '$name', '$email', '$phoneNumber', '$selectedDate', '$timeSlot', '$serviceName', '$cost', '$remark', '$status')";
            $success = $success && mysqli_query($con, $insertSql);
        }
    }

    if ($success) {
        // Redirect to AppointmentHistory.php after successful submission
        header('Location: AppointmentHistory.php');
        exit();
    } else {
        echo '<script>alert("Error: ' . mysqli_error($con) . '");</script>';
    }
}

$conn->close();

// Function to generate a unique appointment number
function generateAppointmentNumber($con) {
    do {
        $aptNumber = 'APPT' . date('YmdHis') . mt_rand(100, 999);
        $result = mysqli_query($con, "SELECT * FROM tblappointment WHERE AptNumber = '$aptNumber'");
    } while (mysqli_num_rows($result) > 0);

    return $aptNumber;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Form</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include dayjs for date manipulation -->
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.4/dayjs.min.js"></script>
    <style>
        body {
            background-color: #fdd3d7;
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
</head>
<body class="flex items-center justify-center min-h-screen p-6">
    <div class="form-container w-full max-w-4xl p-8">
        <h2 class="text-4xl font-bold text-center mb-6 form-header">Beckcare Appointment Form</h2>

        <!-- Appointment Form -->
        <form action="appointment_processor.php" method="POST" id="appointmentForm">
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
                                echo '<input type="checkbox" class="service-checkbox h-4 w-4 text-pink-600 border-gray-300 rounded mr-2" name="services[]" value="' . $row['ID'] . '">';
                                echo $row['ServiceName'] . ' - ₱' . $row['Cost'];
                                echo '</label>';
                                echo '<div class="time-slots-container hidden" data-service-id="' . $row['ID'] . '">';
                                echo '<select name="timeSlots[' . $row['ID'] . ']" class="form-input w-full">';
                                echo '<option value="">Select a Time Slot</option>';
                                // Placeholder for time slots, to be populated dynamically
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
        async function getBookedSlots(date, serviceId) {
            const response = await fetch(`getBookedSlots.php?date=${date}&serviceId=${serviceId}`);
            const bookedSlots = await response.json();
            return bookedSlots;
        }

        // Function to render time slots for a specific service
        async function renderTimeSlotsForService(date, serviceId) {
            const bookedSlots = await getBookedSlots(date.format('YYYY-MM-DD'), serviceId);

            const timeSlots = [];
            const startHour = 12; // 12 PM
            const endHour = 21; // 9 PM

            for (let hour = startHour; hour <= endHour; hour++) {
                const timeSlot = {
                    start: dayjs().hour(hour).minute(0).format('h:mm A'),
                    end: dayjs().hour(hour + 1).minute(0).format('h:mm A')
                };
                timeSlots.push(`${timeSlot.start} - ${timeSlot.end}`);
            }

            const timeSlotSelect = document.querySelector(`.time-slots-container[data-service-id="${serviceId}"] .form-input`);
            timeSlotSelect.innerHTML = '<option value="">Select a Time Slot</option>'; // Clear previous options

            timeSlots.forEach(slot => {
                const isBooked = bookedSlots.includes(slot);
                const option = document.createElement('option');
                option.value = slot;
                option.textContent = slot;
                if (isBooked) {
                    option.disabled = true;
                    option.textContent += ' (Booked)';
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

            // Update time slots for all selected services
            document.querySelectorAll('.service-checkbox:checked').forEach(checkbox => {
                renderTimeSlotsForService(date, checkbox.value);
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

        // Show or hide time slot selection based on service selection
        document.addEventListener('DOMContentLoaded', () => {
            const checkboxes = document.querySelectorAll('.service-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    const timeSlotContainer = document.querySelector(`.time-slots-container[data-service-id="${checkbox.value}"]`);
                    if (checkbox.checked) {
                        timeSlotContainer.classList.remove('hidden');
                        if (selectedDate) {
                            renderTimeSlotsForService(dayjs(selectedDate), checkbox.value);
                        }
                    } else {
                        timeSlotContainer.classList.add('hidden');
                    }
                });
            });
        });

        // Initial render
        renderCalendar(currentDate);
    </script>
</body>
</html>
