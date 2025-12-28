document.addEventListener("DOMContentLoaded", () => {
    const showPassword = document.querySelector("#showPassword");
    const passwordInput = document.querySelector("#password");

    if (showPassword && passwordInput) {
        showPassword.addEventListener("change", () => {
            if (showPassword.checked) {
                passwordInput.type = "text"; // show password
            } else {
                passwordInput.type = "password"; // hide password
            }
        });
    }
});

// ===== DELETE CONFIRMATION =====
const deleteLinks = document.querySelectorAll("a[href*='delete.php']");

deleteLinks.forEach(link => {
    link.addEventListener("click", (e) => {
        if (!confirm("Are you sure you want to delete this student?")) {
            e.preventDefault();
        }
    });
});

// ===== BUTTON CLICK ANIMATION =====
const buttons = document.querySelectorAll("button");

buttons.forEach(btn => {
    btn.addEventListener("mousedown", () => btn.style.transform = "scale(0.97)");
    btn.addEventListener("mouseup", () => btn.style.transform = "scale(1)");
    btn.addEventListener("mouseleave", () => btn.style.transform = "scale(1)");
});

// ===== OPTIONAL: DASHBOARD GREETING =====
const notes = document.querySelector(".notes");
if(notes) {
    notes.style.transition = "all 0.5s ease";
    notes.addEventListener("mouseover", () => notes.style.background = "#e6f0ff");
    notes.addEventListener("mouseleave", () => notes.style.background = "#f1f5ff");
}

document.addEventListener("DOMContentLoaded", () => {
    const logoutLink = document.querySelectorAll('a[href*="logout.php"]');
    logoutLink.forEach(link => {
        link.addEventListener("click", (e) => {
            if (!confirm("Are you sure you want to logout?")) {
                e.preventDefault();
            }
        });
    });
});

function requireLogin(message = "You need to log in first") {
    alert(message);
    return false; // prevent link navigation
}

// Function to toggle password visibility
function togglePassword(passwordId, checkboxId) {
    const passwordInput = document.getElementById(passwordId);
    const checkbox = document.getElementById(checkboxId);

    if (!passwordInput || !checkbox) return;

    if (checkbox.checked) {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
}

// Optional: automatically attach toggle if multiple checkboxes exist
document.addEventListener('DOMContentLoaded', () => {
    const toggles = document.querySelectorAll('input[type="checkbox"][id^="showPass"]');
    toggles.forEach(cb => {
        const passwordId = cb.getAttribute('onclick')?.match(/'(.+?)'/)?.[1];
        if (passwordId) {
            cb.addEventListener('change', () => togglePassword(passwordId, cb.id));
        }
    });
});

