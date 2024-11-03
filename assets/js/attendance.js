document.addEventListener("DOMContentLoaded", function() {
    const rfidInput = document.getElementById("rfid-input");
    const profilePicture = document.getElementById("profile-picture");
    const studentName = document.getElementById("student-name");
    const department = document.getElementById("department");
    const status = document.getElementById("status");

    const recentStudents = [];

    // Function to update recent students display
    function updateRecentScans() {
        const recentScanElements = document.querySelectorAll(".student-card");
        recentScanElements.forEach((card, index) => {
            if (recentStudents[index]) {
                card.querySelector(".small-avatar").src = recentStudents[index].profile_picture || "path/to/default-profile.png";
                card.querySelector(".student-info").textContent = recentStudents[index].name;
                card.querySelector(".student-status").textContent = recentStudents[index].status === "IN" ? "IN" : "OUT";
                card.querySelector(".student-status").className = `student-status ${recentStudents[index].status === "IN" ? "status-in" : "status-out"}`;
            }
        });
    }

    // Listen for RFID input
    rfidInput.addEventListener("input", function() {
        const rfid = rfidInput.value.trim();

        if (rfid) {
            rfidInput.value = ""; // Clear input for next scan

            fetch("/app/Views/components/mark_attendance.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ rfid: rfid })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the profile section
                    profilePicture.src = data.student.profile_picture || "path/to/default-profile.png";
                    studentName.textContent = data.student.full_name;
                    department.textContent = data.student.department;
                    status.textContent = data.status;

                    // Update recent scans list
                    recentStudents.unshift({
                        name: data.student.full_name,
                        profile_picture: data.student.profile_picture,
                        status: data.status
                    });
                    if (recentStudents.length > 3) recentStudents.pop(); // Keep last 3 students

                    updateRecentScans();

                    // Update the attendance table
                    const tbody = document.querySelector("#attendance-tbody");
                    const newRow = document.createElement("tr");
                    newRow.innerHTML = `
                        <td>${data.student.student_id}</td>
                        <td>${data.student.full_name}</td>
                        <td>${data.status === "IN" ? data.time_in : ""}</td>
                        <td>${data.status === "OUT" ? data.time_out : ""}</td>
                        <td>${new Date().toLocaleDateString()}</td>
                    `;
                    tbody.prepend(newRow);
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
        }
    });
});
