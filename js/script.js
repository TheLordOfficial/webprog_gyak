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

  // Form validáció
document.getElementById("contactForm").addEventListener("submit", function(event) {
  event.preventDefault(); // Ne küldje el a formot azonnal

  let form = event.target;
  let valid = true;

  // Ellenőrizze, hogy az összes mező érvényes-e
  form.querySelectorAll("input, textarea").forEach(function(input) {
    if (!input.validity.valid) {
      valid = false;
      input.classList.add("is-invalid");
    } else {
      input.classList.remove("is-invalid");
    }
  });

  // Ellenőrizze, hogy a GDPR checkbox be van-e pipálva
  let privacyPolicy = document.getElementById("privacyPolicy");
  if (!privacyPolicy.checked) {
    valid = false;
    privacyPolicy.classList.add("is-invalid");
  } else {
    privacyPolicy.classList.remove("is-invalid");
  }

  // Ha minden mező valid
  if (valid) {
    document.getElementById("formFeedback").innerHTML = "Köszönjük, hogy kapcsolatba lépett velünk! Az üzenetét sikeresen elküldtük.";
    document.getElementById("formFeedback").classList.remove("error");
    document.getElementById("formFeedback").classList.add("success");
  } else {
    document.getElementById("formFeedback").innerHTML = "Kérem, töltse ki az összes mezőt érvényes adatokkal és fogadja el az adatvédelmi tájékoztatót.";
    document.getElementById("formFeedback").classList.add("error");
  }
});

document.addEventListener('DOMContentLoaded', function () {
  const statusButtons = document.querySelectorAll('.status-btn');
  const deleteButtons = document.querySelectorAll('.delete-btn');

  // Státusz módosítása
  statusButtons.forEach(button => {
      button.addEventListener('click', function () {
          const row = this.closest('tr');
          const statusCell = row.querySelector('.status-cell'); // Keresés a státusz oszlopra
          if (statusCell) {
              statusCell.innerText = statusCell.innerText === "Feldolgozva" ? "Várakozik" : "Feldolgozva"; // Státusz változtatása
          }
      });
  });

  // Törlés gomb
  deleteButtons.forEach(button => {
      button.addEventListener('click', function () {
          const row = this.closest('tr');
          row.remove(); // Sor eltávolítása
      });
  });
});




