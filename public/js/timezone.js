document.addEventListener('DOMContentLoaded', function() {
    function formatTimeByTimezone(date, tz) {
        var offsets = { 'London': 0, 'NewYork': -5, 'Paris': 1, 'Japan': 9, 'Beijing': 8, 'India': 5.5, 'Bangladesh': 6 };
        var offset = offsets[tz] || 0;
        var utc = date.getTime() + (date.getTimezoneOffset() * 60000);
        var localDate = new Date(utc + (offset * 3600000));
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        return months[localDate.getMonth()] + ' ' + localDate.getDate() + ', ' + 
               String(localDate.getHours()).padStart(2,'0') + ':' + 
               String(localDate.getMinutes()).padStart(2,'0');
    }
    
    var lastUpdated = document.getElementById('last-updated');
    if (lastUpdated) {
        var tz = lastUpdated.getAttribute('data-timezone') || 'London';
        lastUpdated.textContent = formatTimeByTimezone(new Date(), tz);
        
        setInterval(function() {
            var currentTz = document.getElementById('last-updated').getAttribute('data-timezone') || 'London';
            document.getElementById('last-updated').textContent = formatTimeByTimezone(new Date(), currentTz);
        }, 60000);
    }
});
