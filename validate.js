function validateForm() {
    // 1. Névváltozó ellenőrzése (nem üres)
    const name = document.getElementById("name").value;
    if (name.trim() === "") {
      alert("Kérem, adja meg a nevét.");
      return false;
    }
  
    // 2. E-mail cím formátum ellenőrzése
    const email = document.getElementById("email").value;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
      alert("Kérem, adjon meg egy érvényes email címet.");
      return false;
    }
  
    // 3. Üzenet mező nem üres
    const message = document.getElementById("message").value;
    if (message.trim() === "") {
      alert("Kérem, írjon üzenetet.");
      return false;
    }
  
    // Minden rendben van, a form elküldhető
    return true;
  }
  