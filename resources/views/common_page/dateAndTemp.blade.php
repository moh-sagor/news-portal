<!-- JavaScript to display the current date -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var currentDate = new Date();

        var daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
            'October', 'November', 'December'
        ];

        var dayOfWeek = daysOfWeek[currentDate.getDay()];
        var dayOfMonth = currentDate.getDate();
        var month = months[currentDate.getMonth()];
        var year = currentDate.getFullYear();

        // Function to get the ordinal suffix for the day of the month (e.g., st, nd, rd, or th)
        function getOrdinalSuffix(number) {
            if (number >= 11 && number <= 13) {
                return 'th';
            }
            var lastDigit = number % 10;
            switch (lastDigit) {
                case 1:
                    return 'st';
                case 2:
                    return 'nd';
                case 3:
                    return 'rd';
                default:
                    return 'th';
            }
        }

        var ordinalSuffix = getOrdinalSuffix(dayOfMonth);

        // Construct the formatted date string
        var formattedDate = dayOfWeek + ', ' + dayOfMonth + ordinalSuffix + ' ' + month + ', ' + year;

        // Update the content of the list item
        document.getElementById('currentDateContainer').innerHTML += formattedDate;
    });
</script>

{{-- Current Time  --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to update the current time
        function updateCurrentTime() {
            var currentTimeContainer = document.getElementById('currentTimeContainer');
            if (currentTimeContainer) {
                var currentTime = new Date();
                var hours = currentTime.getHours();
                var minutes = currentTime.getMinutes();
                var seconds = currentTime.getSeconds();
                var meridiem = (hours >= 12) ? 'PM' : 'AM';

                // Convert hours to 12-hour format
                hours = (hours % 12 === 0) ? 12 : hours % 12;

                // Format the time (add leading zero if needed)
                hours = (hours < 10) ? '0' + hours : hours;
                minutes = (minutes < 10) ? '0' + minutes : minutes;
                seconds = (seconds < 10) ? '0' + seconds : seconds;

                var formattedTime = hours + ':' + minutes + ':' + seconds + ' ' + meridiem;

                // Update the content of the list item
                currentTimeContainer.textContent = formattedTime;
            } else {
                console.error('Current time container element not found.');
            }
        }

        // Initial call to update the current time
        updateCurrentTime();

        // Update the current time every second
        setInterval(updateCurrentTime, 1000); // 1000 milliseconds = 1 second
    });
</script>
