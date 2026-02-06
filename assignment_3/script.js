document.getElementById("projectForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const title = document.getElementById("title").value;

    const message = document.getElementById("message");

    if (name && email && title) {
        message.style.color = "green";
        message.textContent = "✅ Project submitted successfully!";
        this.reset();
    } else {
        message.style.color = "red";
        message.textContent = "❌ Please fill all required fields.";
    }
});
