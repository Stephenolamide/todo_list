document.addEventListener("DOMContentLoaded", () => {
    fetch('../controllers/taskController.php')
        .then(response => response.json())
        .then(data => {
            const calendar = document.getElementById('calendar');
            for (let i = 1; i <= 30; i++) {
                let day = document.createElement('div');
                day.classList.add('day');
                day.textContent = i;
                if (data.includes(i)) day.classList.add('has-task');
                calendar.appendChild(day);
            }
        });
});