document.getElementById("contactForm").addEventListener("submit", function (e) {
    e.preventDefault();
    let isValid = true;
    let feedback = "";
    
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const subject = document.getElementById("subject").value.trim();
    const message = document.getElementById("message").value.trim();
    const phone = document.getElementById("phone").value.trim();
    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
    if (name.length < 10) {
      isValid = false;
      feedback += "A név legalább 10 karakter legyen.<br>";
    }
    if (!emailRegex.test(email)) {
      isValid = false;
      feedback += "Adj meg egy érvényes email címet.<br>";
    }
    if (subject.length < 10) {
      isValid = false;
      feedback += "A tárgy legalább 10 karakter legyen.<br>";
    }
    if (message.length < 10) {
      isValid = false;
      feedback += "Az üzenet legalább 10 karakter legyen.<br>";
    }
    if (phone.length < 10) {
      isValid = false;
      feedback += "A telefonszám legalább 10 karakter legyen.<br>";
    }
  
    const feedbackDiv = document.getElementById("formFeedback");
    if (isValid) {
      feedbackDiv.innerHTML = "<div class='alert alert-success'>Sikeres küldés!</div>";
      document.getElementById("contactForm").reset();
    } else {
      feedbackDiv.innerHTML = `<div class='alert alert-danger'>${feedback}</div>`;
    }
  });

